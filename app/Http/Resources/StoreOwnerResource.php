<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreOwnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ['id' => $this->id,
            'taxRegistrationNumber' => $this->tax_registration_number,
            'nationalId' => $this->national_id,
            'taxCard' => $this->tax_card];
    }
}
