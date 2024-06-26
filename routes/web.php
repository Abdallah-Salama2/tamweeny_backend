<?php

use App\Http\Controllers\Admin\CardsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\Products\AdminProductsController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Supplier\OffersController;
use App\Http\Controllers\Supplier\OrdersController;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/get-permissions', function () {
    return auth()->check() ? auth()->user()->jsPermissions() : 0;
});
Route::get('/', function () {
    Debugbar::info('INFO');

    return Inertia::render('Auth/Login', [
        'status' => session('status'),
    ]);
});
//Ucant name storage
//Route::get('/',[AuthenticatedSessionController::class,'create']);


Route::middleware('auth')->group(function () {
    Route::get('/admin/index', [AdminProductsController::class, 'index'])->middleware(['auth',])->name('admin.product.index');
    Route::get('/admin/product/create', [AdminProductsController::class, 'create'])->middleware(['auth'])->name('admin.product.create');
    Route::post('/admin/product', [AdminProductsController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/product/{product}/edit', [AdminProductsController::class, 'edit'])->middleware(['auth'])->name('admin.product.edit');
    Route::post('/admin/product/{product}', [AdminProductsController::class, 'update'])->middleware(['auth'])->name('admin.product.update');
    Route::delete('/admin/product/{product}/deleteImage', [AdminProductsController::class, 'deleteProductImg'])->middleware(['auth'])->name('admin.product.productImage.delete');

    Route::get('admin/users', [UserController::class, 'customerIndex'])->name('admin.customer.index');
    Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('admin/deliverys', [UserController::class, 'deliveryIndex'])->name('admin.delivery.index');
    Route::get('admin/suppliers', [UserController::class, 'supplierIndex'])->name('admin.supplier.index');
    Route::get('admin/addAccount', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('admin/addUser/{userType}', [UserController::class, 'store'])->name('admin.user.store');

    Route::get('/admin/offers', [OffersController::class, 'index'])->middleware(['auth'])->name('admin.offer.index');
    Route::get('/admin/stores/index', [StoreController::class, 'index'])->middleware(['auth'])->name('admin.store.index');
    Route::post('/admin/stores', [StoreController::class, 'edit'])->middleware(['auth'])->name('admin.store.update');

    Route::get('supplier/orders', [OrdersController::class, 'index'])->name('supplier.order.index');
    Route::post('supplier/orders/{orderId}', [OrdersController::class, 'update'])->name('supplier.order.update');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/product/{product}', [AdminProductsController::class, 'destroy'])->name('admin.product.destroy');

    Route::resource('/admin/categories', CategoryController::class)
        ->only(['index', 'show'])->names([
            'index' => 'admin.categories.index',
            'show' => 'admin.categories.show',
        ]);
    Route::get('/admin/cards', [CardsController::class, 'index'])->middleware(['auth',])->name('admin.card.index');
    Route::post('/admin/cards', [CardsController::class, 'update'])->middleware(['auth',])->name('admin.card.update');
    Route::get('/test-flash', function () {
        return redirect()->route('admin.product.index');
    })->middleware('test.flash');

//    Route::resource('order',\App\Http\Controllers\Api\OrderController::class);
});

require __DIR__ . '/auth.php';
