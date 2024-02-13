<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/fake', [\App\Http\Controllers\Api\AuthController::class, 'fake2']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/products',[\App\Http\Controllers\Api\ProductController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/userss',[\App\Http\Controllers\Api\AuthController::class, 'index']);
    //http://127.0.0.1:8000/api/userss
    Route::get('/categories',[\App\Http\Controllers\Api\CatetgoryController::class, 'index']);
    //http://127.0.0.1:8000/api/categories
    //http://127.0.0.1:8000/api/products
    Route::get('/offers',[\App\Http\Controllers\Api\ProductPricingController::class, 'index']);
    //http://127.0.0.1:8000/api/offers
    Route::get('/stores',[\App\Http\Controllers\Api\StoreController ::class, 'index']);
    //http://127.0.0.1:8000/api/stores
    Route::get('/storesLatLong',[\App\Http\Controllers\Api\StoreController ::class, 'showLatLong']);
    //http://127.0.0.1:8000/api/storesLatLong
    Route::get('/categories/{catName}',[\App\Http\Controllers\Api\ProductController::class, 'productsByCategory']);
    //http://127.0.0.1:8000/api/categories/اخرى
    Route::get('/productsId/{product}',[\App\Http\Controllers\Api\ProductController::class, 'searchForProductById']);
    //http://127.0.0.1:8000/api/productsId/2
    Route::get('/productsName/{product}',[\App\Http\Controllers\Api\ProductController::class, 'searchForProductByName']);
        //http://127.0.0.1:8000/api/productsName/ارز
    Route::get('/search/{name}',[AuthController::class,'search']);
    //http://127.0.0.1:8000/api/search/Tux

    Route::get('/userss/{id?}',[AuthController::class,'findUser']);
    //http://127.0.0.1:8000/api/userss/2
    // UI FEN YA ABO 3LA2


});


Route::post("/upload",[\App\Http\Controllers\FIleController::class, 'upload']);
