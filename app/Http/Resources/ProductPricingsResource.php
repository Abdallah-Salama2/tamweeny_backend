<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPricingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Id' => $this->Id,
            'product_id' => $this->product_id,
            'base_price' => $this->base_price,
            'selling_price' => $this->selling_price,
            'discount' => $this->discount,
            'discount_unit' => $this->discount_unit,
            'date_created' => $this->date_created,
            'exipred_date' => $this->exipred_date,
        ];
    }

}
