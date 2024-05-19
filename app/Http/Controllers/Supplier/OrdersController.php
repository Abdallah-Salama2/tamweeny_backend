<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer', 'delivery')
            ->orderBy('order_date', 'desc')
            ->get();
//        dd($orders);
        $deliveries = User::where('user_type', 'Delivery')->get();

        return Inertia::render('Suppliers/Orders/Index', [
            'orders' => $orders,
            'deliveries' => $deliveries

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
        $order = Order::find($orderId);
        $delivery = User::where('name', $request->delivery_name)->first();

        if ($order && $delivery) {
            $order->delivery_id = $delivery->id;
            $order->delivery_status="Pending";
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
