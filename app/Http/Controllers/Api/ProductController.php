<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Interfaces\Product\ProductFetcherInterface;
use App\Interfaces\Product\ProductOfferInterface;
use App\Interfaces\Product\ProductRecommendationInterface;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productFetcher;
    protected $productRecommendation;
    protected $productOffer;

    public function __construct(
        ProductFetcherInterface        $productFetcher =null,
        ProductRecommendationInterface $productRecommendation =null,
        ProductOfferInterface          $productOffer=null
    )
    {
        $this->productFetcher = $productFetcher;
        $this->productRecommendation = $productRecommendation;
        $this->productOffer = $productOffer;
    }

    public function index(Request $request)
    {
        $allProducts = $this->productFetcher->getAllProducts()->paginate(8);
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
        $products = ProductResource::collection($allProducts);
        return response()->json([
            'products' => $products,
        ]);
    }

    public function recommendedProducts(Request $request)
    {
        $recommendedProducts = $this->productRecommendation->getRecommendedProducts();
        return response()->json([
            'Most Ordered' => new ProductResource($recommendedProducts[0]),
            'Most Favorited' => new ProductResource($recommendedProducts[1]),
        ]);
    }


    public function recommendedProducts2(Request $request, $productId1, $productId2)
    {
        $product1 = Product::find($productId1);
        $product2 = Product::find($productId2);

        $collection = [$product1, $product2];
//        $products=json_encode($collection,JSON_PRETTY_PRINT);
//        print($products);
        return response()->json(ProductResource::collection($collection));

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
