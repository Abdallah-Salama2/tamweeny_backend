<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class modelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'user' => $this->name, // Adjust according to your user fields
            'past_orders' => $this->order_made->pluck('product_id'), // Assuming `order_made` relation returns products
            'favorites' => $this->favorite->pluck('product_id'), // Assuming `favorite` relation returns products
        ];
    }
}
