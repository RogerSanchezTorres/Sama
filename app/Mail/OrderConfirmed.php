<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Mail\Mailable;

class OrderConfirmed extends Mailable
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Confirmación de pedido #' . $this->order->id)
            ->view('emails.order_confirmed')
            ->with([
                'order' => $this->order,
                'products' => $this->order->products
            ]);
    }
}
