<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\Orders_madeResource;
use App\Models\Order;
use App\Models\Orders_made;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Orders_madeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        $userId = $request->user()->id;
        //print("UserID " . $userId . "\n");
        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();
        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
        //print ("CustomerId " . $customerId . "\n");


        $ordersMade = Orders_made::where("customer_id", $customerId)->get();
        return response()->json(Orders_madeResource::collection($ordersMade));

    }

    public function fullOrder(Request $request)
    {
        //

        $userId = $request->user()->id;
        //print("UserID " . $userId . "\n");
        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();
        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
        //print ("CustomerId " . $customerId . "\n");


        $ordersMade = (Orders_made::where("customer_id", $customerId)->get());
        $order_id = $ordersMade->pluck('order_id')->first();
        //print("ORDER_ID:" . $order_id . "\n");
        $order = Order::where("id", $order_id)->first();
        //print($order);

        return response()->json([
            "orderCreated" => new OrderResource($order),
            "cartItemsInOrder" => Orders_madeResource::collection($ordersMade)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders_made $orders_made)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders_made $orders_made)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders_made $orders_made)
    {
        //
    }
}
