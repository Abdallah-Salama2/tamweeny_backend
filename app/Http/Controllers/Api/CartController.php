<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $customerId = auth()->user()->customer->id;
        $customerCart = Cart::where("customer_id", $customerId)->get();

        return response()->json(CartResource::Collection($customerCart));
    }



    /**
     * Update the quantity of a product in the cart.
     */
    public function update(Request $request, $productId, $operator)
    {
        // Validate the incoming data (except for route parameters)
        $request->validate([
            'quantity' => 'integer|min:1', // Ensure quantity is a positive integer
        ]);

        // Validate the route parameters
        $validator = Validator::make(compact('productId', 'operator'), [
            'productId' => 'required|exists:products,id',
            'operator' => 'required|in:true,false',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $customerId = auth()->user()->customer->id;


        $cart = Cart::where("customer_id", $customerId)
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            if ($operator == "true") {
                $cart->quantity += 1;
            } elseif ($operator == "false") {
                $cart->quantity -= 1;
                if ($cart->quantity < 1) {
                    $cart->delete();
                    return response()->json(['message' => 'Cart item removed successfully'], 200);
                }
            }
            $cart->total_price = ($cart->product->productpricing->base_price ?? null) * $cart->quantity;
            $cart->save();
            return response()->json(['message' => 'Cart updated successfully']);
        }

        $productPrice = (int)Product::find($productId)->productpricing->selling_price;
        $newCart = Cart::create([
            'customer_id' => $customerId,
            'product_id' => $productId,
            'quantity' => 1,
            'total_price' => $productPrice,
        ]);
        $newCart->save();

        return response()->json(['message' => 'Cart item created successfully']);
    }

    /**
     * Remove a product from the cart.
     */
    public function delete(Request $request, $productId)
    {
        $userId = $request->user()->id;
        $user = User::with('customer', 'customer.card')->find($userId);
        $customerId = $user->customer->id;

        $cart = Cart::where("customer_id", $customerId)
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            $cart->delete();
            return response()->json(['message' => 'Cart item removed successfully'], 200);
        }

        return response()->json(['message' => 'Cart item not found'], 404);
    }
}


