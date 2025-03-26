<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\MainCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\SubSubcategory;
use App\Models\Proveedor;
use App\Models\UploadedFile;
use App\Models\Invoice;

class AdminController extends Controller
{
    public function viewUsers()
    {
        $users = User::all();
        $users = User::paginate(25);
        Paginator::useBootstrapThree(false);
        return view('admin.view-users', compact('users'));
    }

    public function searchUsers(Request $request)
    {
        $search = $request->input('search');


        $users = User::where('name', 'LIKE', "%$search%")
            ->orWhere('surname', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('phoneNumber', 'LIKE', "%$search%")
            ->paginate(25);
        Paginator::useBootstrapThree(false);

        return view('admin.view-users', compact('users'));
    }

    public function editUserForm($user)
    {
        $user = User::findOrFail($user);
        return view('admin.edit-users', compact('user'));
    }

    public function updateUser(Request $request, $user)
    {
        $validated = $request->validate([
            'name' => 'string',
            'surname' => 'string',
            'email' => 'email',
            'phoneNumber' => 'nullable|string',
            'role' => 'in:admin,profesional,particular',
        ]);

        $user = User::findOrFail($user);
        $role_id = 3;
        if ($validated['role'] === 'admin') {
            $role_id = 1;
        } elseif ($validated['role'] === 'profesional') {
            $role_id = 2;
        }
        $user->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
            'phoneNumber' => $validated['phoneNumber'],
            'role_id' => $role_id,
        ]);

