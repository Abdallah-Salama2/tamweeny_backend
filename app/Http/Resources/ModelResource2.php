<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ModelResource2 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
//            'orderDate' => $this->order_date,
            'orderPrice' => $this->order_price,
            'transactionNumber'=>2534,
            'transactionDate'=>$this->order_date,
            'customerName'=>auth()->user()->name,
            'customerPhone'=> auth()->user()->phone_number,
            'customerAddress'=> auth()->user()->street ." ".auth()->user()->city_state,
            'userLat'=> auth()->user()->latitude,
            'userLong'=> auth()->user()->longitude,
            //'discountCode' => $this->discount_code,
            'deliveryStatus' => $this->delivery_status,
            //'paymentNumber' => $this->payment_number,
                    'customerId' => $this->customer_id,
            //'deliveryId' => $this->delivery_id,


            'ordersMade' => Orders_madeResource::collection($this->ordersMade)

        ];
    }
}
