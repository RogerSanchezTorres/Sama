<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubSubSubcategory;
use Illuminate\Http\Request;

class SubSubSubcategoryController extends Controller
{
    /**
     * Elimina una subsubsubcategoría.
     */
    public function destroy($id)
    {
        $subsubsubcategory = SubSubSubcategory::find($id);

        if (!$subsubsubcategory) {
            return redirect()->back()->with('error', 'La subsubsubcategoría no existe.');
        }

        $subsubsubcategory->delete();

        return redirect()->back()->with('success', 'Subsubsubcategoría eliminada correctamente.');
    }
}
