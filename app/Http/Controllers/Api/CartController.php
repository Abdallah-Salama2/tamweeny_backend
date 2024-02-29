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
            ], 409);
        }


        $productPricing = (double)$product->productpricing->selling_price;


        $cart = cart::create([
            'customer_id' => $customerId,
            'product_id' => $productId,
            'quantity' => (int)$quantity,
            'total_price' => $productPricing * $quantity,
        ]);
        $cart->save();
        return response()->json([
            'message' => 'Item Added To Cart Successfully',
        ], 200);


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
    public function update(Request $request)
    {
        $userId = $request->user()->id;
        $users = User::with('customer', 'customer.card')->get();
        $user = $users->where("id", $userId)->first();


        $productId = $request->input('product_id');


        // Find the cart record for the given product ID
        $cart = Cart::where('product_id', $productId)->first();

        if ($cart) {
            // If the cart record exists, update the quantity
            $quantity = $request->input('quantity');
            $cart->quantity = $quantity;
            $cart->total_price = $cart->product->productpricing->selling_price * $cart->quantity; // Assuming product price is stored in the product model

            $cart->save();
            return response()->json(['message' => 'Cart updated successfully']);

        } else {
            // If the cart record doesn't exist, create a new record
            $customerId = $user->customer->id;
            $productPrice = Product::findOrFail($productId)->productpricing->selling_price;
            Cart::create([
                'customer_id'=>$customerId,
                'product_id' => $productId,
                //'total_price' => $productPrice * $quantity,
            ]);
            return response()->json(['message' => 'Cart item created successfully']);

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function test2()
    {
        $cartItem = Cart::find(1); // Change 1 to the ID of the cart item you want to edit

    }

    public function test()
    {
        $cartItem = Cart::find(1); // Change 1 to the ID of the cart item you want to edit
        print($cartItem);

        return view("editCart", compact('cartItem'));
    }
}
