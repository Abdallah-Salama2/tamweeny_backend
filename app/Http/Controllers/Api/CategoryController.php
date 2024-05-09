<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();
        return response()->json(CategoryResource::collection($categories));
    }


    public function productsByCategory($catName, Request $request): JsonResponse
    {

        $customerId = auth()->user()->id;
        $category = Category::where('category_name', $catName)->firstOrFail();
//        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
//            ->pluck('product_id')
//            ->toArray();
        $products = Product::where('cat_id', $category->id)
            ->WithFavoriteStatus($customerId)
            ->get();

//        $products->each(function ($product) use ($customerFavoriteProductIds) {
//            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
//        });

        return response()->json(ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // Not implemented
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category)
    {
        // Not implemented
        $customerId = auth()->user()->id;
        $category = Category::where('category_name', $category->category_name)->firstOrFail();

        $products = Product::where('cat_id', $category->id)
            ->WithFavoriteStatus($customerId)
            ->get();


        return response()->json(ProductResource::collection($products));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        // Not implemented
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        // Not implemented
        return response()->json(['message' => 'Not implemented'], 501);
    }
}
