<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userId = Session::get('user_id');
        print("UserID " . $userId . "\n");
        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();
        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
        print ("CustomerId " . $customerId . "\n");


        $customerCartItemPrices = Cart::where("customer_id", $user->customer->id)->pluck("total_price");
        print($customerCartItemPrices."\n");

        $customerCart =Cart::where("customer_id", $user->customer->id)->get();
        $customerOrders=Order::where("customer_id", $user->customer->id)->get();

        //Cart::where("customer_id", $user->customer->id)->get()

        return response()->json([
            OrderResource::collection($customerOrders),
            CartResource::collection($customerCart),
        ]);


    }


    /**
     * Store a newly created resource in storage.
     */

    public function store()
    {
        //
        $userId = Session::get('user_id');
        print("UserID " . $userId . "\n");
        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();
        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
        print ("CustomerId " . $customerId . "\n");


        $customerCartItemPrices = Cart::where("customer_id", $user->customer->id)->pluck("total_price");
   //     print($customerCartItemPrices."\n");

        $customerCart =Cart::where("customer_id", $user->customer->id)->get();

        $total=0;
        foreach ($customerCartItemPrices as $item2){

            $total+=$item2;
        }


//        print($total."\n");

         $date=date("Y-m-d H:i:s");
         $date2=date("Y-F-l H:i:s");
//         print($date."\n");

        $order=Order::create([
            "order_date"=>$date,
            "order_price"=>$total,
            "customer_id"=>$customerId,
        ]);
        //$customerCart->destroy();


        return response()->json([
            'orderCreated:' =>new OrderResource($order),
            'cartItemsInOrder:'=>CartResource::collection($customerCart),
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
