<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = ProductResource::collection(Product::paginate(10)); // Adjust the number based on your requirements
        $users = UserResource::collection(User::paginate(10)); // Adjust the number based on your requirements

        return response()->json($products);
        //return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified category products
     */
    public function productsByCategory($catId)
    {
        $products = DB::table('product')
            ->join('category', 'product.cat_id', '=', 'category.catId')
            ->select('product.*')
            ->where('category.catName', '=', $catId)
            ->orderBy('product.productId')
            ->get();

        return response()->json(ProductResource::collection($products));
    }
public function searchForProduct($productName)
    {
        $products = DB::table('product')
            ->select('product.*')
            ->where('product.productName',"like", '%' . $productName . '%')
            ->orderBy('product.productId')
            ->get();

        return response()->json(ProductResource::collection($products));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
