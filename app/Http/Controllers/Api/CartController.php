<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductPricing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $userId = $request->user()->id;
        //print("UserID " . $userId . "\n");
        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();
        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
        //print ("CustomerId " . $customerId . "\n");


        $customerCart = Cart::where("customer_id", $customerId)->get();

        //$favorites=Favorite::all();

        return response()->json(CartResource::Collection($customerCart));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $productId, $quantity)
    {
        //
//        //
        $userId = $request->user()->id;
        //print("UserID " . $userId . "\n");

        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();

        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
        //$customerId=3;
        //print ("CustomerId " . $customerId . "\n");

        $product = Product::where("id", $productId)->first();

        $productInCart = Cart::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->first();

        if ($productInCart) {
            // Handle the case where the product already exists in the cart
             return response()->json([
                'message' => 'Product already exists in cart.',
            ],409);
        }



        $productPricing = (double) $product->productpricing->selling_price;


        $cart = cart::create([
            'customer_id' => $customerId,
            'product_id' => $productId,
            'quantity' => (int)$quantity,
            'total_price'=> $productPricing*$quantity,
        ]);
        $cart->save();
        return response()->json([
            'message' => 'Item Added To Cart Successfully',
        ],200);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
