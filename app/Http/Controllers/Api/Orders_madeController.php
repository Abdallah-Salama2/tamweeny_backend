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
    public function ordersForModel(Request $request)
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
        return response()->json(modelResource::collection($ordersMade));

    }

//    public function fullOrder(Request $request)
//    {
//        //
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
//        //print ("CustomerId " . $customerId . "\n");
//
//        $ordersMade = Orders_made::where("customer_id", $customerId)->get();
//        $order_ids = $ordersMade->pluck('order_id')->unique();
//        $orders = [];
//
//        foreach ($order_ids as $order_id) {
//            $order = Order::where("id", $order_id)->first();
//            if ($order) {
//                $orders[] = new OrderResource($order);
//            }
//        }
//
//        foreach ($orders as $order) {
//            print(json_encode($order->jsonSerialize()) . PHP_EOL);
//        }
//        return response()->json([
//            "orderCreated" => $orders,
//            "cartItemsInOrder" => Orders_madeResource::collection($ordersMade)
//        ]);
//    }

    public function fullOrder(Request $request)
    {
        $userId = $request->user()->id;

        // Fetch user and related data
        $users = User::with('customer', 'customer.card')->get();
        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $customerId = $user->customer->id;


        $orderId = Session::get("orderId");
//        print($orderId);
        $orders = Order::find($orderId);
        $ordersMade = Orders_made::where("order_id", $orderId)->get();
        return response()->json([
                'Order' => new OrderResource($orders),
                'Products in order' => Orders_madeResource::collection($ordersMade)
            ]
        );

    }


    public function fullorders(Request $request)
    {
        $userId = $request->user()->id;

        // Fetch user and related data
        $users = User::with('customer', 'customer.card')->get();
        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $customerId = $user->customer->id;
        $orders = Order::where("customer_id", $customerId)->get();

        $responseData = [];

        foreach ($orders as $order){
            $orderData = new OrderResource2($order);

            // Fetch and format ordersMade data
            $orderData['ordersMade'] = Orders_madeResource::collection(
                Orders_made::where("order_id", $order->id)->get()
            );

            $responseData[] = $orderData;
        }

        // Return JSON response with the combined data
        return response()->json($responseData);
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
