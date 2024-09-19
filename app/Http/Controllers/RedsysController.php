<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Ssheduardo\Redsys\Facades\Redsys;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderProduct;
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
            $terminal = config('redsys.terminal');
            $enviroment = config('redsys.enviroment');
            $tradename = config('redsys.tradename');

            $user = Auth::user();

            $cart = Cart::where('user_id', $user->id)->with('product')->get();
            $total = 0;
            foreach ($cart as $item) {
                $price = $user->role_id == 2 ? $item->product->precio_oferta_es : $item->product->precio_es;
                $total += $price * $item->quantity;
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
            Redsys::setTerminal($terminal);
            Redsys::setMethod('T');
            Redsys::setNotification(config('redsys.url_notification'));
            Redsys::setUrlOk(config('redsys.url_ok'));
            Redsys::setUrlKo(config('redsys.url_ko'));
            Redsys::setVersion('HMAC_SHA256_V1');
            Redsys::setTradeName($tradename);
            Redsys::setTitular($user->name);
            Redsys::setProductDescription($description);
            Redsys::setEnviroment($enviroment);

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

    public function responseMethod(Request $request)
    {
        return view('redsys.response');
    }

    public function ko(Request $request)
    {
        return response()->json(['success' => false, 'message' => $request->all()]);
    }

    public function handleResponse(Request $request)
    {
        // Log para registrar toda la información que llega en la request
        Log::info('Contenido de la request:', $request->all()); // Para registrar todos los datos que llegan
        Log::info('Request headers: ', $request->headers->all());

        Log::info('Request headers: ', $request->headers->all()); // Registrar los headers para mayor detalle

        $dsSignature = $request->input('Ds_Signature');
        $merchantParams = $request->input('Ds_MerchantParameters');
        $responseCode = $request->input('Ds_Response');

        // Continuar con tu lógica normal...
        if ($dsSignature && $merchantParams && $responseCode) {
            Log::info('Datos de Redsys recibidos correctamente, procediendo con la validación.');

            if ($this->validateRedsysSignature($dsSignature, $merchantParams)) {
                Log::info('Firma de Redsys validada correctamente.');

                if ((int)$responseCode <= 99) {
                    DB::beginTransaction();
                    try {
                        $params = json_decode(base64_decode($merchantParams), true);

                        $order = new Order();
                        $order->user_id = Auth::id();
                        $order->user_name = Auth::user()->name;
                        $order->total = $params['Ds_Amount'] / 100;
                        $order->status = 'paid';
                        $order->save();

                        $cart = Cart::where('user_id', Auth::id())->with('product')->get();
                        foreach ($cart as $item) {
                            $orderProduct = new OrderProduct();
                            $orderProduct->order_id = $order->id;
                            $orderProduct->product_id = $item->product_id;
                            $orderProduct->quantity = $item->quantity;
                            $orderProduct->price = $item->product->precio_es;
                            $orderProduct->save();
                        }

                        Cart::where('user_id', Auth::id())->delete();

                        DB::commit();

                        return redirect()->route('order.confirmation')->with('success', 'Pago realizado exitosamente');
                    } catch (\Exception $e) {
                        DB::rollBack();
                        Log::error('Error al procesar el pago: ' . $e->getMessage());
                        return redirect()->route('payment.failure')->with('error', 'Error al procesar el pago: ' . $e->getMessage());
                    }
                } else {
                    Log::error('Pago no exitoso, código de respuesta: ' . $responseCode);
                    return redirect()->route('payment.failure')->with('error', 'Pago no exitoso');
                }
            } else {
                Log::error('Firma no válida');
                abort(403, 'Firma no válida');
            }
        } else {
            Log::error('Datos incompletos recibidos de Redsys');
            abort(403, 'Datos incompletos');
        }
    }




    private function validateRedsysSignature($dsSignature, $merchantParams)
    {
        $key = base64_decode(config('redsys.key'));
        $decodedMerchantParams = base64_decode($merchantParams);
        $key = base64_decode(strtr($key, '-_', '+/'));
        $generatedSignature = hash_hmac('sha256', $decodedMerchantParams, $key, true);
        $encodedSignature = base64_encode($generatedSignature);

        Log::info('Firma recibida: ' . $dsSignature);
        Log::info('Firma esperada: ' . $encodedSignature);

        return $dsSignature === $encodedSignature;
    }
}
