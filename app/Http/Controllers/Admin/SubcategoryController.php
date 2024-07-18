<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);

        if ($subcategory->subsubcategories()->exists()) {
            return redirect()->back()->with('error', 'No se puede eliminar la subcategoría porque tiene subsubcategorías asociadas.');
        }

        $subcategory->delete();
        return redirect()->back()->with('success', 'Subcategoría eliminada exitosamente.');
    }
}
