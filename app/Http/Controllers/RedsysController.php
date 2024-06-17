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
            Redsys::setMerchantcode($code);
            Redsys::setCurrency('978');
            Redsys::setTransactiontype('0');
            Redsys::setTerminal('1');
            Redsys::setMethod('T');
            Redsys::setNotification(config('redsys.url_notification'));
            Redsys::setUrlOk(config('redsys.url_ok'));
            Redsys::setUrlKo(config('redsys.url_ko'));
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName('SubministresSama S.L');
            Redsys::setTitular($user->name);
            Redsys::setProductDescription($description);
            Redsys::setEnviroment('test');

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
        return redirect()->route('redsys.response');
    }

    public function ko(Request $request)
    {
        return response()->json(['success' => false, 'message' => $request->all()]);
    }

    public function handleResponse(Request $request)
    {
        // Obtener los datos de la respuesta de Redsys
        $dsSignature = $request->input('Ds_Signature');
        $merchantParams = $request->input('Ds_MerchantParameters');
        $responseCode = $request->input('Ds_Response');

        // Verificar la validez de la firma
        if ($this->validateRedsysSignature($dsSignature, $merchantParams)) {
            // La firma es válida, procesar la respuesta
            if ($responseCode === '0000') {
                // El pago fue exitoso, guardar la información del pedido en la base de datos
                $order = new Order();
                $order->user_id = Auth::id();
                $order->user_name = Auth::user()->name;
                $order->total = $request->input('Ds_Amount') / 100; // Redsys devuelve el importe en céntimos
                $order->status = 'paid';

                // Guardar el pedido en la base de datos
                $order->save();

                // Guardar los productos del pedido
                $cart = Cart::where('user_id', Auth::id())->with('product')->get();
                foreach ($cart as $item) {
                    $orderProduct = new OrderProduct();
                    $orderProduct->order_id = $order->id;
                    $orderProduct->product_id = $item->product_id;
                    $orderProduct->quantity = $item->quantity;
                    $orderProduct->price = $item->product->precio_es; // O el precio de oferta, según sea el caso
                    $orderProduct->save();
                }

                // Limpiar el carrito
                Cart::where('user_id', Auth::id())->delete();

                // Redirigir al usuario a la página de confirmación
                return redirect()->route('order.confirmation');
            } else {
                // El pago no fue exitoso, redirigir a la página de fallo de pago
                return redirect()->route('payment.failure');
            }
        } else {
            // Firma no válida, no confiar en esta solicitud
            abort(403, 'Forbidden');
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
