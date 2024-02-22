<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\CatetgoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductPricingController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\StoreOwnerController;
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
Route::get('/images',[ProductController::class, 'store'] );


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);




Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('favorite/{productId}',[FavoriteController::class,'add']);

    Route::get('/test',[\App\Http\Controllers\TestController::class,'index']);
    Route::post('/test22',[\App\Http\Controllers\TestController::class,'store']);

    Route::post('updateAccInfo',[AuthController::class,'updateUserInfo']);
    Route::Delete('deleteAccount',[AuthController::class,'deleteUser']);

    Route::get('/userss',[AuthController::class, 'index']);                //Users
    Route::get('/customers',[CustomerController::class, 'index']);         //Customers
    Route::get('/owners',[StoreOwnerController::class, 'index']);
    Route::get('/cards',[CardController::class, 'index']);

    Route::get('/categories',[CatetgoryController::class, 'index']);        //Categories
    Route::get('/products',[ProductController::class, 'index']);            //Products
    Route::get('/favorites',[FavoriteController::class, 'index']);          //Favorites
    Route::get('/offers',[ProductPricingController::class, 'index']);       //ProductPricing
    Route::get('/orders',[OrderController::class, 'index']);                //Orders
    Route::get('/stores',[StoreController ::class, 'index']);               //Stores
    Route::get('/storesLatLong',[StoreController ::class, 'showLatLong']);  //StoresLatLang


    Route::get('/categories/{catName}',[ProductController::class, 'productsByCategory']);
    Route::get('/productId/{product}',[ProductController::class, 'searchForProductById']);
    Route::get('/productName/{product}',[ProductController::class, 'searchForProductByName']);
    Route::get('/search/{name}',[AuthController::class,'search']);
    Route::get('/userss/{id?}',[AuthController::class,'findUser']);






});


Route::post("/upload",[\App\Http\Controllers\FIleController::class, 'upload']);
////Route::get('/test2',[CatetgoryController::class, 'test']);
////Route::get('/test3',[CatetgoryController::class, 'test2']);
//Route::post('/fake', [AuthController::class, 'fake2']);
//Route::get('/test',[ProductController::class, 'test']);
//
//Route::get('/users',[AuthController::class, 'test']);

