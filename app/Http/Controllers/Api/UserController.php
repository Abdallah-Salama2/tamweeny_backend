<?php

namespace App\Http\Controllers\Api;

use App\DTO\Users\UserUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\modelResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    //List all users
    public function index(): JsonResponse
    {
        $users = User::with('card', 'favorite', 'order_made')->where('user_type', 'customer')->get();
        return response()->json(modelResource::collection($users));

    }

    // Update user info
    public function updateUserInfo(Request $request): JsonResponse
    {
        $user = Auth::user();

        $userData = UserUpdateDTO::userInfoFromRequest($request);

        if (isset($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        }

        $user->fill($userData);
        $user->save();

        return response()->json(['message' => 'User info updated successfully'], 200);
    }

    // Get logged in user data
    public function getLoggedInUserData(): JsonResponse
    {
        $user = auth()->user();
        return response()->json(new UserResource($user));
    }

    // Check if the user has ordered before
    public function orderedBefore(): JsonResponse
    {
        $user = Auth::user();
        $isNewUser = $user->order_made->isEmpty();
        return response()->json(['isNewUser' => $isNewUser]);
    }

    // Get user balance
    public function userBalance(): JsonResponse
    {
        $user = Auth::user();
        $balance = $user->card->tamween_points;
        return response()->json(['Balance' => $balance]);
    }

    // Delete user account
    public function destroy(): JsonResponse
    {
        $user = Auth::user();
        $user->card->delete();
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    // Search for user by ID or return all users if ID is not provided
    public function findUser($id = null)
    {
        if ($id) {
            return User::where('id', $id)->get();
        } else {
            return User::all();
        }
    }

    // Search for user by name
    public function search($name)
    {
        return User::where("name", "like", '%' . $name . '%')->get();
    }
//
//    // Show user by ID or name
//    public function show(User $user)
//    {
//        $userByName = User::where("name", "like", '%' . $user . '%')->first();
//        if ($userByName) {
//            return $userByName;
//        }
//        $userById = User::find($user->id);
//        if ($userById) {
//            return $userById;
//        }
//        return response()->json(['message' => 'User not found'], 404);
//    }
}
