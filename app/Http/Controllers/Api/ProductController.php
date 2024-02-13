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
        $products = DB::table('product')
            ->join('product_pricing', 'product.productId', '=', 'product_pricing.product_id')
            ->select('product.*','product_pricing.selling_price')
            ->orderBy('product.productId')
            ->paginate(10);

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
public function searchForProductById($product=null)
    {
        $products = DB::table('product')
            ->select('product.*')
            ->where('product.productId',"like",$product)
            ->orderBy('product.productId')
            ->get();

        return response()->json(ProductResource::collection($products));
    }

    public function searchForProductByName($product=null)
    {

            $products = DB::table('product')
                ->select('product.*')
                ->where('product.productName',"like", '%' . $product . '%')
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
