<?php

use App\Http\Controllers\Api\AdminCardController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\FlaskController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\Orders_madeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\StoreOwnerController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\FIleController;
use App\Http\Controllers\PythonController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Auth Endpoints
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::post('/cardRegistration', [AdminCardController::class, 'store']);

// End Points For Recommendations Python Model
Route::get('/modelProducts', [ProductController::class, 'model']);            //Products
Route::get('/modelUsers', [UserController::class, 'index']);            //Products
Route::get('/run-python', [\App\Http\Controllers\Admin\CardsController::class, 'runPythonScript']);


//Only authenticated users may access this group of routes.
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::controller(UserController::class)->name('customer.')->group(function () {

        Route::patch('updateAccInfo', 'updateUserInfo');
        Route::get('search/{name}', 'search');
        Route::get('users/{id?}', 'findUser');
        Route::get('userData', 'getLoggedInUserData');
        Route::get('orderedBefore', 'orderedBefore');                //Users
        Route::get('userBalance', 'userBalance');
        Route::Delete('deleteAccount', 'destroy');

    });


    Route::resource('/categories', CategoryController::class)->only(['index', 'show'])->scoped(['category' => 'category_name']);

//    Route::controller(CategoryController::class)->group(function () {
//        Route::get('/categories', 'index');        //Categories
//        Route::get('/categories/{catName}', 'productsByCategory');
//    });



    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/productId/{product?}', 'searchForProductById');
        Route::get('/productName/{product?}', 'searchForProductByName');
        Route::get('/offers', 'offers');
        Route::get('/recommended','recommendedProducts');            //Products
        Route::get('/fillStoresProducts','fillStoreProductsTable');
        Route::get('/recommendedProducts2','recommendedProducts2');
    });

    Route::controller(FavoriteController::class)->group(function () {
        Route::get('/favorites', 'index');          //Favorites
        Route::post('favorite/{productId}', 'add');
    });

    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'index');
        Route::put('/cart/{productId?}/{operator?}', 'update');
        Route::delete('/cart/{productId}', 'delete');

    });


    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');                //Orders
        Route::post('/createOrder', 'create');
        Route::post('/order/{orderId}', 'addToDelivered');
    });

    Route::controller(Orders_madeController::class)->group(function () {
        Route::get('/ordersMade', 'index');
        Route::get('/modelOrders', 'modelOrders');
        Route::get('/fullPendingOrders', 'fullPendingOrders');
        Route::get('/fullDeliveredOrders', 'fullDeliveredOrders');
        Route::get('/fullOnHoldOrders', 'fullOnHoldOrders');
        Route::get('/orderDetails/{orderId}', 'OrdersDetails');

    });


    Route::controller(StoreController::class)->group(function () {
        Route::get('/stores', 'index');               //Stores
        Route::get('/storesLatLong', 'showLatLong');  //StoresLatLang

    });


    Route::get('/cards', [CardController::class, 'index']);



}); 





