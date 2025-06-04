<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeaturedProduct;

class FeaturedProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'apartado_id' => 'required|exists:apartados,id',
        ]);

        FeaturedProduct::create([
            'product_id' => $request->product_id,
            'apartado_id' => $request->apartado_id,
        ]);


        return back()->with('success', 'Producto destacado añadido.');
    }


    public function destroy($id)
    {
        FeaturedProduct::destroy($id);
        return back()->with('success', 'Producto destacado eliminado.');
    }
}
