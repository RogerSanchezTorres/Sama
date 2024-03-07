<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Exception\PayPalConnectionException;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret']
            )
        );

        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function payWithPaypal(Request $request)
    {
        $amount = $request->amount;

        if (!is_numeric($amount)) {
            return redirect()->back()->with('error', 'El amount proporcionado no es válido.');
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName('Producto')
            ->setCurrency('€')
            ->setQuantity(1)
            ->setPrice($amount);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('€')
            ->setTotal($amount);

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            $sandboxBaseUrl = config('paypal.sandbox.base_url');
            $approvalLink = $payment->getApprovalLink();

            return redirect()->away($sandboxBaseUrl . $approvalLink);
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }


    public function PaypalSatatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/paypal/failed')->with(compact('status'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            return redirect('/results')->with(compact('status'));
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/results')->with(compact('status'));
    }

    /*public function showPaymentForm()
    {
        $user_id = Auth::id();

        $amount = Cart::where('user_id', $user_id)->with('product')->get();

        if ($role_id = 2) {
            $cartTotal = $amount->sum(function ($item) {
                return $item->quantity * $item->product->precio_oferta_es;
            });
        } else {
            $cartTotal = $amount->sum(function ($item) {
                return $item->quantity * $item->product->precio_es;
            });
        }

        return view('payment.form', compact('cartTotal'));
    }*/
}
