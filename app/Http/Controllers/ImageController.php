<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\Proveedor;

class ImageController extends Controller
{
    // Función para mostrar las imágenes en la vista
    public function index()
    {
        // Obtiene todas las imágenes de la base de datos
        $images = Image::orderBy('order', 'asc')->get();
        $proveedores = Proveedor::all();

        return view('index', compact('images', 'proveedores'));
    }

    // Subir una nueva imagen
    public function upload(Request $request)
    {
        try {
            // Validar que se suba una imagen y que exista el product_id
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'product_id' => 'required|exists:products,id',
            ]);

            // Guardar la imagen
            $imagePath = $request->file('image')->store('images', 'public');

            // Guardar en la base de datos
            $image = new Image();
            $image->path = 'storage/' . $imagePath;
            $image->product_id = $request->input('product_id');
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




    // Eliminar imagen
    public function destroy($id)
    {
        // Encontrar la imagen en la base de datos
        $image = Image::find($id);

        if ($image) {
            // Eliminar el archivo físico de la imagen del almacenamiento
            $imagePath = public_path($image->path); // Asegúrate de que `public_path` es la ruta correcta

            if (file_exists($imagePath)) {
                unlink($imagePath); // Elimina el archivo de imagen del almacenamiento
            }

            // Eliminar el registro de la base de datos
            $image->delete();

            return response()->json(['success' => true, 'message' => 'Imagen eliminada con éxito.']);
        }

        return response()->json(['success' => false, 'message' => 'Imagen no encontrada.']);
    }



    // Método para mostrar las imágenes de proveedores
    public function proveedores()
    {
        $proveedores = Storage::files('img/logos_proveedores');
        return view('tu_vista_proveedores', compact('proveedores'));
    }

    // Método para subir una nueva imagen de proveedor
    public function addProveedor(Request $request)
    {
        if ($request->hasFile('file')) {
            // Sube la imagen al almacenamiento
            $path = $request->file('file')->store('public/img/logos_proveedores');
            $relativePath = str_replace('public/', 'storage/', $path);

            // Guarda la ruta en la base de datos
            $proveedor = new Proveedor();
            $proveedor->path = $relativePath; // Asegúrate de que la columna en la tabla sea 'path'
            $proveedor->save();

            // Devuelve la ruta para mostrar la imagen en el frontend
            return response()->json(['path' => asset($relativePath)], 200);
        }

        return response()->json(['error' => 'No se ha recibido ninguna imagen.'], 400);
    }


    // Método para eliminar una imagen de proveedor
    public function deleteProveedor($id)
    {
        $proveedor = Proveedor::find($id);

        if ($proveedor) {
            // Eliminar la imagen del almacenamiento
            Storage::delete(str_replace('storage/', '', $proveedor->path));
            // Eliminar el registro de la base de datos
            $proveedor->delete();

            return redirect()->back()->with('success', 'Proveedor eliminado correctamente.');
        }

        return redirect()->back()->with('error', 'Proveedor no encontrado.');
    }
}
