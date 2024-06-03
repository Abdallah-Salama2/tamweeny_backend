<?php

namespace App\DTO\Users;

use Illuminate\Http\Request;

class UserUpdateDTO
{
    public static function userInfoFromRequest(Request $request): array
    {
        $fields = [
            'nationalId' => 'national_id',
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
            'phoneNumber' => 'phone_number',
            'city' => 'city_state',
            'street' => 'street',
            'birthDate' => 'birth_date',
        ];

        $data = [];

        foreach ($fields as $requestField => $dbField) {
            if ($request->has($requestField)) {
                $data[$dbField] = $request->input($requestField);
            }
        }

        return $data;
    }

    public static function cardInfoFromRequest(Request $request): array
    {
        return $request->only([
            'cardName',
            'cardNumber',
            'cardNationalId',
            'cardPassword',
        ]);
    }
}

//
//namespace App\DTO\Users;
//
//use Illuminate\Http\Request;
//use Illuminate\Support\Str;
//
//
//class UserUpdateDTO
//{
//    public static function userInfoFromRequest(Request $request): array
//    {
//        $data = [];
//
//        foreach ($request->all() as $key => $value) {
//            $data[self::snakeToLowerCase($key)] = $value;
//        }
//
//
//        return $data;
//    }
//
//    public static function cardInfoFromRequest(Request $request): array
//    {
//        $data = [];
//
//        foreach ($request->all() as $key => $value) {
//            $data[self::snakeToLowerCase($key)] = $value;
//        }
//
//        return $data;
//    }
//
//    private static function snakeToLowerCase(string $key): string
//    {
//        return strtolower(Str::snake($key));
//    }
//}

/*
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
            $data['city_state'] = $request->input('city');
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
        return $request->only([
            'cardName',
            'cardNumber',
            'cardNationalId',
            'cardPassword',
        ]);
    }

}
*/
