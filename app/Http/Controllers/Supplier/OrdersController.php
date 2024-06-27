<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orders_made;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ownerId = auth()->user()->id;
        $store = Store::where("owner_id", $ownerId)->first();
        $name = $request->input('name', '');


        // Fetch all store's products at once
        $storeProductIds = $store->products()->pluck('products.id')->toArray();

        $ordersQuery = Order::with('customer', 'delivery', 'order_made')
            ->orderBy('order_date', 'desc');

        if ($name) {
            $ordersQuery->whereHas('customer', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        }

        $orders = $ordersQuery->get();
//        dd($orders);
        $filteredOrders = collect();

        foreach ($orders as $order) {
            $ordersMade = Orders_made::where("order_id", $order->id)->get();
            $allProductsExist = true;

            foreach ($ordersMade as $item) {
                $product = Product::find($item->product_id);
                if (!in_array($product->id, $storeProductIds)) {
//                    dd($product->id);
                    $allProductsExist = false;
                    break;
                }
            }

            if ($allProductsExist) {
                $filteredOrders->push($order);
            }
        }

        $deliveries = User::where('user_type', 'Delivery')->get();
        $users = User::with('card', 'order')->where('user_type', 'Customer')->get();

        return Inertia::render('Suppliers/Orders/Index', [
            'orders' => $filteredOrders,
            'deliveries' => $deliveries,
            'users' => $users,
            'name' => $name
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $orderId)
    {
//        dd($request);
        $store = Store::where("owner_id", $request->owner_id)->first();
        $order = Order::find($orderId);
        $delivery = User::where('name', $request->delivery_name)->first();
        $orders_made = Orders_made::where("order_id", $order->id)->get();
//        dd($orders_made);
        foreach ($orders_made as $item) {
            $product = Product::find($item->product_id);
            $pivotRecord = $store->products()->where('product_id', $item->product_id)->first()->pivot;
            $currentQuantity = $pivotRecord->quantity;
            $newQuantity = $item->quantity;

//            dd($pivotRecord);
            $store->products()->updateExistingPivot($product, ['quantity' => $currentQuantity - $newQuantity]);
        }
        if ($order && $delivery) {
            $order->delivery_id = $delivery->id;
            $order->delivery_status = "Pending";
            $order->store_id = $store->id;
            $order->save();

//            return response()->json(['success' => true, 'message' => 'Delivery assigned successfully']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
