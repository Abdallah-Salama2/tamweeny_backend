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
            'id' => $this->Id,
            'productId' => $this->product_id,
            'basePrice' => $this->base_price,
            'sellingPrice' => $this->selling_price,
            'discount' => $this->discount,
            'discountUnit' => $this->discount_unit,
            'dateCreated' => $this->date_created,
            'exipredDate' => $this->exipred_date,
        ];
    }

}
