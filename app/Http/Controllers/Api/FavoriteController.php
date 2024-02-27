<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Http\Resources\FavoriteResource;
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
    public function index()
    {
        $userId = Session::get('user_id');
        //print("UserID " . $userId . "\n");
        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();
        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
        //print ("CustomerId " . $customerId . "\n");


        $customerFavorites = Favorite::where("customer_id", $user->customer->id)->get();

        //$favorites=Favorite::all();

        return response()->json(FavoriteResource::Collection($customerFavorites));

    }

    public function add($productId)
    {
        //
        $userId = Session::get('user_id');
//        print("UserID " . $userId . "\n");

        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();

        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        //print($user);

        $customerId = $user->customer->id;
//        print ("CustomerId " . $customerId . "\n");

        $product = Product::where("id", $productId)->first();
        $productInCart = Favorite::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->first();

        if ($productInCart) {
            // Handle the case where the product already exists in the cart
            $productInCart->delete();
            return response()->json([
                'message' => 'Product removed from Favorites.',
            ],409);
        }


        $favorite = Favorite::create([
            'customer_id' => $customerId,
            'product_id' => $productId,
        ]);
        $favorite->save();

        return response()->json([
            'message' => 'Product Added To Favorites ',
        ],200);

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
