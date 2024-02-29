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
use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalConfig = config('services.paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['client_secret']
            )
        );

        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function showPaymentForm()
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
    }


    public function processPayment(Request $request)
    {
        $monto = $request->monto;

        if (!is_numeric($monto)) {
            return redirect()->back()->with('error', 'El monto proporcionado no es válido.');
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName('Producto')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($monto); // Ajusta el precio según tu lógica de negocio

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($monto); // Ajusta el total según tu lógica de negocio

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Descripción de la compra');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.execute'))
            ->setCancelUrl(route('payment.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->apiContext);
            return Redirect::away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            return redirect()->back()->with('error', 'Hubo un problema al procesar el pago. Por favor, inténtalo de nuevo.');
        }
    }

    public function executePayment(Request $request)
    {
        $paymentId = $request->paymentId;
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            return redirect()->route('payment.success')->with('success', 'El pago se ha realizado con éxito.');
        } catch (PayPalConnectionException $ex) {
            return redirect()->route('payment.failure')->with('error', 'Hubo un problema al procesar el pago. Por favor, inténtalo de nuevo.');
        }
    }

    public function paymentSuccess()
    {
        return view('payment.success');
    }

    public function paymentFailure()
    {
        return view('payment.failure');
    }
}
