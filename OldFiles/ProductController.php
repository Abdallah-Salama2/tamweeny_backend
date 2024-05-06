<?php


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

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
        $allProducts = Product::with('productpricing', 'category')->get();

        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products = ProductResource::collection($allProducts);
        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
        });

//        $numberOfPages = $allProducts->lastPage();

        return response()->json([
            'products' => $products,
//            'totalPages' => $numberOfPages
        ]);
    }

    public function recommendedProducts(Request $request)
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
        $allProducts = Product::with('productpricing', 'category')->get();

        // Sort products based on order_count and favorite_count in descending order
        $sortedProducts = $allProducts->sortByDesc('order_count')->sortByDesc('favorite_count');
        //first item the highest order 2nd item the 2nd order

        // Take only the top two recommended products
        $recommendedProducts = $sortedProducts->take(2);

        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products = ProductResource::collection($recommendedProducts);
        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
        });

        return response()->json([
            'Most Ordered' => $products->first(),
            'Most Favorited' => $products->last(), // Assuming the last one is the second most ordered
        ]);
//        return $products;
    }


    public function searchForProductById(Request $request, ?string $productId = null)
    {
        $product = Product::with('productpricing', 'category')->find($productId);

        if (!$product) {
            return response()->json(["message" => "Product Not Found"]);
        }

        $userId = $request->user()->id;
        $users = User::with('customer', 'customer.card')->get();
        $user = $users->where("id", $userId)->first();

        $customerId = $user->customer->id;        // Retrieve the IDs of the user's favorite products
        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)->pluck('product_id')->toArray();

        // Check if the current product ID is in the list of user's favorite product IDs
        if (in_array($productId, $customerFavoriteProductIds)) {
            $product->favoriteStats = 1;
        } else {
            $product->favoriteStats = 0;
        }

        // Return the product resource with the updated favoriteStats attribute
        return new ProductResource($product);
    }

    //?string $productName = nul in case search bar is empty so it runs the if empty
    public function searchForProductByName(Request $request, ?string $productName = null)
    {
        if (empty($productName)) {
            return response()->json([], 400);
        }

        $userId = $request->user()->id;
        $users = User::with('customer', 'customer.card')->get();
        $user = $users->where("id", $userId)->first();

        if (!$user) {
            return response()->json(["message" => "User not found"], 404);
        }

        $customerId = $user->customer->id;
        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)->pluck('product_id')->toArray();
        $products = Product::where('product_name', 'like', '%' . $productName . '%')->get();

        if ($products->isEmpty()) {
            return response()->json();
        }

        $updatedProducts = [];
        foreach ($products as $product) {
            $productId = $product->id;
            $product->favoriteStats = in_array($productId, $customerFavoriteProductIds) ? 1 : 0;
            $updatedProducts[] = $product;
        }

        // Return the product resources with the updated favoriteStats attribute
        return ProductResource::collection($updatedProducts);
    }

    public function emptyList()
    {
        return [];
    }

    public function offers(Request $request)
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
        $allProducts = Product::with('productpricing', 'category')->get();
        $offers = [];

        foreach ($allProducts as $product) {
            if ($product->productpricing->base_price > $product->productpricing->selling_price) {
                $offers[] = $product;
            }

        }

        // Retrieve all products with pricing and category
        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products = ProductResource::collection($offers);
        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;

        });


        return response()->json($products);
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


