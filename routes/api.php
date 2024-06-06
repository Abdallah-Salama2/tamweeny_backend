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
Route::get('/images', [ProductController::class, 'store']);
//Route::get('/admin-cards/create', [AdminCardController::class, 'create'])->name('admin-cards.create');
//Route::get('/admin-card', [AdminCardController::class, 'showAdminCards']);

Route::get('/testttttt',[UserController::class,'testtt']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/cardRegistration', [AdminCardController::class, 'store']);
Route::get('/test2', [AdminCardController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);
//Route::post('/login', [DeliveryAuthController::class, 'login']);
Route::get('/send-data', [ProductController::class, 'sendData']);

//Route::get('/model', [Orders_madeController::class, 'model']);
Route::get('/modelProducts', [ProductController::class,'model']);            //Products
Route::get('/modelUsers', [UserController::class,'index']);            //Products
Route::get('/tokenAndName', [UserController::class,'tokenAndName']);            //Products
Route::get  ('/recommendations', [ProductController::class, 'getRecommendations']);
//Route::post('/send-token', [FlaskController::class, 'sendDataToFlaskAPI']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

//Route::get('/userss', [UserController::class, 'index']);                //Users
//Route::get('/ay7aga', [AuthController::class, 'ay7aga']);                //Users

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/ay7aga', [UserController::class, 'ay7aga']);                //Users


//    Route::resource('user',UserController::class)->only(['index','update','destroy']);
//    Route::get('userBalance', 'userBalance');

    Route::controller(UserController::class)->name('customer.')->group(function () {

        Route::patch('updateAccInfo', 'updateUserInfo');
        Route::get('isNew', 'isNewUser')->name("newUser");       //Users
        Route::get('search/{name}', 'search');
        Route::get('users/{id?}', 'findUser');
        Route::get('userData', 'getLoggedInUserData');
        Route::get('orderedBefore', 'orderedBefore');                //Users
        Route::get('userBalance', 'userBalance');
        Route::Delete('deleteAccount', 'destroy');

    });


    Route::resource('/categories',CategoryController::class)->only(['index','show'])->scoped(['category'=>'category_name']);

//    Route::controller(CategoryController::class)->group(function () {
//        Route::get('/categories', 'index');        //Categories
//        Route::get('/categories/{catName}', 'productsByCategory');
//    });

    Route::get('/recommended', [ProductController::class,'recommendedProducts']);            //Products
//    Route::resource('products',ProductController::class)->only(['index']);

    Route::get("/products/{product}",[ProductController::class,'show']);
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');// ['@role customer , delviery']//Products
        Route::get('/productId/{product?}', 'searchForProductById');
        Route::get('/productName/{product?}', 'searchForProductByName');
        Route::get('/offers', 'offers');       //ProductPricing
    });
    Route::get('/fillStoresProducts', [ProductController::class, 'fillStoreProductsTable']);
    Route::get('/recommendedProducts2', [ProductController::class, 'recommendedProducts2']);


//    Route::resource("/favorites",FavoriteController::class)->only(["index","show"]);
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
        Route::get('/fullOrder', 'fullOrder');
        Route::get('/modelOrders', 'modelOrders');
        Route::get('/fullPendingOrders', 'fullPendingOrders');
        Route::get('/fullDeliveredOrders', 'fullDeliveredOrders');
        Route::get('/orderDetails/{orderId}', 'OrdersDetails');

    });


    Route::controller(StoreController::class)->group(function () {
        Route::get('/stores', 'index');               //Stores
        Route::get('/storesLatLong', 'showLatLong');  //StoresLatLang

    });



//    Route::get('/model', [Orders_madeController::class, 'ordersForModel']);
    Route::get('/customers', [CustomerController::class, 'index']);         //Customers
    Route::get('/owners', [StoreOwnerController::class, 'index']);
    Route::get('/cards', [CardController::class, 'index']);
    Route::get('/test', [TestController::class, 'index']);
    Route::post('/test22', [TestController::class, 'store']);


});


Route::post("/upload", [FIleController::class, 'upload']);
////Route::get(' / test2',[CategoryController::class, 'test']);
////Route::get(' / test3',[CategoryController::class, 'test2']);
//Route::post(' / fake', [AuthController::class, 'fake2']);
//Route::get(' / test',[ProductController::class, 'test']);
//
//Route::get(' / users',[AuthController::class, 'test']);


