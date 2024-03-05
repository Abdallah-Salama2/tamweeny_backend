<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource2 extends JsonResource
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
            'orderDate' => $this->order_date,
            'orderPrice' => $this->order_price,
            //'discountCode' => $this->discount_code,
            //'deliveryStatus' => $this->delivery_status,
            //'paymentNumber' => $this->payment_number,
            'customerId' => $this->customer_id,
            //'deliveryId' => $this->delivery_id,


            'ordersMade' => Orders_madeResource::collection($this->ordersMade)

        ];
    }
}
