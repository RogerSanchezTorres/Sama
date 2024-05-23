<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Ssheduardo\Redsys\Facades\Redsys;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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
                $order = new \App\Models\Order(); // Importante el prefijo \App\Models\ para evitar conflictos
                $order->user_name = $request->input('nombreTitular');
                $order->total = $request->input('importe');
                $order->status = 'paid';
                // Otros campos del pedido, si los hay

                // Guardar el pedido en la base de datos
                $order->save();

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
        // Obtener la clave secreta de Redsys del archivo .env
        $secretKey = env('REDSYS_KEY');

        // Decodificar los parámetros del comerciante desde Base64
        $decodedMerchantParams = base64_decode($merchantParams);

        // Calcular la firma esperada usando SHA-256 HMAC y la clave secreta
        $expectedSignature = hash_hmac('sha256', $decodedMerchantParams, $secretKey, true);

        // Comparar la firma recibida con la firma esperada y devolver true si son iguales
        return $dsSignature === base64_encode($expectedSignature);
    }
}
