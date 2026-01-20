<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubSubSubSubcategory;
use App\Models\MainCategory;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\SubSubSubcategory;
use Illuminate\Http\Request;

class SubSubSubSubcategoryController extends Controller
{
    public function create()
    {
        return view('admin.create_subsubsubsubcategory', [
            'mainCategories' => MainCategory::all(),
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
            'subsubcategories' => SubSubcategory::all(),
            'subsubsubcategories' => SubSubSubcategory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'slug' => 'required|unique:sub_sub_sub_subcategories,slug',
            'main_category_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'sub_subcategory_id' => 'required',
            'sub_sub_subcategory_id' => 'required',
        ]);

        SubSubSubSubcategory::create($request->all());

        return back()->with('success', 'SubSubSubSubcategoría creada correctamente');
    }

    public function destroy($id)
    {
        $subsubsubsubcategory = SubSubSubSubcategory::find($id);

        if (!$subsubsubsubcategory) {
            return redirect()->back()->with('error', 'La subsubsubsubcategoría no existe.');
        }

        $subsubsubsubcategory->delete();

        return redirect()->back()->with('success', 'Subsubsubsubcategoría eliminada correctamente.');
    }
}
