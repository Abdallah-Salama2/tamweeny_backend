<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $customerId = auth()->user()->id;


        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
            ->pluck('product_id')
            ->toArray();

        $favoriteProducts = Product::with('productpricing', 'category', 'favorite')
            ->whereIn('id', $customerFavoriteProductIds)
            ->paginate(8);

        $products = ProductResource::collection($favoriteProducts);
        $products->each(function ($product) {
            $product->favoriteStats = 1;
        });

        return response()->json($products);
    }

    /**
     * Add a product to favorites.
     */
    public function add(Request $request, $productId)
    {


        $customerId = auth()->user()->id;

        $product = Product::find($productId);
        $productInFavorite = Favorite::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->first();

        if ($productInFavorite) {
            $product->favorite_count -= 1;
            $productInFavorite->delete();
            $product->save();

            return response()->json([
                'message' => 'Product removed from Favorites.',
            ], 409);
        }

        $favorite = Favorite::create([
            'customer_id' => $customerId,
            'product_id' => $productId,
        ]);

        $product->favorite_count++;
        $product->save();
        $favorite->save();

        return response()->json([
            'message' => 'Product Added To Favorites ',
        ], 200);
    }



}
