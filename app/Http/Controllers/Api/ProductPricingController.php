<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\ProductPricing;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $users = User::with('customer', 'customer.card')->get();
        $user = $users->where("id", $userId)->first();
        $customerId = $user->customer->id;

        // Retrieve customer's favorite product IDs
        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
            ->pluck('product_id')
            ->toArray();

        // Retrieve all products with pricing, category
        $allProducts = Product::with('productpricing', 'category')->get();
        $offers = [];

        foreach ($allProducts as $product) {
            if ($product->productpricing->base_price > $product->productpricing->selling_price) {
                $offers[] = $product;
            }

        }

        // Retrieve all products with pricing and category
        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products = ProductResource::collection($offers);
        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;

        });


        return response()->json($products);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductPricing $product_pricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductPricing $product_pricing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductPricing $product_pricing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductPricing $product_pricing)
    {
        //
    }
}
