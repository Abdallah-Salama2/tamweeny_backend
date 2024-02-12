<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\ProductPricing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        //return ProductPricing::all();
        $products = DB::table('product')
            ->join('product_pricing', 'product.productId', '=', 'product_pricing.product_id')
            ->join('store', 'product.store_id', '=', 'store.storeId')
            ->join('storeowner', 'store.owner_id', '=', 'storeowner.ownerId')
            ->select('product.productName','product.description','product_pricing.date_created','product_pricing.exipred_date','product_pricing.selling_price','store.address','store.phoneNumber')
            ->orderBy('product.productId')
            ->get();

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
