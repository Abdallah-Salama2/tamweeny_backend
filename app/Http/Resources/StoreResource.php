<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'          => $this -> Id          ,
            'ownerId'    => $this -> owner_id    ,
            'storeName'  => $this -> store_name  ,
            'address'     => $this -> address     ,
            'phoneNumber'=> $this -> phone_number,
            'type'        => $this -> type        ,
            'valid'       => $this -> valid       ,
            'latitude'    => $this -> latitude    ,
            'longitude'   => $this -> longitude   ,
        ];
    }
}
