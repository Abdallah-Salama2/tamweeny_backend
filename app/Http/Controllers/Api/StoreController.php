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
        //
        $stores = Store::all();
        return response()->json(StoreResource::collection($stores));
        /*[
    {
        "storeId": 1,
        "owner_id": 1,
        "storeName": "مكتب تموين مدينة نصر\n",
        "address": "78 مساكن عثمان بجوار شركه كاسيو مدينة نصر",
        "type": "مكتب حكومي",
        "valid": 1,
        "latitude": "30.05283352",
        "longitude": "31.33477916"
    },
    {
        "storeId": 2,
        "owner_id": 1,
        "storeName": "تموين الحي العاشر\r\n",
        "address": "29VG+H6P, Al Hay Al Asher, Nasr City, Cairo Governorate 4442255",
        "type": "بقاله",
        "valid": 1,
        "latitude": "30.04518064",
        "longitude": "31.37614544"
    },
    {
        "storeId": 3,
        "owner_id": 1,
        "storeName": "مكتب التموين الحى العاشر\r\n",
        "address": "29WG+GFM، فى اخر شارع سوق الحى العاشر محل الاسلامية للادوات الكهربية تخش الحارة اللى جنبه على طول هتلقى صيدلية بنفس عمارة الصيدلية الدور الثالث, Nasr City, Cairo Governorate",
        "type": "مكتب حكومي",
        "valid": 1,
        "latitude": "30.04848509",
        "longitude": "31.37632299"
    },
    {
        "storeId": 4,
        "owner_id": 1,
        "storeName": "تموين الحاج شكوكو\r\n",
        "address": "27VM+P3J, Al Abageyah, Manshiyat Naser, Cairo Governorate 4421553",
        "type": "بقالة",
        "valid": 0,
        "latitude": "30.04466362",
        "longitude": "31.28357688"
    },
    {
        "storeId": 5,
        "owner_id": 1,
        "storeName": "بقاله اسامه تموين\r\n",
        "address": "393M+227، مدينة نصر،, Nasr City, Cairo Governorate",
        "type": "بقاله",
        "valid": 1,
        "latitude": "30.05357878",
        "longitude": "31.38593515"
    }
]*/
    }

    public function showLatLong()
    {
        //
        //$stores = StoreResource::collection(Store::all());
        //return $stores;
        $stores = Store::all();

        $combinedData = [];

        foreach ($stores as $store) {
            $combinedData[] = [
                $store->id,
                $store->latitude,
                $store->longitude,

            ];
        }

        return response()->json($combinedData);
        //return response()->json(['token' => $token,'id'=>$user->id], 201);
        /*[
        1,
        "30.05283352",
        "31.33477916"
    ],
    [
        2,
        "30.04518064",
        "31.37614544"
    ],
    [
        3,
        "30.04848509",
        "31.37632299"
    ],
    [
        4,
        "30.04466362",
        "31.28357688"
    ],
    [
        5,
        "30.05357878",
        "31.38593515"
    ]
        */

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
    public function show(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
