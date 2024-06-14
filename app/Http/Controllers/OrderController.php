<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function confirmation()
    {
        return view('order.confirmation');
    }

    public function failure()
    {
        return view('payment.failure');
    }
}
