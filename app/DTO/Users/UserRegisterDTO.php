<?php

namespace App\DTO\Users;

use Illuminate\Http\Request;

//DTO = Data Transfer Objects
class UserRegisterDTO
{
    public static function userInfoFromRequest(Request $request): array
    {
        return [
            'national_id' => $request->input('nationalId'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phone_number' => $request->input('phoneNumber'),
            'city_state' => $request->input('city'),
            'street' => $request->input('street'),
            'birth_date' => $request->input('birthDate'),
        ];
    }

    public static function cardInfoFromRequest(Request $request): array
    {
        return [
            'card_name' => $request->input('cardName'),
            'card_number' => $request->input('cardNumber'),
            'card_national_id' => $request->input('cardNationalId'),
            'card_password' => $request->input('cardPassword'),
        ];
    }

    public static function customerInfoFromRequest(Request $request): array
    {
        return [
            'user_id' => $request->input('nationalId'),
        ];
    }
}
