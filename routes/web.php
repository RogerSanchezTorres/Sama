<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

//LOGIN Y REGISTER
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

//CONTACTO
Route::get('/contacto', [ContactController::class, 'showContactForm'])->name('show');
Route::post('/contacto', [ContactController::class, 'enviarMensaje'])->name('submit');

//USUARIOS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user-dashboard');
    Route::get('/user/account', [UserController::class, 'account'])->name('user-account');
    Route::put('/user/update-personal-details', [UserController::class, 'updatePersonalDetails'])->name('user-update-personal-details');
    Route::put('/user/update-billing-details', [UserController::class, 'updateBillingDetails'])->name('user-update-billing-details');
    Route::put('/user/update-password', [UserController::class, 'updatePassword'])->name('user-update-password');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user-delete');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

//ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/view-products', [AdminController::class, 'viewProducts'])->name('admin-view-products');
    Route::get('/admin/edit-products/{id}', [AdminController::class, 'editProductsForm'])->name('admin-edit-products');
    Route::put('/admin/update-products/{id}', [AdminController::class, 'updateProducts'])->name('admin-update-products');
    Route::delete('/admin/delete-products/{product}', [AdminController::class, 'deleteProducts'])->name('admin-delete-products');
    Route::get('/admin/search-products', [AdminController::class, 'searchProducts'])->name('admin-search-products');
    Route::get('/admin/view-users', [AdminController::class, 'viewUsers'])->name('admin-view-users');
    Route::get('/admin/edit-user/{user}', [AdminController::class, 'editUserForm'])->name('admin-edit-user');
    Route::put('/admin/update-user/{user}', [AdminController::class, 'updateUser'])->name('admin-update-user');
    Route::delete('/admin/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('admin-delete-user');
    Route::get('/admin/search-users', [AdminController::class, 'searchUsers'])->name('admin-search-users');
    Route::get('/admin/create-user', [AdminController::class, 'createUserForm'])->name('admin-create-user');
    Route::post('/admin/store-user', [AdminController::class, 'storeUser'])->name('admin-store-user');
    Route::get('/admin/agregar-producto', [AdminController::class, 'createProduct'])->name('admin-agregar-producto');
    Route::post('/admin/store-producto', [AdminController::class, 'storeProduct'])->name('admin-store-producto');
    Route::get('/import-form', [ImportController::class, 'showImportForm'])->name('showImportForm');
    Route::post('/import-list-excel', [ImportController::class, 'importExcel'])->name('products.import.excel');
});

//PRODUCTOS
Route::get('/productos', [ProductsController::class, 'index'])->name('products.index');
Route::get('producto/{id}', [ProductsController::class, 'showDetail'])->name('products.showDetail');
Route::get('/productos/categoria/{categoryId}', [ProductsController::class, 'showByCategory'])->name('products.showByCategory');
Route::get('/productos/main_category/{mainCategoryId}', [ProductsController::class, 'showByMainCategory'])->name('products.showByMainCategory');
Route::post('/producto/{id}/comentario', [ComentarioController::class, 'store'])->name('comentario.store')->middleware('auth');
Route::put('/comentario/{id}', [ComentarioController::class, 'update'])->name('comentario.update');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add/{productId}', [CartController::class, 'addProduct'])->name('cart.add');
Route::get('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/products/category/{categorySlug}', [ProductsController::class, 'showProductsByCategory'])->name('products.showProductsByCategory');




//INFORMACION DE LA EMPRESA
Route::get('/quienes-somos', function () {
    return view('/quienes-somos');
})->name('quienes-somos');

Route::get('/aviso-legal', function () {
    return view('/aviso-legal');
})->name('aviso-legal');

Route::get('/politica-de-cookies', function () {
    return view('/cookies');
})->name('cookies');

Route::get('/politicas-de-privacidad', function () {
    return view('/privacidad');
})->name('privacidad');

Route::get('/contactenos', function () {
    return view('/contacto');
})->name('contacto');


//BUSCADOR
Route::get('/buscar-productos', [ProductoController::class, 'buscar'])->name('products.buscar');


//COMPRAR
Route::middleware(['auth'])->group(function () {
    Route::get('/comprar', [CompraController::class, 'index'])->name('comprar.index');
});
