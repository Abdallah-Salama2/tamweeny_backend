<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orders_made;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//        $userId = $request->user()->id;
//
//        // Fetch user and related data
//        $users = User::with('customer', 'customer.card')->get();
//        // Retrieve the user from the collection by ID
//        $user = $users->where("id", $userId)->first();
//        if (!$user) {
//            return response()->json(['error' => 'User not found'], 404);
//        }
//        // Check if the user has a customer associated with them
//        if (!$user->customer) {
//            return response()->json(["message" => "Customer not found for this user"], 404);
//        }
//
//
//        $customerId = $user->customer->id;
        $customerId = auth()->user()->customer->id;

        //print("CustomerId " . $customerId . "\n");

        $customerOrders = Order::where("customer_id", $customerId)->get();
        //print($customerOrders);

        return response()->json(OrderResource::collection($customerOrders));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        //
//        $userId = $request->user()->id;
//        //print("UserID " . $userId . "\n");
//        // Fetch all users with related data
//        $users = User::with('customer', 'customer.card')->get();
//        // Retrieve the user from the collection by ID
//        $user = $users->where("id", $userId)->first();
//        //print($user);
//
//        $customerId = $user->customer->id;
        $customerId = auth()->user()->customer->id;

        //print ("CustomerId " . $customerId . "\n");


        //$customerCartItemPrices = Cart::where("customer_id", $user->customer->id)->pluck("total_price");

        $customerCart = Cart::where("customer_id",$customerId)->get();
        // Check if the cart is empty
        if ($customerCart->isEmpty()) {
            return response()->json([
                'message' => 'Cart is empty. Order not created.',
            ], 400);
        }

        $total = $customerCart->sum('total_price');


        $order = Order::create([
            "order_date" => now(),
            "order_price" => $total,
            "customer_id" => $customerId,
        ]);

        Session::put("orderId", $order->id);

        foreach ($customerCart as $cartItem) {
            Orders_made::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id, // Assuming cart_item_id should be the cart item's ID
                'product_name' => $cartItem->product->product_name,
                'quantity' => $cartItem->quantity,
                'total_price' => $cartItem->total_price,
                'customer_id' => $customerId
            ]);

            // Increment the order_count for the product
            $product = Product::find($cartItem->product_id);
            $product->increment('order_count');
        }


        //Delete cart items associated with the order
        foreach ($customerCart as $cartItem) {
            $cartItem->delete();
        }

        return response()->json([
            'message' => 'Order created successfully',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
