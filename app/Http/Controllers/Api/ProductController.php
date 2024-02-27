<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $userId = $request->user()->id;

        //print("UserID " . $userId . "\n");
        $users = User::with('customer', 'customer.card')->get();

        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
        //print ("CustomerId " . $customerId . "\n");


        $products = ProductResource::collection(Product::with('productpricing', 'category')->paginate(8));

        $numberOfPages = $products->lastPage();

        $customerFavorites = Favorite::where("customer_id", $customerId)->pluck('product_id');
        //print($customerFavorites);

        foreach ($products as $product) {
            $product->product_image = base64_encode($product->product_image);
            $product->category->category_image = base64_encode($product->category->category_image);

            $product->favoriteStats = $customerFavorites->contains($product->id) ? 1 : 0;


        }
        return response()->json([
            'products' => ProductResource::collection($products),
            'totalPages' => $numberOfPages
        ]);


    }


    public function productsByCategory($catName)
    {
        // Retrieve the category by name
        $category = Category::where('category_name', $catName)->first();
        $category->category_image = base64_encode($category->category_image);
        //print($category->category_name);

        // Retrieve all products in the category
        $products = Product::where('cat_id', $category->id)->with('category')->get();

        foreach ($products as $product) {
            $product->product_image = base64_encode($product->product_image);
        }


        return response()->json(ProductResource::collection($products));
    }

    public function searchForProductById($productId)
    {
        $products = Product::with('productpricing', 'category')->get();
        foreach ($products as $product) {
            $product->product_image = base64_encode($product->product_image);
            $product->category->category_image = base64_encode($product->category->category_image);

        }

        //print($products);
        $product = $products->where("id", $productId)->first();


        return new ProductResource($product);
    }

    public function searchForProductByName($product_name)
    {

        $products = Product::where('product_name', "like", "%" . $product_name . "%")->get();
        //$products->product_image = base64_encode($products->product_image);

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
