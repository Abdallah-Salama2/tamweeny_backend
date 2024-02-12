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


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/userss',[\App\Http\Controllers\Api\AuthController::class, 'index']);
    Route::get('/categories',[\App\Http\Controllers\Api\CatetgoryController::class, 'index']);
    Route::get('/products',[\App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('/offers',[\App\Http\Controllers\Api\ProductPricingController::class, 'index']);
    Route::get('/stores',[\App\Http\Controllers\Api\StoreController ::class, 'index']);
    Route::get('/storesLatLong',[\App\Http\Controllers\Api\StoreController ::class, 'showLatLong']);
    Route::get('/categories/{catName}',[\App\Http\Controllers\Api\ProductController::class, 'productsByCategory']);
    Route::get('/products/{productName}',[\App\Http\Controllers\Api\ProductController::class, 'searchForProduct']);
    Route::get("search/{id}",[AuthController::class,'search']);
    Route::get('/userss/{id?}',[AuthController::class,'findUser']);



});


Route::post("/upload",[\App\Http\Controllers\FIleController::class, 'upload']);
