<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\MainCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;


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
        return view('admin.add-product', compact('mainCategories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'nombre_es' => 'required|max:255',
            'precio_es' => 'required|numeric',
            'precio_oferta_es' => 'nullable|numeric',
            'proveedor' => 'max:255',
            'marca' => 'required|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif',
            'main_category' => 'required|exists:categories,id',
        ]);

        $imagenNombre = $request->file('img')->store('img', 'public');

        $producto = new Product();
        $producto->nombre_es = $request->input('nombre_es');
        $producto->precio_es = $request->input('precio_es');
        $producto->precio_oferta_es = $request->input('precio_oferta_es');
        $producto->proveedor = $request->input('proveedor');
        $producto->marca = $request->input('marca');
        $producto->img = $imagenNombre;
        $producto->main_category_id = $request->input('main_category');
        $producto->save();

        return redirect()->route('admin-agregar-producto')->with('success', 'Producto agregado correctamente');
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

    public function editProductsForm($id)
    {
        $product = Product::findOrFail($id);
        $mainCategories = MainCategory::all();
        return view('admin.edit-products', compact('product', 'mainCategories'));
    }

    public function updateProducts(Request $request, $id)
    {

        $validated = $request->validate([
            'nombre_es' => 'required|string|max:255',
            'precio_es' => 'required|numeric',
            'precio_oferta_es' => 'nullable|numeric',
            'marca' => 'nullable|string|max:255',
            'proveedor' => 'nullable|string|max:255',
            'main_category_id' => 'nullable|exists:main_categories,id',
            'descripcion' => 'nullable|string|max:350',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'El producto no se encontró');
        }

        $product->update($validated);

        return redirect()->route('admin-view-products')->with('success', 'Producto actualizado exitosamente');
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

        // Asumiendo que 'admin' tiene id 1, 'profesional' id 2 y 'particular' id 3
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
}
