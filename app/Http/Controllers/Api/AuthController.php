<?php

namespace App\Http\Controllers\Api;

use App\DTO\Users\UserRegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\CustomerRegisterRequest;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{


    //Register New User
    public function register(CustomerRegisterRequest $request): JsonResponse
    {
        $request->validated();
        // Create the user
        //Note Password is Hashed auto From User Model In Protected casts
        $user = User::create(UserRegisterDTO::userInfoFromRequest($request));
        Card::create(UserRegisterDTO::cardInfoFromRequest($request,$user->id));
        $user->assignRole('customer');
        return response()->json(['message' => 'Registration successful'], 201);

    }
    public function updateLastLogin(User $user)
    {
        $user->last_login_at = now();
        $user->save();
    }


    public function login(CustomerLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();
        $this->updateLastLogin($user);

        $token = $user->createToken('token-name')->plainTextToken;
        Session::put('api_token', $user->name);

        return response()->json(['token' => $token, 'userId' => $user->id, 'userType' => $user->user_type], 200);
    }


    //User Logout
    public function logout(Request $request)
    {
//        Session::forget('user_id');

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }


}

