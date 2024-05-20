<?php

use App\Http\Controllers\Api\AdminCardController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\Orders_madeController;
use App\Http\Controllers\Api\ProductPricingController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\StoreOwnerController;
use App\Http\Controllers\FIleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\ProductController;
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
Route::get('/images', [ProductController::class, 'store']);
//Route::get('/admin-cards/create', [AdminCardController::class, 'create'])->name('admin-cards.create');
//Route::get('/admin-card', [AdminCardController::class, 'showAdminCards']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/cardRegistration', [AdminCardController::class, 'store']);
Route::get('/test2', [AdminCardController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/userss', [AuthController::class, 'index']);                //Users

Route::group(['middleware' => 'auth:sanctum'], function () {

//Route::controller(AuthController::class)->group(function (){});

    Route::group(['middleware' => ['role:customer']],function (){

    });

    Route::get('/isNew', [AuthController::class, 'isNewUser']);                //Users
    Route::get('/orderedBefore', [AuthController::class, 'orderedBefore']);                //Users
    Route::get('/search/{name}', [AuthController::class, 'search']);
    Route::get('/userss/{id?}', [AuthController::class, 'findUser']);
    Route::get('/userData', [AuthController::class, 'getLoggedInUserData']);
    Route::get('/userBalance', [AuthController::class, 'userBalance']);
    Route::patch('updateAccInfo', [AuthController::class, 'updateUserInfo']);
    Route::Delete('deleteAccount', [AuthController::class, 'deleteUser']);


    Route::get('/model', [Orders_madeController::class, 'ordersForModel']);

    Route::get('/customers', [CustomerController::class, 'index']);         //Customers

    Route::get('/cards', [CardController::class, 'index']);


    Route::get('/categories', [CategoryController::class, 'index']);        //Categories


    Route::get('/categories/{catName}', [ProductController::class, 'productsByCategory']);
    Route::get('/products', [ProductController::class, 'index']);            //Products
    Route::get('/products2', [ProductPricingController::class, 'create']);            //Products
    Route::get('/recommended', [ProductController::class, 'recommendedProducts']);            //Products
//    Route::get('/productId/product?}', [ProductController::class, 'searchForProductById']);// now product optional u need to give it default value in function since its not required

//    Route::get('/productName/{product?}', [ProductController::class, 'searchForProductByName2']);
//    Route::get('/productName', [ProductController::class, 'emptyList']);
    Route::get('/offers', [ProductController::class, 'offers']);       //ProductPricing

    Route::get('/favorites', [FavoriteController::class, 'index']);          //Favorites
//    Route::post('favorite/{productId}', [FavoriteController::class, 'add']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::put('/cart/{productId}/{operator}', [CartController::class, 'update']);
    Route::delete('/cart/{productId}', [CartController::class, 'delete']);


    Route::get('/orders', [OrderController::class, 'index']);                //Orders
    Route::post('/createOrder', [OrderController::class, 'store']);
    Route::get('/ordersMade', [Orders_madeController::class, 'index']);
    Route::get('/fullOrder', [Orders_madeController::class, 'fullOrder']);
    Route::get('/fullorders', [Orders_madeController::class, 'fullorders']);


    Route::get('/owners', [StoreOwnerController::class, 'index']);
    Route::get('/stores', [StoreController ::class, 'index']);               //Stores
    Route::get('/storesLatLong', [StoreController ::class, 'showLatLong']);  //StoresLatLang

    Route::get('/test', [TestController::class, 'index']);
    Route::post('/test22', [TestController::class, 'store']);


});


Route::post("/upload", [FIleController::class, 'upload']);
////Route::get('/test2',[CategoryController::class, 'test']);
////Route::get('/test3',[CategoryController::class, 'test2']);
//Route::post('/fake', [AuthController::class, 'fake2']);
//Route::get('/test',[ProductController::class, 'test']);
//
//Route::get('/users',[AuthController::class, 'test']);

