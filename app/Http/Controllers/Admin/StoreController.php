<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stores = Store::all(); // or any other way you retrieve your stores

        $stores->load([
            'user',
            'products' => function ($query) {
                $query->where('product_type', 0);
            }
        ]);
        return Inertia::render('Admin/Stores/Index', [
            'stores' => $stores,
        ]);
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
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $product = DB::table('stores_products')
//            ->join('products','stores_products.product_id','=','products.id')
            ->where('product_id', $request->product_id)
            ->where('store_id', $request->store_id)
            ->update(['quantity' => DB::raw('quantity + ' . $request->quantity)]);
        $productId = $request->product_id;
//        $product = Product::join('stores_products', 'products.id', '=', 'stores_products.product_id')
//            ->where('stores_products.product_id',$productId)->And('stores_products.product_id',$request->store_id)->get();
//        $products = $store->products;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
