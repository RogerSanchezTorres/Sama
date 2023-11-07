<?php

namespace App\Http\Controllers;


class CartController extends Controller
{
    public function showCart()
    {
        $cart = session('cart', []);
        $cartTotal = array_sum(array_column($cart, 'price'));

        return view('cart', compact('cart', 'cartTotal'));
    }

    public function removeProduct($productId)
    {
        $cart = session('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId) {
                unset($cart[$key]);
            }
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.show');
    }

    public function checkout()
    {
        session(['cart' => []]);

        return redirect()->route('cart.show')->with('message', 'Compra realizada con éxito.');
    }
}
