<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use Illuminate\Http\Request;

class SubSubcategoryController extends Controller
{
    public function index()
    {
        $mainCategories = MainCategory::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $subsubcategories = SubSubcategory::all();

        return view('admin.manage_subsubcategories', compact('mainCategories', 'categories', 'subcategories', 'subsubcategories'));
    }

    public function destroy($id)
    {
        $subsubcategory = SubSubcategory::findOrFail($id);
        $subsubcategory->delete();

        return redirect()->back()->with('success', 'Subsubcategoría eliminada exitosamente.');
    }
}
