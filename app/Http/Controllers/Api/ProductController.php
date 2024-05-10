<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {

        $customerId = auth()->user()->id;

        // Retrieve all products with pricing, category, and favorite status
        $allProducts = Product::with(['productpricing', 'category'])
            ->get();

        // Transform products using ProductResource
        $products = ProductResource::collection($allProducts);

//        $numberOfPages = $allProducts->lastPage();

        return response()->json([
            'products' => $products,
//            'totalPages' => $numberOfPages
        ]);
    }

    public function recommendedProducts(Request $request)
    {
//        $userId = $request->user()->id;

//        $customerId = auth()->user()->id;
//
//
//        // Retrieve customer's favorite product IDs
//        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
//            ->pluck('product_id')
//            ->toArray();

        // Retrieve all products with pricing, category
        $allProducts = Product::with('productpricing', 'category')->get();

        // Sort products based on order_count and favorite_count in descending order
        $sortedProducts = $allProducts->sortByDesc('order_count')->sortByDesc('favorite_count');
        //first item the highest order 2nd item the 2nd order

        // Take only the top two recommended products
        $recommendedProducts = $sortedProducts->take(2);

        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products = ProductResource::collection($recommendedProducts);
//        $products->each(function ($product) use ($customerFavoriteProductIds) {
//            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
//        });

        return response()->json([
            'Most Ordered' => $products->first(),
            'Most Favorited' => $products->last(), // Assuming the last one is the second most ordered
        ]);
//        return $products;
    }


    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource|JsonResponse
     */


    public function show(Product $product)
    {
        if (empty($product)) {
            return response()->json([], 400);
        }
        // Find the product
        $productByName = Product::where('product_name', 'like', '%' . $product->product_name . '%')->first();

//
        if ($productByName) {
            // This block will execute if the product is not found by ID
            // Searching for the product by name might be unnecessary, depending on your use case
            return new ProductResource($productByName);
        }

        $productById = User::find($product);
        if ($productById) {
            return new ProductResource($productById);
        }

        return response()->json(['message' => 'Product not found'], 404);

    }


    public function searchForProductById(Request $request, ?string $productId = null)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(["message" => "Product Not Found"]);
        }

//        $customerId = auth()->user()->id;
//
//        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)->pluck('product_id')->toArray();
//
//        // Check if the current product ID is in the list of user's favorite product IDs
//        if (in_array($productId, $customerFavoriteProductIds)) {
//            $product->favoriteStats = 1;
//        } else {
//            $product->favoriteStats = 0;
//        }

        // Return the product resource with the updated favoriteStats attribute
        return new ProductResource($product);
    }

    //?string $productName = nul in case search bar is empty so it runs the if empty
    public function searchForProductByName(Request $request, ?string $productName = null)
    {
        if (empty($productName)) {
            return response()->json([], 400);
        }

//        $customerId = auth()->user()->id;

//        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)->pluck('product_id')->toArray();
        $products = Product::where('product_name', 'like', '%' . $productName . '%')->get();

        if ($products->isEmpty()) {
            return response()->json();
        }
//
//        $updatedProducts = [];
//        foreach ($products as $product) {
//            $productId = $product->id;
////            $product->favoriteStats = in_array($productId, $customerFavoriteProductIds) ? 1 : 0;
//            $updatedProducts[] = $product;
//        }

        // Return the product resources with the updated favoriteStats attribute
        return ProductResource::collection($products);
    }

    public function emptyList()
    {
        return [];
    }

    public function offers(Request $request)
    {


//        $customerId = auth()->user()->id;
//
//        // Retrieve customer's favorite product IDs
//        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
//            ->pluck('product_id')
//            ->toArray();

        // Retrieve all products with pricing, category
        $allProducts = Product::with('productpricing', 'category')->get();
        $offers = [];

        foreach ($allProducts as $product) {
            if ($product->productpricing->base_price > $product->productpricing->selling_price) {
                $offers[] = $product;
            }

        }

        $products = ProductResource::collection($offers);
//        $products->each(function ($product) use ($customerFavoriteProductIds) {
//            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
//
//        });


        return response()->json($products);
    }


    public function fillStoreProductsTable(): void
    {
        // Retrieve all stores and products
        $stores = Store::all();
        $products = Product::where('product_type',0)->get();

        foreach ($products as$product){
            $product->stock_quantity -=10;
        }

        // Distribute products to stores
        foreach ($products as $product) {
            // Determine the quantity to distribute to each store
            $totalStores = count($stores);
            $quantityPerStore =  $product->stock_quantity / $totalStores; //60
//            $remainingQuantity = $totalQuantityPerProduct;//300
            foreach ($stores as $store) {
                // Calculate quantity to assign to the current store
                $quantity = min($quantityPerStore,  $product->stock_quantity);//60
                $product->stock_quantity -= $quantity;//300-60
                $product->save();
                // Insert into the stores_products table
                DB::table('stores_products')->insert([
                    'store_id' => $store->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Break the loop if no more quantity remaining
                if ( $product->stock_quantity <= 0) {
                    break;
                }
            }
        }
        foreach ($products as$product){
            $product->stock_quantity +=10;
            $product->save();

        }
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
