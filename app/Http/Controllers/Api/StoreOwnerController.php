<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreOwnerResource;
use App\Models\StoreOwner;
use Illuminate\Http\Request;

class StoreOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $owners = StoreOwner::all();
        return response()->json(StoreOwnerResource::collection($owners));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StoreOwner $storeOwner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StoreOwner $storeOwner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreOwner $storeOwner)
    {
        //
    }
}
