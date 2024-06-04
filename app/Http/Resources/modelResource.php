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
    public function toArray(Request $request): array
    {
        return [
            'user'=>$this->name,
            'past_orders'=>$this->order_made->pluck('product_id'),
            'favorites'=>$this->favorite->pluck('product_id')
        ];
    }
}
