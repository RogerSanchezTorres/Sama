<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductoController extends Controller
{
    public function buscar(Request $request)
    {
        $terminoBusqueda = $request->input('termino_busqueda');

        $resultados = \DB::table('products')
            ->where('nombre_es', 'like', '%' . $terminoBusqueda . '%')
            ->paginate(11);
        Paginator::useBootstrapThree(false);

        return view('products.resultados', compact('resultados', 'terminoBusqueda'));
    }
}
