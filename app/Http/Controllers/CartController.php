<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function addProduct(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
        }

        $user_id = auth()->id();
        $cartItem = Cart::where('user_id', $user_id)->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito',
            'product' => [
                'nombre' => $product->nombre_es,
                'precio' => $product->precio_es,
            ],
        ]);
    }

    public function showCart()
    {
        $user_id = auth()->id();
        $cart = Cart::where('user_id', $user_id)->with('product')->get();
        $cartTotal = $cart->sum(function ($item) {
            return $item->quantity * $item->product->precio_es;
        });

        return view('products.cart', compact('cart', 'cartTotal'));
    }

    public function remove($productId)
    {
        if (session()->has('cart')) {

            $cart = session()->get('cart', []);
            unset($cart[$productId]);
            session()->put('cart', $cart);

            return redirect()->route('cart.show')->with('success', 'Producto eliminado del carrito');
        }

        return redirect()->route('cart.show')->with('error', 'Error al eliminar el producto del carrito');
    }

    public function updateQuantity($productId, Request $request)
    {
        $cart = json_decode(session('cart', '{}'), true);
        $cartItem = &$cart[$productId];
        $cartItem['quantity'] = $request->input('quantity');
        session(['cart' => $cart]);

        return redirect()->route('carrito.mostrar');
    }
}
