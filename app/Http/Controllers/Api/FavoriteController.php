<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Models\Customer;
use App\Models\Favorite;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userId = Session::get('user_id');
        print("UserID ". $userId ."\n");

        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();

        // Retrieve the user from the collection by ID
        $user = $users->where("Id", $userId)->first();
        $customerId=$user->customer->Id;
        print ("customerId ".$customerId ."\n");



    }

    public function add(Request $request,$productId)
    {
        //
        $userId = Session::get('user_id');
        print("UserID". $userId ."\n");

        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();

        // Retrieve the user from the collection by ID
        $user = $users->where("Id", $userId)->first();
        $customerId=$user->customer->Id;
        print ("customerId".$customerId ."\n");

        $favorite=  Favorite::create([
            'customer_id'=>$customerId,
            'product_id'=>$productId,
        ]);
        $favorite->save();

        return response()->json($favorite);


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
