<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OrderResource2 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user=User::find($this->customer_id);

        return [
            'id' => $this->id,
//            'orderDate' => $this->order_date,
            'orderPrice' => $this->order_price,
            'transactionNumber'=>2534,
            'transactionDate'=>$this->order_date,
            'customerName'=>$user->name,
            'customerPhone'=> $user->phone_number,
            'customerAddress'=> $user->street ." ".$user->city_state,
            'userLat'=> $user->latitude,
            'userLong'=> $user->longitude,
            //'discountCode' => $this->discount_code,
            'deliveryStatus' => $this->delivery_status,
            //'paymentNumber' => $this->payment_number,
            'customerId' => $this->customer_id,
            //'deliveryId' => $this->delivery_id,


            'ordersMade' => Orders_madeResource::collection($this->ordersMade)

        ];
    }
}


