<?php

namespace App\DTO\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserUpdateDTO
{
    public static function userInfoFromRequest(Request $request): array
    {
        $data = [];

        foreach ($request->all() as $key => $value) {
            $data[self::snakeToLowerCase($key)] = $value;
        }

        return $data;
    }

    public static function cardInfoFromRequest(Request $request): array
    {
        $data = [];

        foreach ($request->all() as $key => $value) {
            $data[self::snakeToLowerCase($key)] = $value;
        }

        return $data;
    }

    private static function snakeToLowerCase(string $key): string
    {
        return strtolower(Str::snake($key));
    }
}
