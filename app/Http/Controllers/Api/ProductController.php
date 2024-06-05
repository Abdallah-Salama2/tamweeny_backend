<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Interfaces\Product\ProductFetcherInterface;
use App\Interfaces\Product\ProductOfferInterface;
use App\Interfaces\Product\ProductRecommendationInterface;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use function Pest\Laravel\json;

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
        $allProducts = $this->productFetcher->getAllProducts()->latest()->paginate(8);
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
        $recommendedProducts = $this->productRecommendation->getRecommendedProducts();
        return response()->json([
            'Most Ordered' => new ProductResource($recommendedProducts[0]),
            'Most Favorited' => new ProductResource($recommendedProducts[1]),
        ]);
    }

    public function sendData()
    {
        $url = 'http://127.0.0.1:5000/post-data'; // Flask app URL

        // Data to be sent
        $data = [
            'name' => 'John',
            'age' => 30
        ];

        // Sending POST request
        $response = Http::post($url, $data);

        // Returning response from Flask
        return $response->json();
    }

    public function getRecommendations()
    {
        $token = Session::get('api_token');
        $gg = (string)$token;
        $user = User::where('name', $gg)->first();
        return $user->name;
    }


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

    public function recommendedProducts2(Request $request)
    {
        // Get the current authenticated user's name
        $name = auth()->user()->name;

        // Make a GET request to the Flask API
        $response = Http::get('http://127.0.0.1:5000/');
        $data = $response->json();

        // Check if the user's name is in the data array keys
        if (array_key_exists($name, $data)) {
            // Retrieve the product IDs
            $productIds = $data[$name];
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

        // Return an empty response if no matching user is found
        return response()->json(['message' => 'No recommended products found for the user.'], 404);
    }

    public function offers(Request $request)
    {
        $offers = $this->productOffer->getProductsOnOffer();
        return response()->json(ProductResource::collection($offers));
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
        $products = Product::where('product_type', 0)->get();

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
