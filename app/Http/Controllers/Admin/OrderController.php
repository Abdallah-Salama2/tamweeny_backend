<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $name = $request->input('name', '');

        $orders = Order::with('customer', 'delivery')
            ->orderBy('order_date', 'desc');
        if ($name) {
            $orders = $orders->whereHas('customer', function($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });        }
//        dd($name);
        $orders=$orders->get();
        return Inertia::render('Admin/Orders/Index', [
            'orders' => $orders,
        ]);
    }
}
