<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\PaymentExecution;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Exception\PayPalConnectionException;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalConfig = config('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret']
            )
        );

        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function initiatePayment(Request $request)
    {
        // Obtener los productos del carrito del usuario actual
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('product')->get();

        // Calcular el total del carrito
        $total = 0;
        $items = [];

        foreach ($cart as $item) {
            $price = $user->role_id == 2 ? $item->product->precio_oferta_es : $item->product->precio_es;
            $quantity = $item->quantity;
            $total += $price * $quantity;

            $items[] = (new Item())
                ->setName($item->product->nombre)
                ->setCurrency('USD')
                ->setQuantity($quantity)
                ->setPrice($price);
        }

        // Configurar el monto total
        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($total);

        // Configurar el método de pago
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Configurar los elementos de la lista de artículos
        $itemList = new ItemList();
        if (is_array($items) && count($items) > 0) {
            $itemList->setItems($items);
        } else {
            // Manejar el caso en el que $items no es un array o está vacío
            // Por ejemplo, puedes agregar un ítem de prueba si no hay productos en el carrito
            $itemList->setItems([
                (new Item())
                    ->setName('Dummy Item')
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice(0)
            ]);
        }

        // Configurar la transacción
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Descripción del pago');

        // Configurar las URLs de redirección
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('/paypal/status'))
            ->setCancelUrl(url('/paypal/status'));

        // Crear el pago
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            if ($this->apiContext instanceof ApiContext) {
                $payment->create($this->apiContext);
                return redirect()->away($payment->getApprovalLink());
            } else {
                // Manejar el caso en el que $this->apiContext no está configurado correctamente
                return redirect()->back()->with('error', 'Error al procesar el pago. Contexto de API no válido.');
            }
        } catch (PayPalConnectionException $ex) {
            // Manejar errores de conexión con PayPal
            return redirect()->back()->with('error', 'Error al procesar el pago con PayPal. Por favor, inténtelo de nuevo más tarde.');
        }
    }

    // Método para manejar la respuesta de PayPal
    public function paypalStatus(Request $request)
    {
        // Obtener el ID del pago y el PayerID de la solicitud
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        // Validar los datos de la solicitud
        if (!$paymentId || !$payerId) {
            return redirect('/paypal/failed')->with('status', 'Lo sentimos! El pago a través de PayPal no se pudo realizar.');
        }

        // Obtener el objeto de pago desde PayPal
        $payment = Payment::get($paymentId, $this->apiContext);

        // Crear un objeto de ejecución del pago
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        // Ejecutar el pago
        $result = $payment->execute($execution, $this->apiContext);

        // Verificar si el pago fue aprobado
        if ($result->getState() === 'approved') {
            return redirect('/results')->with('status', 'Gracias! El pago a través de PayPal se ha ralizado correctamente.');
        }

        // Redirigir en caso de fallo
        return redirect('/results')->with('status', 'Lo sentimos! El pago a través de PayPal no se pudo realizar.');
    }
}
