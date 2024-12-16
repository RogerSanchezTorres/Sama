<?php

namespace App\Http\Controllers;

use App\Models\MinorCategory;
use App\Models\SubSubcategory;
use Illuminate\Http\Request;

class MinorCategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'slug' => 'required|unique:minor_categories,slug|max:255',
            'subsubcategory_id' => 'required|exists:subsubcategories,id',
        ]);

        MinorCategory::create($validated);

        return redirect()->back()->with('success', 'Minor Category creada exitosamente');
    }
}
