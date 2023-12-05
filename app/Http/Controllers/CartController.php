<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

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
        $user_id = auth()->id();

        $cartItem = Cart::where('user_id', $user_id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();

            return redirect()->route('cart.show')->with('success', 'Producto eliminado del carrito');
        }

        return redirect()->route('cart.show')->with('error', 'Error al eliminar el producto del carrito');
    }


    public function updateQuantity(Request $request)
    {
        $cartData = $request->input('cart');

        if ($cartData) {
            foreach ($cartData as $productId => $productData) {
                $cartItem = Cart::where('product_id', $productId)->first();

                if ($cartItem) {
                    $cartItem->quantity = $productData['quantity'];
                    $cartItem->save();
                }
            }

            return redirect()->route('cart.show');
        }

        return response()->json(['error' => 'No se proporcionaron datos válidos.']);
    }
}
