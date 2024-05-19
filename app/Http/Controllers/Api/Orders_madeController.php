<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\modelResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderResource2;
use App\Http\Resources\Orders_madeResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Orders_made;
use App\Models\Product;
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

        $customerId = auth()->user()->id;

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
        $customerId = auth()->user()->id;


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
    public function fullPendingOrders(Request $request)
    {

//        $customerId = auth()->user()->id;
        $orders =OrderResource2::collection( Order::where('delivery_status','Pending')->get());


        foreach ($orders as $order) {
            $orderData = new OrderResource2($order);
            $orderData['ordersMade'] = Orders_madeResource::collection(
                Orders_made::where("order_id", $order->id)->get()
            );
        }

        return response()->json($orders);
    }
    public function fullDeliveredOrders(Request $request)
    {
        // Fetch all delivered orders
        $orders = Order::where('delivery_status', 'Delivered')->get();

        // Initialize an array to store formatted order data
        $formattedOrders = [];

        foreach ($orders as $order) {
            // Retrieve order details
            $orderData = new OrderResource2($order);

            // Retrieve items of the order
            $orderData['ordersMade'] = Orders_madeResource::collection(
                Orders_made::where("order_id", $order->id)->get()
            );

            // Push the formatted order data into the array
            $formattedOrders[] = $orderData;
        }

        // Return JSON response with formatted orders
        return response()->json($formattedOrders);
    }
    public function modelOrders(Request $request)
    {
        // Fetch all delivered orders
        $orders = Orders_made::with('product','product.category')->get();

        // Extract category names from each order and count occurrences
        $categoryCounts = $orders->mapToGroups(function($order) {
            return [$order->product->category->category_name => 1];
        })->map(function($item) {
            return count($item);
        });

        // Sort categories by count in descending order
        $sortedCategories = $categoryCounts->sortDesc();

        // Get the top two categories
        $topCategories = $sortedCategories->take(2)->keys();

        // Recommend two products from each of the top two categories
        $recommendations = [];
        foreach ($topCategories as $category) {
            $products = Product::whereHas('category', function ($query) use ($category) {
                $query->where('category_name', $category);
            })->inRandomOrder()->take(2)->get();
            $recommendations[$category] = $products;
        }

        // Return JSON response with recommendations
        return response()->json($recommendations);
    }

//    public function model(Request $request)
//    {
//
////        $customerId = auth()->user()->id;
//        $orders =OrderResource2::collection( Order::where('delivery_status','Delivered')->get());
////        $customers=Customer::all();
//        foreach ($orders as $order) {
//            $orderData = new OrderResource2($order);
//            $orderData['ordersMade'] = Orders_madeResource::collection(
//                Orders_made::where("order_id", $order->id)->get()
//            );
//        }
//
//        return response()->json($orders);
//    }
    public function OrdersDetails(Request $request, $orderId)
    {

//        $customerId = auth()->user()->id;

        $orders = Orders_madeResource::collection(Orders_made::where("order_id", $orderId)->get());
        $order=Order::find($orderId);

        return response()->json([
            'customerName' => Auth()->user()->name,
            'customerPhone' => Auth()->user()->phone_number,
            'customerAddress' => Auth()->user()->street . " " . Auth()->user()->city_state,
            'products'=>$orders,
            'outsidePayments'=>0,
            'insidePayments'=>0,
            'deliveryPrice'=>30,
            'orderPrice'=>$order->order_price,
        ]);
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
