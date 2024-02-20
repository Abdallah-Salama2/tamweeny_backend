<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Cassandra\Custom;
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
            'id' => $this->Id,
            'nationalId' => $this->national_id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'phoneNumber' => $this->phone_number,
            'city' => $this->city,
            'state' => $this->state,
            'street' => $this->street,
            'birthDate' => $this->birth_date,
            'userType' => $this->user_type,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'customerId' =>$this->customer->Id ?? null, //should be Id in customers table of Customer model not Id in user Model but idont know how to do it
            'cardId' => $this->customer->card->Id ?? null, // Check if customer and card exist
            'cardName' => $this->customer->card->card_name ?? null,
            'cardNumber' => $this->customer->card->card_number ?? null,
            'cardNationalId' => $this->customer->card->card_national_id ?? null,
            'cardPassword' => $this->customer->card->card_password ?? null,
            'individualsNumber' => $this->customer->card->individuals_number ?? null,
            'breadPoints' => $this->customer->card->bread_points ?? null,
            'tamweenPoints' => $this->customer->card->tamween_points ?? null
        ];
    }
}
