<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Setting;

class CartController extends Controller
{
    public function addProduct(Request $request, $productId)
    {
        // Si no hay usuario logueado → no permitir
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'requires_login' => true,
                'message' => 'Debes iniciar sesión para añadir productos al carrito.'
            ]);
        }

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
        }

        $user_id = auth()->id();
        $cartItem = Cart::where('user_id', $user_id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        $cartCount = Cart::where('user_id', $user_id)->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito',
            'cart_count' => $cartCount,
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
        
        $cart = $cart->filter(fn($item) => $item->product !== null);

        Cart::where('user_id', $user_id)
            ->whereDoesntHave('product')
            ->delete();



        $role = auth()->user()->role ?? null;
        $roleName = $role ? $role->role : null;

        $cartTotal = $cart->sum(function ($item) use ($roleName) {
            $product = $item->product;
            if (!$product) return 0;

            if ($roleName === 'profesional' && !is_null($product->precio_oferta_es)) {
                $price = $product->precio_oferta_es;
            } else {
                $price = $product->precio_es ?? 0;
            }

            return $item->quantity * $price;
        });
        $shopEnabled = Setting::shopEnabled();

        return view('products.cart', compact('cart', 'cartTotal', 'shopEnabled'));
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
