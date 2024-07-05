<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'nationalId' => $this->national_id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'phoneNumber' => $this->phone_number,
            'city' => $this->city_state,
            'street' => $this->street,
            'birthDate' => $this->birth_date,
            'userType' => $this->user_type,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
//            'customerId' => $this->id ?? null, //should be Id in customers table of Customer model not Id in user Model but idont know how to do it
            'cardId' => $this->card->id ?? null, // Check if customer and card exist
            'cardName' => $this->card->card_name ?? null,
            'cardNumber' => $this->card->card_number ?? null,
            'cardNationalId' => $this->card->card_national_id ?? null,
            'cardPassword' => $this->card->card_password ?? null,
            'individualsNumber' => $this->card->individuals_number ?? null,
            'tamweenPoints' => $this->card->tamween_balance ?? null
        ];
    }
}
