<?php



use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\ProductResource;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        // Retrieve favorite products and include their relationships
        $favoriteProducts = Product::with('productpricing', 'category', 'favorite')
            ->whereIn('id', $customerFavoriteProductIds)
            ->paginate(8);

        // Transform favorite products using ProductResource
        $products = ProductResource::collection($favoriteProducts);
        $products->each(function ($product) {
            $product->favoriteStats = 1;
        });

        $numberOfPages = $favoriteProducts->lastPage();

        // Base64 encode images
//        $products->each(function ($product) {
//            $product->product_image = base64_encode($product->product_image);
//            $product->category->category_image = base64_encode($product->category->category_image);
//        });
        return response()->json($products);

    }

//    } public function index(Request $request)
//    {
//        $userId = $request->user()->id;
//
//        //print("UserID " . $userId . "\n");
//        $users = User::with('customer', 'customer.card')->get();
//
//        // Retrieve the user from the collection by ID
//        $user = $users->where("id", $userId)->first();
//        //print($user);
//
//        $customerId = $user->customer->id;
//        //print ("CustomerId " . $customerId . "\n");
//
//        $products = ProductResource::collection(Product::with('productpricing', 'category','favorite')->paginate(8));
//
//        $numberOfPages = $products->lastPage();
//
//        $customerPrdouctIds = Favorite::where("customer_id", $customerId)->pluck('product_id');
//        $customerFavorites=[];
//        //print($customerFavorites);
//
//        foreach ($products as $product) {
//            $product->product_image = base64_encode($product->product_image);
//            $product->category->category_image = base64_encode($product->category->category_image);
//
//            $product->favoriteStats = $customerPrdouctIds->contains($product->id) ? 1 : 0;
//
//            if($product->favoriteStats == 1){
//                $customerFavorites[]=$product;
//            }
//
//
//        }
//
//
//
//        //$favorites=Favorite::all();
//
//
//
//        return response()->json(ProductResource::collection($customerFavorites));
//
//    }

    public function add(Request $request, $productId)
    {
        //
        $userId = $request->user()->id;
//        print("UserID " . $userId . "\n");

        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();

        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
//        print ("CustomerId " . $customerId . "\n");

        $product = Product::where("id", $productId)->first();
        $count =  $product->favorite_count;
        $productInFavorite = Favorite::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->first();

        if ($productInFavorite) {
            // Handle the case where the product already exists in the Favorites
            $product->favorite_count -=1;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoriteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
/*
  $userId = Session::get('user_id');
        print("UserID ". $userId ."\n");

        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();

        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        $customerId=$user->customer->id;
        print ("customerId ".$customerId ."\n");

 */



//public function index(Request $request)
//{
////        $userId = $request->user()->id;
////        $user = User::with('customer', 'customer.card')->find($userId);
////        $customerId = $user->customer->id;
//    $customerId = auth()->user()->customer->id;
//
//
//    $customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
//        ->pluck('product_id')
//        ->toArray();
//
//    $favoriteProducts = Product::with('productpricing', 'category', 'favorite')
//        ->whereIn('id', $customerFavoriteProductIds)
//        ->paginate(8);
//
//    $products = ProductResource::collection($favoriteProducts);
//    $products->each(function ($product) {
//        $product->favoriteStats = 1;
//    });
//
//    return response()->json($products);
//}
