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
        $products = DB::table('products')
            ->join('product_pricings', 'products.Id', '=', 'product_pricings.product_id')
            ->join('stores', 'products.store_id', '=', 'stores.Id')
            ->join('storeowner', 'stores.owner_id', '=', 'storeowner.Id')
            ->select('products.product_name AS productName ', 'products.description', 'product_pricings.date_created AS dateCreated', 'product_pricings.exipred_date AS exipredDate', 'product_pricings.selling_price AS sellingPrice', 'product_pricings.discount', 'product_pricings.discount_unit AS discountUnit')
            ->orderBy('products.Id')
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