/*
class ProductController extends Controller
{

    public function index(Request $request)
    {
//        $userId = $request->user()->id;
//        $users = User::with('customer', 'customer.card')->get();
//        $user = $users->where("id", $userId)->first();
//        $customerId = $user->customer->id;
        $customerId = auth()->user()->customer->id;


        // Retrieve customer's favorite product IDs
        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
            ->pluck('product_id')
            ->toArray();

        // Retrieve all products with pricing, category
        $allProducts = Product::with('productpricing', 'category')->get();

        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products = ProductResource::collection($allProducts);
        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
        });

//        $numberOfPages = $allProducts->lastPage();

        return response()->json([
            'products' => $products,
//            'totalPages' => $numberOfPages
        ]);
    }

    public function recommendedProducts(Request $request)
    {
//        $userId = $request->user()->id;
//        $users = User::with('customer', 'customer.card')->get();
//        $user = $users->where("id", $userId)->first();
//        $customerId = $user->customer->id;
        $customerId = auth()->user()->customer->id;


        // Retrieve customer's favorite product IDs
        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
            ->pluck('product_id')
            ->toArray();

        // Retrieve all products with pricing, category
        $allProducts = Product::with('productpricing', 'category')->get();

        // Sort products based on order_count and favorite_count in descending order
        $sortedProducts = $allProducts->sortByDesc('order_count')->sortByDesc('favorite_count');
        //first item the highest order 2nd item the 2nd order

        // Take only the top two recommended products
        $recommendedProducts = $sortedProducts->take(2);

        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products = ProductResource::collection($recommendedProducts);
        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
        });

        return response()->json([
            'Most Ordered' => $products->first(),
            'Most Favorited' => $products->last(), // Assuming the last one is the second most ordered
        ]);
//        return $products;
    }


    public function searchForProductById(Request $request, ?string $productId = null)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(["message" => "Product Not Found"]);
        }

//        $userId = $request->user()->id;
//        $users = User::with('customer', 'customer.card')->get();
//        $user = $users->where("id", $userId)->first();
//
//        $customerId = $user->customer->id;        // Retrieve the IDs of the user's favorite products
        $customerId = auth()->user()->customer->id;

        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)->pluck('product_id')->toArray();

        // Check if the current product ID is in the list of user's favorite product IDs
        if (in_array($productId, $customerFavoriteProductIds)) {
            $product->favoriteStats = 1;
        } else {
            $product->favoriteStats = 0;
        }

        // Return the product resource with the updated favoriteStats attribute
        return new ProductResource($product);
    }

    //?string $productName = nul in case search bar is empty so it runs the if empty
    public function searchForProductByName(Request $request, ?string $productName = null)
    {
        if (empty($productName)) {
            return response()->json([], 400);
        }

//        $userId = $request->user()->id;
//        $users = User::with('customer', 'customer.card')->get();
//        $user = $users->where("id", $userId)->first();
//
//        if (!$user) {
//            return response()->json(["message" => "User not found"], 404);
//        }
//
//        $customerId = $user->customer->id;
        $customerId = auth()->user()->customer->id;

        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)->pluck('product_id')->toArray();
        $products = Product::where('product_name', 'like', '%' . $productName . '%')->get();

        if ($products->isEmpty()) {
            return response()->json();
        }

        $updatedProducts = [];
        foreach ($products as $product) {
            $productId = $product->id;
            $product->favoriteStats = in_array($productId, $customerFavoriteProductIds) ? 1 : 0;
            $updatedProducts[] = $product;
        }

        // Return the product resources with the updated favoriteStats attribute
        return ProductResource::collection($updatedProducts);
    }

    public function emptyList()
    {
        return [];
    }

    public function offers(Request $request)
    {
//        $userId = $request->user()->id;
//        $users = User::with('customer', 'customer.card')->get();
//        $user = $users->where("id", $userId)->first();
//        $customerId = $user->customer->id;

        $customerId = auth()->user()->customer->id;

        // Retrieve customer's favorite product IDs
        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
            ->pluck('product_id')
            ->toArray();

        // Retrieve all products with pricing, category
        $allProducts = Product::with('productpricing', 'category')->get();
        $offers = [];

        foreach ($allProducts as $product) {
            if ($product->productpricing->base_price > $product->productpricing->selling_price) {
                $offers[] = $product;
            }

        }

        // Retrieve all products with pricing and category
        // Transform products using ProductResource and set favoriteStats based on if they are favorites
        $products = ProductResource::collection($offers);
        $products->each(function ($product) use ($customerFavoriteProductIds) {
            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;

        });


        return response()->json($products);
    }

    /**
     * Update the specified resource in storage.
     */
//public function update(Request $request, Product $product)
//{
//    //
//}
//
///**
// * Remove the specified resource from storage.
// */
//public function destroy(Product $product)
//{
//    //
//}
//}


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
//*///



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
