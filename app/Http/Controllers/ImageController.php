<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    // Función para mostrar las imágenes en la vista
    public function index()
    {
        // Obtiene todas las imágenes de la base de datos
        $images = Image::all();
        return view('index', compact('images'));
    }

    // Subir una nueva imagen
    public function upload(Request $request)
    {
        try {
            // Validación de la imagen
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif'
            ]);

            // Guardar la imagen
            $imagePath = $request->file('image')->store('images', 'public');

            // Guardar en la base de datos
            $image = new Image();
            $image->path = 'storage/' . $imagePath;
            $image->save();

            // Devolver respuesta JSON
            return response()->json([
                'success' => true,
                'id' => $image->id,
                'url' => asset($image->path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al subir la imagen',
            ], 500);
        }
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



    public function destroyStatic($name)
    {
        $imagePath = public_path('img/' . $name);

        if (file_exists($imagePath)) {
            unlink($imagePath); // Eliminar la imagen del servidor
            return response()->json(['success' => true, 'message' => 'Imagen eliminada correctamente.']);
        }

        return response()->json(['success' => false, 'message' => 'La imagen no existe o no se pudo eliminar.']);
    }
}
