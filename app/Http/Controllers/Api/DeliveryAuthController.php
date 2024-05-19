<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DeliveryAuthController extends Controller
{

//    public function login(CustomerLoginRequest $request)
//    {
//        $credentials = $request->only('email', 'password');
//
//        if (Auth::attempt($credentials)) {
//            $user = Auth::user();
//            $user->last_login_at = now();
//            $user->save();
//
//            $token = $user->createToken($request->device_name)->plainTextToken;
//
//            return response()->json(['token' => $token, 'userId' => $user->id], 200);
//        }
//
//        throw ValidationException::withMessages([
//            'email' => ['The provided credentials are incorrect.'],
//        ]);
//    }

    public function login(Request $request)
    {
        //
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->last_login_at = now();
            $user->save();

            $token = $user->createToken($request->device_name)->plainTextToken;

        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);

    }


    public function logout()
    {
        //
    }


}
