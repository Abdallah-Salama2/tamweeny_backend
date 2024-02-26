<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customerId' => $this->customer_id,
            'productId' => (int)$this->product_id,
            'productName' => $this->product->product_name,
            'sellingPrice' => (double)$this->product->productpricing->selling_price,
            'quantity' => $this->quantity,
            'totalPrice' => $this->total_price

        ];
    }
}
