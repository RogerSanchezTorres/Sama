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
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;


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

            $order = str_pad((string) time(), 12, '0', STR_PAD_LEFT);

            Redsys::setAmount($total);
            Redsys::setOrder($order);
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
            Redsys::setMerchantData($user->id);

            $signature = Redsys::generateMerchantSignature($key);
            Redsys::setMerchantSignature($signature);

            $form = Redsys::createForm();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return view('payment.redsys', compact('form', 'total', 'user', 'description'));
    }

    public function responseMethod(Request $request)
    {
        return view('redsys.response');
    }

    public function notify(Request $request)
    {
        $merchantParams = $request->input('Ds_MerchantParameters');
        $signature = $request->input('Ds_Signature');

        if (!$merchantParams || !$signature) {
            Log::error('Redsys notify: datos incompletos');
            return response('KO', 400);
        }

        if (!$this->validateRedsysSignature($signature, $merchantParams)) {
            Log::error('Redsys notify: firma inválida');
            return response('KO', 403);
        }

        $params = json_decode(base64_decode($merchantParams), true);
        $responseCode = (int) $params['Ds_Response'];

        if ($responseCode > 99) {
            Log::warning('Redsys pago rechazado', $params);
            return response('OK', 200);
        }

        DB::transaction(function () use ($params) {

            $userId = $params['Ds_MerchantData'];
            $user = User::findOrFail($userId);

            $order = Order::create([
                'user_id' => $userId,
                'user_name' => $user->name,
                'total' => $params['Ds_Amount'] / 100,
                'status' => 'paid',
                'ds_order' => $params['Ds_Order'],
                'ds_response' => $params['Ds_Response'],
                'ds_merchant_code' => $params['Ds_MerchantCode'],
            ]);

            $cart = Cart::where('user_id', $userId)->with('product')->get();

            foreach ($cart as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->precio_es,
                ]);
            }

            // Vaciar carrito
            Cart::where('user_id', $userId)->delete();

            // Enviar email de confirmación
            Mail::to(User::find($userId)->email)->send(new OrderConfirmed($order));
        });

        return response('OK', 200);
    }

    public function ok()
    {
        return view('order.confirmation');
    }

    public function ko()
    {
        return view('payment.failure');
    }


    private function validateRedsysSignature($dsSignature, $merchantParams)
    {
        // Normalizar firma URL-safe
        $dsSignature = str_replace(['-', '_'], ['+', '/'], $dsSignature);

        $decodedParams = base64_decode($merchantParams);
        $params = json_decode($decodedParams, true);

        if (!isset($params['Ds_Order'])) {
            return false;
        }

        $order = $params['Ds_Order'];

        // 🔑 AQUÍ SÍ SE DECODIFICA
        $key = base64_decode(config('redsys.key'));

        $derivedKey = openssl_encrypt(
            $order,
            'DES-EDE3-CBC',
            $key,
            OPENSSL_RAW_DATA,
            "\0\0\0\0\0\0\0\0"
        );

        $expectedSignature = base64_encode(
            hash_hmac('sha256', $decodedParams, $derivedKey, true)
        );

        return hash_equals($expectedSignature, $dsSignature);
    }
}
