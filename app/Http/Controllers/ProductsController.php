<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MainCategory;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\MinorCategory;
use App\Models\SubSubSubcategory;


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
        $products = $mainCategory->products()->paginate(16);
        Paginator::useBootstrapThree(false);
        $categories = $mainCategory->categories;

        return view('products.show_by_main_category', compact('products', 'mainCategory', 'categories'));
    }


    public function showProductsByCategory($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        $relatedCategories = $category->mainCategory->categories;

        $productIds = DB::table('category_product')
            ->where('category_id', $category->id)
            ->pluck('product_id')
            ->toArray();

        $products = Product::where('category_id', $category->id)->paginate(16);
        Paginator::useBootstrapThree(false);

        return view('products.show_by_category', compact('products', 'category', 'relatedCategories'));
    }

    public function showProductsBySubcategory($subcategorySlug)
    {
        $subcategory = Subcategory::where('slug', $subcategorySlug)->firstOrFail();
        $category = $subcategory->category;
        $relatedCategories = $category->mainCategory->categories;
        $products = Product::where('subcategory_id', $subcategory->id)->paginate(16);
        Paginator::useBootstrapThree(false);

        return view('products.show_by_subcategory', compact('products', 'subcategory', 'relatedCategories'));
    }

    public function showProductsBySubsubcategory($subsubcategorySlug)
    {
        $subsubcategory = SubSubcategory::where('slug', $subsubcategorySlug)->firstOrFail();
        $subcategory = $subsubcategory->subcategory; // Subcategoría padre
        $category = $subcategory->category; // Categoría padre

        $relatedCategories = $category->mainCategory->categories; // Categorías relacionadas

        $products = Product::where('subcategory_id', $subcategory->id)->paginate(16);
        Paginator::useBootstrapThree(false);

        return view('products.show_by_subsubcategory', compact('products', 'subsubcategory', 'relatedCategories'));
    }

    public function showProductsBySubsubsubcategory($subsubsubcategorySlug)
    {
        // Buscar la subsubsubcategoría por slug
        $subsubsubcategory = SubSubSubcategory::where('slug', $subsubsubcategorySlug)->firstOrFail();

        // Obtener jerarquía hacia arriba
        $subsubcategory = $subsubsubcategory->subSubcategory; // SubSubcategoría padre
        $subcategory = $subsubcategory->subcategory; // Subcategoría
        $category = $subcategory->category; // Categoría

        // Categorías relacionadas (las que pertenecen a la misma categoría principal)
        $relatedCategories = $category->mainCategory->categories;

        // Filtrar productos por la subsubsubcategoría seleccionada
        $products = Product::where('sub_sub_subcategory_id', $subsubsubcategory->id)->paginate(16);

        // Ajustar estilo del paginador
        Paginator::useBootstrapThree(false);

        // Retornar la vista correspondiente
        return view('products.show_by_subsubsubcategory', compact('products', 'subsubsubcategory', 'relatedCategories'));
    }


    public function deleteProductImage($id, $index)
    {
        $product = Product::findOrFail($id);

        // Decodificar las imágenes del producto
        $images = json_decode($product->img, true) ?? [];

        if (isset($images[$index])) {
            // Eliminar la imagen físicamente del almacenamiento
            $imagePath = public_path($images[$index]);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Eliminar la imagen del array
            unset($images[$index]);

            // Reindexar el array y guardarlo de nuevo
            $product->img = json_encode(array_values($images));
            $product->save();
        }

        return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
    }


    public function showDetail($id)
    {
        $product = Product::findOrFail($id);
        $comentarios = $product->comentarios;

        return view('products.product_detail', compact('product', 'comentarios'));
    }

    public function showImportForm()
    {
        return view('import-form');
    }
}
