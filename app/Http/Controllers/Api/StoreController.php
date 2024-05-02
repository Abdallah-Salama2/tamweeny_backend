<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::all();
        return response()->json(StoreResource::collection($stores));
    }

    /**
     * Show latitude and longitude of stores.
     */
    public function showLatLong()
    {
        $stores = Store::all();
        $combinedData = $stores->map(function ($store) {
            return [$store->id, $store->latitude, $store->longitude];
        });

        return response()->json($combinedData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // You can implement the logic for storing a new store here.
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        // You can implement the logic for displaying a specific store here.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        // You can implement the logic for updating a store here.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        // You can implement the logic for deleting a store here.
    }
}
