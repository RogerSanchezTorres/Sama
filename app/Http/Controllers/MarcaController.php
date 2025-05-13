<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BrandImage;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Product::whereNotNull('marca')
            ->where('marca', '!=', '')
            ->select('marca')
            ->distinct()
            ->pluck('marca');

        return view('marcas.index', compact('marcas'));
    }


    public function show($marca)
    {
        $products = Product::where('marca', $marca)->paginate(16);
        Paginator::useBootstrapThree(false);
        return view('marcas.show', compact('products', 'marca'));
    }


    public function uploadView()
    {
        $marcas = Product::select('marca')->distinct()->pluck('marca');
        return view('marcas.upload', compact('marcas'));
    }


    public function storeBrandImage(Request $request)
    {
        $request->validate([
            'marca' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->storeAs('brand_images', $request->file('image')->getClientOriginalName(), 'public');

        BrandImage::create([
            'marca' => $request->marca,
            'image_path' => $path,
        ]);

        return back()->with('success', 'Imagen de marca subida correctamente.');
    }
}
