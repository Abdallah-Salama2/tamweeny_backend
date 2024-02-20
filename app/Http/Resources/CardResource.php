<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'cardName' => $this->card_name,
            'cardNumber' => $this->card_number,
            'cardNationalId' => $this->card_national_id,
            'cardPassword' => $this->card_password,
            'individualsNumber' => $this->individuals_number,
            'breadPoints' => $this->bread_points,
            'tamweenPoints' => $this->tamween_points
        ];
    }

}
