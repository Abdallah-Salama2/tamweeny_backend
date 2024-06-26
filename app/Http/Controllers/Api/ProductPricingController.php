<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;;
use App\Models\ProductPricing;
use Illuminate\Http\Request;

class ProductPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $allProducts = Product::with('productpricing', 'category')->paginate(8);

        return $allProducts;
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
