<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Orders_madeResource extends JsonResource
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
            'orderId' => $this->order_id,
            'productId' => $this->product_id,
            'productName' => $this->product_name,
            'description' => $this->product->category->category_name,

            'quantity' => $this->quantity,
            'totalPrice' => $this->total_price,
            'customerId' => $this->customer_id
        ];
    }
}
