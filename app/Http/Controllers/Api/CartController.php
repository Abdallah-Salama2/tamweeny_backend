<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    protected $customerId;

    /*Global Customer ID: The $customerId property is defined and initialized in the constructor using a middleware closure to ensure the authenticated user's ID is set for each request.
    Middleware: The middleware function ensures the $customerId is set before any controller method is executed.*/
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->customerId = auth()->user()->id;
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customerCart = Cart::where("customer_id", $this->customerId)->get();
        return response()->json(CartResource::collection($customerCart));
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

        $cart = Cart::where("customer_id", $this->customerId)
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
            'customer_id' => $this->customerId,
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
    public function delete($productId)
    {
        $cart = Cart::where("customer_id", $this->customerId)
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            $cart->delete();
            return response()->json(['message' => 'Cart item removed successfully'], 200);
        }

        return response()->json(['message' => 'Cart item not found'], 404);
    }
}
