<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MainCategory;
use App\Models\Category;
use Illuminate\Pagination\Paginator;


class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $mainCategories = MainCategory::all();
        $categories = Category::all();

        return view('products.index', compact('products', 'mainCategories', 'categories'));
    }

    public function showByMainCategory($mainCategoryId)
    {
        $mainCategory = MainCategory::findOrFail($mainCategoryId);
        $products = $mainCategory->products()->paginate(14);
        Paginator::useBootstrapThree(false);

        return view('products.show_by_main_category', compact('products', 'mainCategory'));
    }


    /*public function showByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $products = $category->products()->whereNotNull('img')->get();

        return view('products.show_by_category', compact('products', 'category'));
    }*/


    public function showDetail($id)
    {
        $product = Product::findOrFail($id);

        return view('products.product_detail', compact('product'));
    }
}
