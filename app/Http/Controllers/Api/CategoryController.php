<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Interfaces\CategoryFetcherInterface;
use App\Models\Product;

;

use App\Models\Category;
use App\Services\CategoryFetcherApiService;
use App\Services\CategoryFetcherWebService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryFetcherApi;
//    protected $categoryFetcherWeb;

    // Both constructors are working well don't delete them from learning purpose and remember interface is binded to display $categoryFetcherApiServcie in AppServiceProvider.php
    public function __construct(CategoryFetcherInterface $categoryFetcher)
    {
        $this->categoryFetcherApi=$categoryFetcher;
//        $this->categoryFetcherApi=app('categoryFetcherApi');
//        $this->categoryFetcherWeb=app('categoryFetcherWeb');
    }
//    public function __construct(
//        CategoryFetcherApiService $categoryFetcherApi,
////        CategoryFetcherWebService $categoryFetcherWeb
//    ) {
//        $this->categoryFetcherApi = $categoryFetcherApi;
////        $this->categoryFetcherWeb = $categoryFetcherWeb;
//    }

    //Main Purpose of Controller is to Handle Http Requests

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories =CategoryResource::collection($this->categoryFetcherApi->getAllCategories());
//        $categories =$this->categoryFetcherWeb->getAllCategories();
        return response()->json($categories);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category)
    {
        $products=$this->categoryFetcherApi->getAllProductsByCategory($category);
        return response()->json(ProductResource::collection($products));
    }

}
/*//    public function productsByCategory($catName, Request $request): JsonResponse
//    {
//
//        $customerId = auth()->user()->id;
//        $category = Category::where('category_name', $catName)->firstOrFail();
////        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
////            ->pluck('product_id')
////            ->toArray();
//        $products = Product::where('cat_id', $category->id)
//            ->WithFavoriteStatus($customerId)
//            ->get();
//
////        $products->each(function ($product) use ($customerFavoriteProductIds) {
////            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
////        });
//
//        return response()->json(ProductResource::collection($products));
//    }
*/