        return redirect()->route('admin-view-users')->with('success', 'La información del usuario ha sido actualizada exitosamente.');
    }

    public function createUserForm()
    {
        return view('admin.add-users');
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phoneNumber' => 'nullable|string',
            'role_id' => 'required|in:1,2,3',
        ]);

        $user = new User([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phoneNumber' => $validatedData['phoneNumber'],
            'role_id' => $validatedData['role_id'],
        ]);

        $user->save();

        return redirect()->route('admin-view-users')->with('success', 'Usuario creado correctamente.');
    }

    public function deleteUser($user)
    {
        $user = User::findOrFail($user);
        $user->delete();

        return redirect()->route('admin-view-users')->with('success', 'El usuario ha sido eliminado exitosamente.');
    }

    public function createProduct()
    {
        $mainCategories = MainCategory::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $subsubcategories = SubSubcategory::all();

        return view('admin.add-product', compact('mainCategories', 'categories', 'subcategories', 'subsubcategories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'nombre_es' => 'required|max:255',
            'precio_es' => 'required|numeric',
            'precio_oferta_es' => 'nullable|numeric',
            'proveedor' => 'max:255',
            'referencia' => 'max:255',
            'marca' => 'required|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'main_category_id' => 'required|exists:main_categories,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
        ]);

        $imagenNombre = $request->file('img')->store('img', 'public');
        $pdfNombre = $request->file('pdf') ? $request->file('pdf')->store('pdf', 'public') : null;

        DB::beginTransaction();

        try {
            $producto = new Product();
            $producto->nombre_es = $request->input('nombre_es');
            $producto->precio_es = $request->input('precio_es');
            $producto->precio_oferta_es = $request->input('precio_oferta_es');
            $producto->proveedor = $request->input('proveedor');
            $producto->proveedor = $request->input('referencia');
            $producto->marca = $request->input('marca');
            $producto->img = $imagenNombre;
            $producto->pdf = $pdfNombre;
            $producto->main_category_id = $request->input('main_category_id');
            $producto->category_id = $request->input('category_id');
            $producto->subcategory_id = $request->input('subcategory_id');

            $producto->save();

            DB::commit();

            return redirect()->route('admin-agregar-producto')->with('success', 'Producto agregado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al agregar el producto');
        }
    }


    public function viewProducts()
    {
        $admins = Role::where('role', 'admin')->first()->users;
        $products = Product::with('mainCategory')->paginate(25);
        Paginator::useBootstrapThree(false);
        return view('admin.view-products', compact('admins', 'products'));
    }


    public function searchProducts(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('nombre_es', 'LIKE', "%$search%")
            ->orWhere('precio_es', 'LIKE', "%$search%")
            ->orWhere('proveedor', 'LIKE', "%$search%")
            ->orWhere('marca', 'LIKE', "%$search%")
            ->orWhereHas('mainCategory', function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%$search%");
            })
            ->paginate(25);
        Paginator::useBootstrapThree(false);

        return view('admin.view-products', compact('products'));
    }

    public function bulkDelete(Request $request)
    {
        if ($request->has('product_ids')) {
            Product::whereIn('id', $request->input('product_ids'))->delete();

            $currentPage = $request->input('page', 1);

            return redirect()->route('admin-view-products', ['page' => $currentPage])
                ->with('success', 'Productos eliminados exitosamente.');
        }

        return redirect()->route('admin-view-products')->with('error', 'No se seleccionó ningún producto.');
    }



    public function editProductsForm($id)
    {
        $product = Product::findOrFail($id);
        $mainCategories = MainCategory::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $subsubcategories = SubSubCategory::all();
        $proveedores = Proveedor::all();
        return view('admin.edit-products', compact('product', 'mainCategories', 'categories', 'subcategories', 'subsubcategories', 'proveedores'));
    }


    public function updateProducts(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre_es' => 'required|max:255',
            'precio_es' => 'required|numeric',
            'precio_oferta_es' => 'nullable|numeric',
            'proveedor' => 'max:255',
            'referencia' => 'max:255',
            'marca' => 'nullable|max:255',
            'img*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'delete_pdf' => 'nullable|boolean',
            'main_category_id' => 'required|exists:main_categories,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'subsubcategory_id' => 'nullable|exists:sub_subcategories,id',
            'descripcion' => 'nullable|string|max:5000',
            'detalles_lista' => 'nullable|array',
            'detalles_lista.*' => 'nullable|string|max:5000',
            'delete_images' => 'nullable|array',
            'proveedor_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_proveedor_logo' => 'nullable|boolean',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'El producto no se encontró');
        }

        $product->nombre_es = $validated['nombre_es'];
        $product->precio_es = $validated['precio_es'];
        $product->precio_oferta_es = $validated['precio_oferta_es'];
        $product->proveedor = $validated['proveedor'];
        $product->referencia = $validated['referencia'];
        $product->marca = $validated['marca'];
        $product->main_category_id = $validated['main_category_id'];
        $product->category_id = $validated['category_id'];
        $product->subcategory_id = $validated['subcategory_id'];
        $product->subsubcategory_id = $validated['subsubcategory_id'] ?? null;
        $product->descripcion = $validated['descripcion'];
        $product->detalles_lista = isset($validated['detalles_lista'])
            ? json_encode($validated['detalles_lista'])
            : json_encode([]);
        $product->stock = $validated['stock'];

        $existingImages = json_decode($product->img, true) ?? [];

        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $index) {
                if (isset($existingImages[$index])) {
                    $imagePath = public_path($existingImages[$index]);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    unset($existingImages[$index]);
                }
            }

            $existingImages = array_values($existingImages);
        }

        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $imgFile) {
                $imgPath = $imgFile->store('public/img');
                $imgUrl = Storage::url($imgPath);
                $existingImages[] = $imgUrl;
            }
        }

        $product->img = json_encode($existingImages);

        // Si el usuario ha marcado el checkbox para eliminar el PDF
        if ($request->has('delete_pdf') && $request->delete_pdf == 1) {
            if ($product->pdf) {
                Storage::delete($product->pdf);
                $product->pdf = null;
            }
        }

        // Si se ha subido un nuevo PDF, lo guardamos
        if ($request->hasFile('pdf')) {
            // Eliminar el PDF anterior si existe
            if ($product->pdf) {
                Storage::delete($product->pdf);
            }

            // Guardar el nuevo PDF
            $product->pdf = $request->file('pdf')->store('pdfs', 'public');
        }

        if ($request->hasFile('proveedor_logo')) {
            if ($product->proveedor_logo_path) {
                Storage::delete($product->proveedor_logo_path);
            }

            $logoPath = $request->file('proveedor_logo')->store('public/proveedores');
            $product->proveedor_logo_path = Storage::url($logoPath);
        }

        if ($request->has('delete_proveedor_logo') && $product->proveedor_logo_path) {
            Storage::delete($product->proveedor_logo_path);
            $product->proveedor_logo_path = null;
        }

        $product->save();

        return redirect()->route('admin-view-products')->with('success', 'Producto actualizado exitosamente');
    }
    public function deleteProductPdf($id)
    {
        $product = Product::findOrFail($id);

        if ($product->pdf) {
            Storage::delete($product->pdf); // Elimina el archivo del almacenamiento
            $product->pdf = null;
            $product->save();
        }

        return response()->json(['success' => true]);
    }



    public function deleteProducts($product)
    {
        $product = Product::findOrFail($product);
        $product->delete();

        return redirect()->route('admin-view-products')->with('success', 'El producto ha sido eliminado exitosamente.');
    }

    public function showUserManagement()
    {
        $users = User::where('status', 'pending')->get();
        return view('admin.pending-users', compact('users'));
    }

    public function approveUser(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,profesional,particular',
        ]);

        $roles = [
            'admin' => 1,
            'profesional' => 2,
            'particular' => 3,
        ];

        $roleId = $roles[$request->input('role')];
        $user->role_id = $roleId;
        $user->status = 'approved';
        $user->save();

        return redirect()->route('admin.pending-users')->with('success', 'Usuario aprobado y rol actualizado exitosamente');
    }

    public function createMainCategory()
    {
        return view('admin.create-maincategory');
    }

    public function storeMainCategory(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:main_categories,slug',
        ]);

        MainCategory::create([
            'nombre' => $request->nombre,
            'slug' => $request->slug,
        ]);

        return redirect()->route('admin-create-maincategory')->with('success', 'Maincategory creada correctamente');
    }


    public function createCategory()
    {
        $mainCategories = MainCategory::all();
        return view('admin.create_category', compact('mainCategories'));
    }

    public function storeCategory(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'main_category_id' => 'required|exists:main_categories,id',
        ]);

        // Crear la nueva categoría
        Category::create([
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'main_category_id' => $request->main_category_id,
        ]);

        // Redirigir a la página de administrador o a una página de confirmación
        return redirect()->route('admin.create_category');
    }



    public function createSubcategories()
    {
        $mainCategories = MainCategory::all();
        $categories = Category::all();
        return view('admin.create-subcategories', compact('mainCategories', 'categories'));
    }

    public function storeSubcategories(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'category_id' => 'required|exists:categories,id',
            'main_category_id' => 'required|exists:main_categories,id',
        ]);

        // Crear la nueva subcategoría
        Subcategory::create([
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'main_category_id' => $request->main_category_id,
        ]);

        // Redireccionar con un mensaje de éxito
        return redirect()->route('admin.create-subcategories')->with('success', 'Subcategoría creada exitosamente.');
    }

    public function createSubSubcategory()
    {
        $mainCategories = MainCategory::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.create_subsubcategory', compact('mainCategories', 'categories', 'subcategories'));
    }

    public function storeSubSubcategory(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:sub_subcategories,slug',
            'category_id' => 'required|exists:categories,id',
            'main_category_id' => 'required|exists:main_categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        SubSubcategory::create([
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'main_category_id' => $request->main_category_id,
            'subcategory_id' => $request->subcategory_id,
        ]);

        return redirect()->route('admin.createSubSubcategory')->with('success', 'SubSubcategoría creada correctamente');
    }

    public function showUploadForm()
    {
        // Obtiene todos los usuarios para el select
        $users = User::all();

        // Obtiene solo los usuarios que tienen archivos o facturas para la tabla
        $usersWithFilesOrInvoices = User::whereHas('files')->orWhereHas('invoices')
            ->with(['files', 'invoices'])
            ->get();

        return view('admin.upload-content', compact('users', 'usersWithFilesOrInvoices'));
    }



    public function uploadContent(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'file' => 'required|file|max:10240', // Máx 10MB
        ]);

        $file = $request->file('file');
        $filePath = $file->store('uploads', 'public');

        UploadedFile::create([
            'user_id' => $request->user_id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.upload')->with('success', 'Archivo subido correctamente.');
    }


    public function uploadInvoice(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'file' => 'required|file|max:10240', // Máx 10MB
        ]);

        $file = $request->file('file');
        $filePath = $file->store('invoices', 'public');

        Invoice::create([
            'user_id' => $request->user_id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.upload')->with('success', 'Factura subida correctamente.');
    }

    public function deleteFile($id)
    {
        $file = UploadedFile::find($id);

        if ($file) {
            Storage::disk('public')->delete($file->file_path); // Eliminar archivo del almacenamiento
            $file->delete(); // Eliminar registro de la base de datos
        }

        return redirect()->route('admin.upload')->with('success', 'Archivo eliminado correctamente.');
    }

    public function deleteInvoice($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice) {
            Storage::disk('public')->delete($invoice->file_path); // Eliminar factura del almacenamiento
            $invoice->delete(); // Eliminar registro de la base de datos
        }

        return redirect()->route('admin.upload')->with('success', 'Factura eliminada correctamente.');
    }
}
