<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\Proveedor;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::orderBy('order', 'asc')->get();
        $proveedores = Proveedor::all();

        return view('index', compact('images', 'proveedores'));
    }

    public function upload(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $imagePath = $request->file('image')->store('images', 'public');

            $image = new Image();
            $image->path = 'storage/' . $imagePath;
            $image->save();

            return response()->json([
                'success' => true,
                'id' => $image->id,
                'url' => asset($image->path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir la imagen: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function updateOrder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $index => $id) {
            Image::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Orden actualizado correctamente.']);
    }




    public function destroy($id)
    {
        $image = Image::find($id);

        if ($image) {
            $imagePath = public_path($image->path);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $image->delete();

            return response()->json(['success' => true, 'message' => 'Imagen eliminada con éxito.']);
        }

        return response()->json(['success' => false, 'message' => 'Imagen no encontrada.']);
    }


    public function uploadProveedor(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imagePath = $request->file('image')->store('proveedores', 'public');

            $proveedor = new Proveedor();
            $proveedor->path = 'storage/' . $imagePath;
            $proveedor->save();

            return response()->json([
                'success' => true,
                'id' => $proveedor->id,
                'url' => asset($proveedor->path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir la imagen: ' . $e->getMessage(),
            ], 500);
        }
    }



    public function deleteProveedor($id)
    {
        try {
            $proveedor = Proveedor::findOrFail($id); // Asegurarse de que el proveedor existe
            $proveedor->delete(); // Eliminar el proveedor

            return response()->json(['success' => true]); // Responder en JSON
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar la imagen: ' . $e->getMessage()], 500);
        }
    }
}
