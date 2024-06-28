<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;

class SubCategoryController extends Controller
{
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->back()->with('success', 'Subcategoría eliminada exitosamente.');
    }
}
