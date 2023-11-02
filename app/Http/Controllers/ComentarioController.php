<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Product;

class ComentarioController extends Controller
{
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'contenido' => 'required'
        ]);

        $comentario = new Comentario();
        $comentario->usuario_id = auth()->user()->id;
        $comentario->producto_id = $id;
        $comentario->contenido = $request->input('contenido');
        $comentario->save();

        return redirect()->back()->with('success', 'Comentario publicado con éxito');
    }

    public function update(Request $request, $id)
{
    $comentario = Comentario::find($id);

    if (auth()->user()->id === $comentario->usuario->id) {
        $comentario->contenido = $request->input('contenido');
        $comentario->save();

        $product = Product::findOrFail($id);
        $comentarios = $product->comentarios;

        return redirect()->back()->with('product', 'comentarios');
    }
}

}
