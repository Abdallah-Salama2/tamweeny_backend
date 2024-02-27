<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
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
            'customerId' => $this->customer_id,
            'productId' => $this->product_id,
            'productName' => $this->product->product_name,
            //'productImage' => $this->product->product_image,
            'imageExtension' => $this->product->image_extension,
            'description' => $this->product->description,
            'sellingPrice' => $this->product->productpricing->selling_price,


        ];
    }
}
