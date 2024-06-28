<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->subcategories()->exists()) {
            return redirect()->back()->with('error', 'No se puede eliminar la categoría porque tiene subcategorías asociadas.');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Categoría eliminada exitosamente.');
    }
}
