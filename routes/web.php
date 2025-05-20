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
use App\Http\Controllers\RedsysController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\SubSubcategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MinorCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\FeaturedProductController;




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

/*Route::get('/', function () {
    return view('index');
})->name('index');*/

Route::get('/', [ImageController::class, 'index'])->name('index');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::post('/news/store', [NewsController::class, 'store'])->name('news.store')->middleware('auth');
Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy')->middleware('auth');


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
    Route::delete('/products/bulk-delete', [AdminController::class, 'bulkDelete'])->name('products.bulk-delete');
    Route::post('/minor-categories/store', [MinorCategoryController::class, 'store'])->name('minor-categories.store');
    Route::delete('/admin/delete-product-pdf/{id}', [AdminController::class, 'deleteProductPdf'])->name('admin.deleteProductPdf');



    Route::get('/admin/search-products', [AdminController::class, 'searchProducts'])->name('admin-search-products');
    Route::get('/admin/agregar-producto', [AdminController::class, 'createProduct'])->name('admin-agregar-producto');
    Route::post('/admin/store-producto', [AdminController::class, 'storeProduct'])->name('admin-store-producto');

    Route::get('/admin/view-users', [AdminController::class, 'viewUsers'])->name('admin-view-users');
    Route::get('/admin/edit-user/{user}', [AdminController::class, 'editUserForm'])->name('admin-edit-user');
    Route::put('/admin/update-user/{user}', [AdminController::class, 'updateUser'])->name('admin-update-user');
    Route::delete('/admin/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('admin-delete-user');
    Route::get('/admin/search-users', [AdminController::class, 'searchUsers'])->name('admin-search-users');
    Route::get('/admin/create-user', [AdminController::class, 'createUserForm'])->name('admin-create-user');
    Route::post('/admin/store-user', [AdminController::class, 'storeUser'])->name('admin-store-user');
    Route::get('/admin/users/pending', [AdminController::class, 'showUserManagement'])->name('admin.pending-users');
    Route::patch('/admin/users/{user}/approve', [AdminController::class, 'approveUser'])->name('admin.approveUser');

    Route::get('/import-form', [ImportController::class, 'showImportForm'])->name('showImportForm');
    Route::post('/import-list-excel', [ImportController::class, 'importExcel'])->name('products.import.excel');


    Route::get('/admin/agregar-categoria', [AdminController::class, 'createCategory'])->name('admin.create_category');
    Route::post('/admin/categories/store', [AdminController::class, 'storeCategory'])->name('admin.store.category');
    Route::get('/admin/get-categories', [AdminController::class, 'Categories'])->name('admin.get.categories');

    Route::get('/admin/crear-maincategoria', [AdminController::class, 'createMainCategory'])->name('admin-create-maincategory');
    Route::post('/admin/guardar-maincategoria', [AdminController::class, 'storeMainCategory'])->name('admin-store-maincategory');

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.view-orders');

    Route::get('/admin/crear-subcategorias', [AdminController::class, 'createSubcategories'])->name('admin.create-subcategories');
    Route::post('/admin/guardar-subcategorias', [AdminController::class, 'storeSubcategories'])->name('admin.store-subcategories');

    Route::get('/admin/categories', [MainCategoryController::class, 'index'])->name('admin.categories.index');

    Route::get('maincategory/delete/{id}', [MainCategoryController::class, 'destroy'])->name('maincategory.delete');
    Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('subcategory/delete/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.delete');
    Route::get('/subsubcategories', [SubSubcategoryController::class, 'index'])->name('subsubcategories.index');
    Route::get('/subsubcategories/{id}', [SubSubcategoryController::class, 'destroy'])->name('subsubcategories.destroy');

    Route::get('admin/create-subsubcategory', [AdminController::class, 'createSubSubcategory'])->name('admin.createSubSubcategory');
    Route::post('admin/store-subsubcategory', [AdminController::class, 'storeSubSubcategory'])->name('admin.storeSubSubcategory');


    Route::post('/upload', [ImageController::class, 'upload'])->name('images.upload');
    Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');
    Route::delete('/admin/image/{id}', [ImageController::class, 'destroy'])->name('admin-delete-image');
    Route::delete('/admin/product/{id}/image/{index}', [ProductsController::class, 'deleteProductImage'])->name('delete-product-image');



    Route::get('/proveedores', [ImageController::class, 'proveedores'])->name('proveedores');
    Route::post('/proveedores/upload', [ImageController::class, 'uploadProveedor'])->name('proveedores.upload');
    Route::delete('/proveedores/{id}', [ImageController::class, 'deleteProveedor'])->name('proveedores.deleteProveedor');
    Route::post('/images/update-order', [ImageController::class, 'updateOrder'])->name('images.updateOrder');

    Route::get('/admin/upload', [AdminController::class, 'showUploadForm'])->name('admin.upload');
    Route::post('/admin/upload', [AdminController::class, 'uploadContent'])->name('admin.uploadContent');
    Route::post('/admin/upload-invoice', [AdminController::class, 'uploadInvoice'])->name('admin.uploadInvoice');
    Route::delete('/admin/delete-file/{id}', [AdminController::class, 'deleteFile'])->name('admin.deleteFile');
    Route::delete('/admin/delete-invoice/{id}', [AdminController::class, 'deleteInvoice'])->name('admin.deleteInvoice');

    Route::post('/admin/news/sort', [NewsController::class, 'sort'])->name('news.sort');

    Route::post('/featured-products', [FeaturedProductController::class, 'store'])->name('featured-products.store');
    Route::delete('/featured-products/{id}', [FeaturedProductController::class, 'destroy'])->name('featured-products.destroy');
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
Route::get('/products/subcategory/{subcategorySlug}', [ProductsController::class, 'showProductsBySubcategory'])->name('products.showProductsBySubcategory');
Route::get('/products/subsubcategoria/{subsubcategorySlug}', [ProductsController::class, 'showProductsBySubsubcategory'])->name('products.showProductsBySubsubcategory');
Route::get('/products/minorcategory/{minorCategorySlug}', [ProductsController::class, 'showProductsByMinorCategory'])->name('products.showProductsByMinorCategory');

Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas.index');
Route::get('/marcas/{marca}', [MarcaController::class, 'show'])->name('marcas.show');
Route::post('/marcas/imagen', [MarcaController::class, 'storeBrandImage'])->name('marcas.storeImage');
Route::get('/admin/marcas/upload', [MarcaController::class, 'uploadView'])->name('admin.brand-image-upload');












//METODOS DE PAGO
/*Route::get('/redsys/pay', [RedsysController::class, 'index'])->name('redsys');
Route::middleware(['convert.get.to.post'])->group(function () {
    Route::match(['get', 'post'], 'redsys/ok', [RedsysController::class, 'ok'])->name('redsys.ok');
});
Route::post('/redsys/ko', [RedsysController::class, 'ko'])->name('redsys.ko');
Route::post('/redsys/notification', [RedsysController::class, 'handleResponse'])->name('redsys.notification');
Route::get('/redsys/response', [RedsysController::class, 'responseMethod'])->name('redsys.response');


Route::get('/order/confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');

Route::get('/payment/failure', [OrderController::class, 'failure'])->name('payment.failure');*/

Route::get('redsys/pay', [RedsysController::class, 'index'])->name('redsys');
Route::middleware(['convert.get.to.post'])->group(function () {
    Route::match(['get', 'post'], 'redsys/ok', [RedsysController::class, 'ok'])->name('redsys.ok');
    Route::match(['get', 'post'], 'redsys/response', [RedsysController::class, 'handleResponse'])->name('redsys.response');
    Route::match(['get', 'post'], 'redsys/ko', [RedsysController::class, 'ko'])->name('redsys.ko');
});


Route::get('order/confirmation', function () {
    return view('order.confirmation');
})->name('order.confirmation');
Route::get('payment/failure', function () {
    return view('payment.failure');
})->name('payment.failure');




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
