<?php

namespace App\DTO\Users;

use Illuminate\Http\Request;

class UserUpdateDTO
{
    public static function userInfoFromRequest(Request $request): array
    {
        $data = [];

        if ($request->has('nationalId')) {
            $data['national_id'] = $request->input('nationalId');
        }

        if ($request->has('name')) {
            $data['name'] = $request->input('name');
        }

        if ($request->has('email')) {
            $data['email'] = $request->input('email');
        }

        if ($request->has('password')) {
            $data['password'] = $request->input('password');
        }

        if ($request->has('phoneNumber')) {
            $data['phone_number'] = $request->input('phoneNumber');
        }

        if ($request->has('city')) {
            $data['city'] = $request->input('city');
        }

        if ($request->has('state')) {
            $data['state'] = $request->input('state');
        }

        if ($request->has('street')) {
            $data['street'] = $request->input('street');
        }

        if ($request->has('birthDate')) {
            $data['birth_date'] = $request->input('birthDate');
        }

        return $data;
    }

    public static function cardInfoFromRequest(Request $request): array
    {
        $data = [];

        if ($request->has('cardName')) {
            $data['card_name'] = $request->input('cardName');
        }

        if ($request->has('cardNumber')) {
            $data['card_number'] = $request->input('cardNumber');
        }

        if ($request->has('cardNationalId')) {
            $data['card_national_id'] = $request->input('cardNationalId');
        }

        if ($request->has('cardPassword')) {
            $data['card_password'] = $request->input('cardPassword');
        }

        return $data;
    }

}
