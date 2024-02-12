<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'productId'=>$this->productId,
            'productName'=>$this->productName,
            'productImage'=>$this->productImage,
            'decription'=>$this->description,
            'stock_quantity'=>$this->stock_quantity

        ];
    }
}
