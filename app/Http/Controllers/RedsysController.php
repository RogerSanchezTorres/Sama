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
        Log::info('Request data: ', $request->all());
        Log::info('Request headers: ', $request->headers->all());

        $dsSignature = $request->input('Ds_Signature');
        $merchantParams = $request->input('Ds_MerchantParameters');
        $responseCode = $request->input('Ds_Response');

        Log::info('Ds_Signature: ' . $dsSignature);
        Log::info('Ds_MerchantParameters: ' . $merchantParams);
        Log::info('Ds_Response: ' . $responseCode);

        if ($dsSignature && $merchantParams && $responseCode) {
            if ($this->validateRedsysSignature($dsSignature, $merchantParams)) {
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
                        return redirect()->route('payment.failure')->with('error', 'Error al procesar el pago: ' . $e->getMessage());
                    }
                } else {
                    return redirect()->route('payment.failure')->with('error', 'Pago no exitoso');
                }
            } else {
                abort(403, 'Firma no válida');
            }
        } else {
            abort(403, 'Datos incompletos');
        }
    }



    private function validateRedsysSignature($dsSignature, $merchantParams)
    {
        $secretKey = config('redsys.key');
        $decodedMerchantParams = base64_decode($merchantParams);
        $expectedSignature = hash_hmac('sha256', $decodedMerchantParams, $secretKey, true);
        $encodedExpectedSignature = base64_encode($expectedSignature);

        Log::info('Firma recibida: ' . $dsSignature);
        Log::info('Firma esperada: ' . $encodedExpectedSignature);

        return $dsSignature === $encodedExpectedSignature;
    }
}
