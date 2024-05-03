<?php

namespace App\Http\Controllers\Api;

use App\DTO\Users\UserRegisterDTO;
use App\DTO\Users\UserUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\CustomerRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Card;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{


    //Register New User
    public function register(CustomerRegisterRequest $request): JsonResponse
    {
        $request->validated();
        // Create the user
        $user = User::create(UserRegisterDTO::userInfoFromRequest($request));
        $tamweenCard = Card::create(UserRegisterDTO::cardInfoFromRequest($request));
        $customer = Customer::create(['card_id' => $tamweenCard->id, 'user_id' => $user->id]);
//        $customer->save();

        return response()->json(['message' => 'Registration successful'], 201);

    }

    public function login(CustomerLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->last_login_at = now();
            $user->save();

            $token = $user->createToken($request->device_name)->plainTextToken;

            return response()->json(['token' => $token, 'userId' => $user->id], 200);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }


    //User Logout
    public function logout(Request $request)
    {
//        Session::forget('user_id');

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }


}

