<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\SubSubSubcategory;

class MainCategoryController extends Controller
{
    public function index()
    {
        $maincategories = MainCategory::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $subsubcategories = SubSubcategory::all();
        $subsubsubcategories = SubSubSubcategory::all();

        return view('admin.categories.index', compact('maincategories', 'categories', 'subcategories', 'subsubcategories', 'subsubsubcategories'));
    }

    public function destroy($id)
    {
        $maincategory = MainCategory::findOrFail($id);

        if ($maincategory->categories()->exists()) {
            return redirect()->back()->with('error', 'No se puede eliminar la categoría principal porque tiene categorías asociadas.');
        }

        $maincategory->delete();
        return redirect()->back()->with('success', 'Categoría principal eliminada exitosamente.');
    }
}
