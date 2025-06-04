<?php

namespace App\Http\Controllers;

use App\Models\Apartado;
use Illuminate\Http\Request;

class ApartadoController extends Controller
{
    public function index()
    {
        $apartados = Apartado::all();
        return view('admin.apartados.index', compact('apartados'));
    }

    public function create()
    {
        return view('admin.apartados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Apartado::create($request->only('nombre'));

        return redirect()->route('apartados.index')->with('success', 'Apartado creado correctamente.');
    }

    public function edit(Apartado $apartado)
    {
        return view('admin.apartados.edit', compact('apartado'));
    }

    public function update(Request $request, Apartado $apartado)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $apartado->update($request->only('nombre'));

        return redirect()->route('apartados.index')->with('success', 'Apartado actualizado correctamente.');
    }

    public function destroy(Apartado $apartado)
    {
        $apartado->delete();

        return redirect()->route('apartados.index')->with('success', 'Apartado eliminado correctamente.');
    }
}
