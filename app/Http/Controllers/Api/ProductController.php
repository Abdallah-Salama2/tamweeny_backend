<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PythonController;
use App\Http\Resources\ProductResource;
use App\Interfaces\Product\ProductFetcherInterface;
use App\Interfaces\Product\ProductOfferInterface;
use App\Interfaces\Product\ProductRecommendationInterface;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use function Pest\Laravel\json;
use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    protected $productFetcher;
    protected $productRecommendation;
    protected $productOffer;

    public function __construct(
        ProductFetcherInterface        $productFetcher = null,
        ProductRecommendationInterface $productRecommendation = null,
        ProductOfferInterface          $productOffer = null
    )
    {
        $this->productFetcher = $productFetcher;
        $this->productRecommendation = $productRecommendation;
        $this->productOffer = $productOffer;
    }

    public function index(Request $request)
    {
        $allProducts = Product::with('category', 'productpricing')->where("product_type",0)->paginate(8);
        $products = ProductResource::collection($allProducts);
        $numberOfPages = $allProducts->lastPage();

        return response()->json([
            'products' => $products,
            'totalPages' => $numberOfPages
        ]);
    }

    public function model(Request $request)
    {
        $allProducts = $this->productFetcher->getAllProducts()->get();
        $productsArray = [];

        foreach ($allProducts as $product) {
            $productsArray[] = [
                'product_id' => $product->id,
                'description' => $product->description,
                'category' => $product->category->category_name,
                'order_count' => $product->order_count,
                'favorite_count' => $product->favorite_count,
            ];
        }

        return response()->json($productsArray);
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
//        dd($allProducts);
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
           $products->first(),
           $products->last(),

        ]);
//        return $products;
    }

    public function recommendedProducts2(Request $request)
    {
        // Get the current authenticated user's name
        $user = auth()->user();
        $user->load('favorite','order_made');
//        print(response()->json($user->favorite));
//        dd($user);
        // Check if the user has no favorites and has made orders
        if (count($user->favorite) === 0 && count($user->order_made) === 0) {
            // Call the recommendedProducts method if the conditions are met
            return $this->recommendedProducts($request);
        } else {
            $name = $user->name;
            $python = new PythonController();
            // Call the runPythonScript function to get the recommendations
            $recommendationsResponse = $python->runPythonScript();

            // Check if the script executed successfully
            if ($recommendationsResponse->getStatusCode() == 200) {
                $recommendationsData = $recommendationsResponse->getData();

                // Extract the output from the response
                $output = $recommendationsData->output;

                // The last line of the output contains the JSON string with recommendations
                $recommendationsJson = end($output);

                // Decode the JSON string
                $recommendations = json_decode($recommendationsJson, true);

                // Check if the user's name is in the recommendations array keys
                if (array_key_exists($name, $recommendations)) {

                    // Retrieve the product IDs
                    $productIds = $recommendations[$name];
                    $productId1 = $productIds[0];
                    $productId2 = $productIds[1];

                    // Find the products in the database
                    $product1 = Product::find($productId1);
                    $product2 = Product::find($productId2);

                    // Create a collection of the products
                    $collection = [$product1, $product2];

                    // Return the products as a JSON response
                    return response()->json(ProductResource::collection($collection));
                }
            }
        }
        // Return an empty response if no matching user is found
        return response()->json(['message' => 'No recommended products found for the user.'], 404);
    }
//
//    public function sendData()
//    {
//        $url = 'http://127.0.0.1:5000/post-data'; // Flask app URL
//
//        // Data to be sent
//        $data = [
//            'name' => 'John',
//            'age' => 30
//        ];
//
//        // Sending POST request
//        $response = Http::post($url, $data);
//
//        // Returning response from Flask
//        return $response->json();
//    }


//    public function recommendedProducts2(Request $request)
//    {
//
////        return $token;
////        $flask_url = "http://127.0.0.1:5000/?token={$api_token}";
////        dd($flask_url);
////        $response = Http::get($flask_url);
////        $data = $response->json();
//
//        $productId1 = $data[0];
//        $productId2 = $data[1];
//
//        $product1 = Product::find($productId1);
//        $product2 = Product::find($productId2);
//
//        $collection = [$product1, $product2];
//
//        return response()->json(ProductResource::collection($collection));
//    }

//    public function recommendedProducts2(Request $request)
//    {
//        // Get the current authenticated user's name
//        $name = auth()->user()->name;
//
//        // Make a GET request to the Flask API
//        $response = Http::get('http://127.0.0.1:5000/');
//        $data = $response->json();
//
//        // Check if the user's name is in the data array keys
//        if (array_key_exists($name, $data)) {
//            // Retrieve the product IDs
//            $productIds = $data[$name];
//            $productId1 = $productIds[0];
//            $productId2 = $productIds[1];
//
//            // Find the products in the database
//            $product1 = Product::find($productId1);
//            $product2 = Product::find($productId2);
//
//            // Create a collection of the products
//            $collection = [$product1, $product2];
//
//            // Return the products as a JSON response
//            return response()->json(ProductResource::collection($collection));
//        }
//
//        // Return an empty response if no matching user is found
//        return response()->json(['message' => 'No recommended products found for the user.'], 404);
//    }
//
//    public function offers(Request $request)
//    {
//        $offers = $this->productOffer->getProductsOnOffer();
//        return response()->json(ProductResource::collection($offers));
//    }


    public function offers(Request $request)
    {
//        $customerId = auth()->user()->id;
//
//        // Retrieve customer's favorite product IDs
//        $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
//            ->pluck('product_id')
//            ->toArray();
        // Retrieve all products with pricing, category
        $allProducts = Product::with('productpricing', 'category')->where('product_type',1)->latest()->get();
//        $offers = [];
//        foreach ($allProducts as $product) {
//            if ($product->productpricing->base_price > $product->productpricing->selling_price) {
//                $offers[] = $product;
//            }
//        }
        $products = ProductResource::collection($allProducts);
//        $products->each(function ($product) use ($customerFavoriteProductIds) {
//            $product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
//
//        });
        return response()->json($products);
    }

    public function searchForProductById(Request $request, ?string $productId = null)
    {
        $product = $this->productFetcher->findProductById($productId);
        if (!$product) {
            return response()->json(["message" => "Product Not Found"]);
        }
        return new ProductResource($product);
    }


    //?string $productName = nul in case search bar is empty so it runs the if empty
    public function searchForProductByName(Request $request, ?string $productName = null)
    {
        if (empty($productName)) {
            return response()->json([], 400);
        }

        $products = $this->productFetcher->findProductByName($productName);
        return ProductResource::collection($products);
    }

    public function fillStoreProductsTable(): void
    {
        // Retrieve all stores and products
        $stores = Store::all();
        $products = Product::all();

        foreach ($products as $product) {
            $product->stock_quantity -= 10;
        }

        // Distribute products to stores
        foreach ($products as $product) {
            // Determine the quantity to distribute to each store
            $totalStores = count($stores);
            $quantityPerStore = $product->stock_quantity / $totalStores; //60
//            $remainingQuantity = $totalQuantityPerProduct;//300
            foreach ($stores as $store) {
                // Calculate quantity to assign to the current store
                $quantity = min($quantityPerStore, $product->stock_quantity);//60
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
                if ($product->stock_quantity <= 0) {
                    break;
                }
            }
        }
        foreach ($products as $product) {
            $product->stock_quantity += 10;
            $product->save();

        }
    }


}
