<?php

namespace App\Http\Controllers;

use App\Models\Product;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Product::select('marca')->distinct()->pluck('marca');
        return view('marcas.index', compact('marcas'));
    }


    public function show(Product $marca)
    {
        $products = $marca->products; // Esto usa la relación
        return view('marcas.show', compact('products', 'marca'));
    }
}
