<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Ssheduardo\Redsys\Facades\Redsys;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RedsysController extends Controller
{
    public function index()
    {
        $form = null;
        try {
            $key = config('redsys.key');
            $code = config('redsys.merchantcode');

            $user = Auth::user();

            $cart = Cart::where('user_id', $user->id)->with('product')->get();
            $total = 0;
            foreach ($cart as $item) {
                if ($user->role_id == 2) {
                    $price = $item->product->precio_oferta_es;
                } else {
                    $price = $item->product->precio_es;
                }
                $quantity = $item->quantity;
                $total += $price * $quantity;
            }

            $description = '';
            foreach ($cart as $item) {
                $description .= $item->product->nombre_es . ', ';
            }

            $description = rtrim($description, ', ');

            Redsys::setAmount($total);
            Redsys::setOrder(time());
            Redsys::setMerchantcode($code); //Reemplazar por el código que proporciona el banco
            Redsys::setCurrency('978');
            Redsys::setTransactiontype('0');
            Redsys::setTerminal('1');
            Redsys::setMethod('T'); //Solo pago con tarjeta, no mostramos iupay
            Redsys::setNotification(config('redsys.url_notification'));
            Redsys::setUrlOk(config('redsys.url_ok'));
            Redsys::setUrlKo(config('redsys.url_ko'));
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName('SubministresSama S.L');
            Redsys::setTitular($user->name);
            Redsys::setProductDescription($description);
            Redsys::setEnviroment('test'); //Entorno test
            Redsys::setAttributesSubmit('btn_submit', 'btn_id', '', 'display:none');

            $signature = Redsys::generateMerchantSignature($key);
            Redsys::setMerchantSignature($signature);

            $form = Redsys::createForm();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return view('payment.redsys', compact('form', 'total', 'user', 'description'));
    }

    public function ok(Request $request)
    {
        return redirect()->route('order.confirmation');
    }

    public function ko(Request $request)
    {
        return redirect()->route('order.failure');
    }


    public function handleResponse(Request $request)
    {
        // Verificar que la respuesta sea válida
        $validated = $request->validate([
            'Ds_Signature' => 'required',
            'Ds_MerchantParameters' => 'required',
            'Ds_Response' => 'required',
            // Asegúrate de tener aquí todos los campos necesarios para la validación
        ]);

        // Verificar la firma de Redsys
        if ($this->validateRedsysSignature($request->input('Ds_Signature'), $request->input('Ds_MerchantParameters'))) {
            // La firma es válida, procesar la respuesta
            if ($request->input('Ds_Response') === '0000') {
                // El pago fue exitoso, guardar la información del pedido en la base de datos
                $order = new Order();
                $order->user_id = Auth::id();
                $order->user_name = $request->input('nombreTitular'); // Asegúrate de tener este campo en el formulario de pago
                $order->total = $request->input('importe'); // Asegúrate de tener este campo en el formulario de pago
                $order->status = 'paid'; // Estado pagado

                if ($order->save()) {
                    // Guardar los productos asociados al pedido
                    $cart = Cart::where('user_id', Auth::id())->with('product')->get();

                    foreach ($cart as $item) {
                        $orderProduct = new OrderProduct();
                        $orderProduct->order_id = $order->id;
                        $orderProduct->product_id = $item->product_id;
                        $orderProduct->quantity = $item->quantity;
                        // Aquí necesitas establecer el precio correcto del producto
                        $orderProduct->price = $item->product->precio_es; // Ajusta según tu lógica de precio
                        $orderProduct->save();
                    }

                    // Limpiar el carrito después de realizar el pedido
                    Cart::where('user_id', Auth::id())->delete();

                    // Redirigir al usuario a la página de confirmación o donde sea necesario
                    return redirect()->route('order.confirmation');
                } else {
                    // Manejar el caso donde no se pudo guardar el pedido
                    Log::error('No se pudo guardar el pedido en la base de datos.');
                    abort(500, 'Error interno del servidor.');
                }
            } else {
                // El pago no fue exitoso, redirigir a la página de fallo de pago
                return redirect()->route('payment.failure');
            }
        } else {
            // Firma no válida, no confiar en esta solicitud
            abort(403, 'Firma de Redsys no válida.');
        }
    }


    private function validateRedsysSignature($dsSignature, $merchantParams)
    {
        $secretKey = env('REDSYS_KEY');
        $decodedMerchantParams = base64_decode($merchantParams);
        $expectedSignature = hash_hmac('sha256', $decodedMerchantParams, $secretKey, true);
        $encodedExpectedSignature = base64_encode($expectedSignature);

        Log::info('Redsys Signature: ', ['dsSignature' => $dsSignature]);
        Log::info('Expected Signature: ', ['encodedExpectedSignature' => $encodedExpectedSignature]);

        return $dsSignature === $encodedExpectedSignature;
    }
}
