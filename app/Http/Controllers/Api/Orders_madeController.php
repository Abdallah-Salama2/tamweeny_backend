<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\modelResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderResource2;
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
//        $userId = $request->user()->id;
//        $user = User::with('customer', 'customer.card')->find($userId);
//        $customerId = $user->customer->id;
        $customerId = auth()->user()->customer->id;

        $ordersMade = Orders_made::where("customer_id", $customerId)->get();
        return response()->json(Orders_madeResource::collection($ordersMade));
    }

    /**
     * Display orders for a model.
     */
    public function ordersForModel(Request $request)
    {
//        $userId = $request->user()->id;
//        $user = User::with('customer', 'customer.card')->find($userId);
//        $customerId = $user->customer->id;
        $customerId = auth()->user()->customer->id;


        $ordersMade = Orders_made::where("customer_id", $customerId)->get();
        return response()->json(modelResource::collection($ordersMade));
    }

    /**
     * Display full order details.
     */
    public function fullOrder(Request $request)
    {
//        $userId = $request->user()->id;
//        $user = User::with('customer', 'customer.card')->find($userId);
//        if (!$user) {
//            return response()->json(['error' => 'User not found'], 404);
//        }

        $orderId = Session::get("orderId");
        $orders = Order::find($orderId);
        $ordersMade = Orders_made::where("order_id", $orderId)->get();

        return response()->json([
            'Order' => new OrderResource($orders),
            'Products in order' => Orders_madeResource::collection($ordersMade)
        ]);
    }

    /**
     * Display full orders.
     */
    public function fullOrders(Request $request)
    {
//        $userId = $request->user()->id;
//        $user = User::with('customer', 'customer.card')->find($userId);
//        if (!$user) {
//            return response()->json(['error' => 'User not found'], 404);
//        }
//
//        $customerId = $user->customer->id;
        $customerId = auth()->user()->customer->id;

        $orders = Order::where("customer_id", $customerId)->get();

        $responseData = [];

        foreach ($orders as $order){
            $orderData = new OrderResource2($order);
            $orderData['ordersMade'] = Orders_madeResource::collection(
                Orders_made::where("order_id", $order->id)->get()
            );
            $responseData[] = $orderData;
        }

        return response()->json($responseData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation needed here if applicable
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
