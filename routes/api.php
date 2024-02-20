<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\CatetgoryController;
use App\Http\Controllers\Api\CustomerController;
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
Route::post('/fake', [AuthController::class, 'fake2']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::get('/test',[ProductController::class, 'test']);

//Route::get('/test3',[CatetgoryController::class, 'test2']);

Route::get('/users',[AuthController::class, 'test']);


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('/test',[\App\Http\Controllers\TestController::class,'index']);

    Route::post('/test22',[\App\Http\Controllers\TestController::class,'store']);

    Route::post('updateUserInfo',[AuthController::class,'updateUserInfo']);

    Route::get('/userss',[AuthController::class, 'index']);
    Route::get('/customers',[CustomerController::class, 'index']);
    Route::get('/owners',[StoreOwnerController::class, 'index']);
    Route::get('/cards',[CardController::class, 'index']);

    Route::get('/categories',[CatetgoryController::class, 'index']);
    Route::get('/products',[ProductController::class, 'index']);
    Route::get('/offers',[ProductPricingController::class, 'index']);
    Route::get('/orders',[OrderController::class, 'index']);
    Route::get('/stores',[StoreController ::class, 'index']);
    Route::get('/storesLatLong',[StoreController ::class, 'showLatLong']);


    Route::get('/categories/{catName}',[ProductController::class, 'productsByCategory']);
    Route::get('/productId/{product}',[ProductController::class, 'searchForProductById']);
    Route::get('/productName/{product}',[ProductController::class, 'searchForProductByName']);
    Route::get('/search/{name}',[AuthController::class,'search']);
    Route::get('/userss/{id?}',[AuthController::class,'findUser']);






});


Route::post("/upload",[\App\Http\Controllers\FIleController::class, 'upload']);
//Route::get('/test2',[CatetgoryController::class, 'test']);

