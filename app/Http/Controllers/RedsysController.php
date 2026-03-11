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
use App\Mail\OrderAdminNotification;


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
        try {

            $merchantParams = $request->input('Ds_MerchantParameters');
            $signature = $request->input('Ds_Signature');

            if (!$merchantParams || !$signature) {
                Log::error('Redsys notify: datos incompletos');
                return response('OK', 200);
            }

            if (!Redsys::check($merchantParams, $signature)) {
                Log::error('Firma Redsys inválida');
                return response('OK', 200);
            }

            $params = Redsys::decodeMerchantParameters($merchantParams);
            $params = json_decode($params, true);

            if (!is_array($params)) {
                Log::error('Error decodificando parámetros Redsys', [
                    'raw' => $merchantParams
                ]);
                return response('OK', 200);
            }

            Log::info('Datos Redsys recibidos', $params);

            $response = (int) $params['Ds_Response'];

            DB::beginTransaction();

            $orderId = $params['Ds_MerchantData'];

            $order = Order::lockForUpdate()->find($orderId);

            if (!$order) {
                Log::error('Pedido no encontrado');
                return response('OK', 200);
            }

            // evitar duplicados
            if ($order->status == 'paid') {
                DB::commit();
                return response('OK', 200);
            }

            $order->update([
                'status' => 'paid',
                'ds_response' => $params['Ds_Response'],
                'authorization_code' => $params['Ds_AuthorisationCode']
            ]);

            $cart = Cart::where('user_id', $order->user_id)->with('product')->get();

            foreach ($cart as $item) {

                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->precio_es
                ]);

                // actualizar stock
                $item->product->decrement('stock', $item->quantity);
            }

            Cart::where('user_id', $order->user_id)->delete();

            DB::commit();
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Error notify Redsys', [
                'error' => $e->getMessage()
            ]);
        }

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
}
