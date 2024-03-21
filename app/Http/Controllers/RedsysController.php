<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Ssheduardo\Redsys\Facades\Redsys;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

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
        $message = $request->all();
        if (isset($message['Ds_MerchantParameters'])) {
            $decode = json_decode(base64_decode($message['Ds_MerchantParameters']), true);
            $date = urldecode($decode['Ds_Date']);
            $hour = urldecode($decode['Ds_Hour']);
            $decode['Ds_Date'] = $date;
            $decode['Ds_Hour'] = $hour;
        }

        return response()->json(['success' => true, 'message' => $message, 'decode' => $decode]);
    }

    public function ko(Request $request)
    {
        return response()->json(['success' => false, 'message' => $request->all()]);
    }

    public function notification()
    {
    }
}
