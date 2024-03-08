<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

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
        $allProducts = Product::with('productpricing', 'category')->paginate(8);

        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products = ProductResource::collection($allProducts);
        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
        });

        $numberOfPages = $allProducts->lastPage();

        return response()->json([
            'products' => $products,
            'totalPages' => $numberOfPages
        ]);
    }


    public function productsByCategory($catName, Request $request)
    {
        $userId = $request->user()->id;
        $users = User::with('customer', 'customer.card')->get();
        $user = $users->where("id", $userId)->first();

        $customerId = $user->customer->id;

        $category = Category::where('category_name', $catName)->firstOrFail();

        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
            ->pluck('product_id')
            ->toArray();

        $products = Product::where('cat_id', $category->id)
            ->with('productpricing', 'category')
            ->get();

        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
        });

        return response()->json(ProductResource::collection($products));
    }

    public function searchForProductById($productId)
    {
        $product = Product::with('productpricing', 'category')->find($productId);

        if (!$product) {
            return response()->json(["message" => "Product Not Found"]);
        }

        $userId = auth()->id();
        // Retrieve the IDs of the user's favorite products
        $customerFavoriteProductIds = Favorite::where('customer_id', $userId)->pluck('product_id')->toArray();

        // Create a new ProductResource instance with the product data and the favorite stats
        $productResource = new ProductResource($product);
        $productResource->additional(['favoriteStats' => in_array($product->id, $customerFavoriteProductIds) ? 1 : 0]);

        return $productResource;
    }

    public function searchForProductByName($productName)
    {
        $products = Product::where('product_name', 'like', '%' . $productName . '%')->get();

        $userId = auth()->id();
        $customerFavoriteProductIds = Favorite::where('customer_id', $userId)->pluck('product_id')->toArray();

        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
        });

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


//    public function productsByCategory($catId)
//    {
//        $products = DB::table('products')
//            ->join('product_pricings', 'products.id', '=', 'product_pricings.product_id')
//            ->join('categories', 'products.cat_id', '=', 'categories.Id')
//            ->where('categories.category_name', '=', $catId)
//            ->orderBy('products.id')
//            ->get();
//
//        foreach ($products as $product) {
//            $product->product_image = base64_encode($product->product_image);
//            $product->category_image = base64_encode($product->category_image);
//        }
//
//        return response()->json($products);
//    }

//    public function searchForProductByName($product)
//    {
//
//        $products = DB::table('products')
//            ->join('product_pricings', 'products.id', '=', 'product_pricings.product_id')
//            ->where('products.product_name', "like", '%' . $product . '%')
//            ->orderBy('products.id')
//            ->get();
//
//
//        return response()->json(ProductResource::collection($products));
//    }

/**
 * Store a newly created resource in storage.
 */
//    public function store(Request $request)
//    {
//        $images = DB::table('products')->select('product_image')->get();
//
//        if ($images->isEmpty()) {
//            abort(404);
//        }
//
//        // Assuming your images are stored as BLOBs in the database
//        // You need to iterate over all images and concatenate them
//        $imageData = '';
//        foreach ($images as $image) {
//            $imageData .= $image->product_image;
//        }
//
//        // Set appropriate headers for the first image
//        $headers = [
//            'Content-Type' => 'image/jpeg', // Change the content type according to your image type
//            'Content-Length' => strlen($imageData),
//        ];
//
//        // Return the image as response
//        return view('test', compact('images'));
//    }

/**
 * Display the specified category products
 */
//    public function productsByCategory($catName)
//    {
//        $products = Product::with('category')->get();
//
//        foreach ($products as $product) {
//            $product->product_image = base64_encode($product->product_image);
//            $product->category->category_image = base64_encode($product->category->category_image);
//        }
//
//        return response()->json(ProductResource::collection($products));
//    }

/**
 * Display a listing of the resource.
 */
//    public function test(Request $request)
//    {
//        $products = DB::table('products')
//            ->join('product_pricings', 'products.productId', '=', 'product_pricings.product_id')
//            ->select('products.*', 'product_pricings.selling_price')
//            ->orderBy('products.productId')
//            ->get();
//
//        // Encode image data as base64
//        foreach ($products as $product) {
//            $product->product_image = base64_encode($product->product_image);
//        }
//
//        return view('test', compact('products'));
//   }
//    public function index(Request $request)
//    {
//        $products = DB::table('products')
//            ->join('product_pricings', 'products.id', '=', 'product_pricings.product_id')
//            ->orderBy('products.id')
//            ->get();
//
//        // Encode image data as base64
//        foreach ($products as $product) {
//            $product->product_image = base64_encode($product->product_image);
//        }
//
//        return response()->json($products);
//    }
