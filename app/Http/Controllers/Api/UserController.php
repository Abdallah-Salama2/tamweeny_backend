<?php

namespace App\Http\Controllers\Api;

use App\DTO\Users\UserUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    //List All users for test
    public function index(Request $request): JsonResponse
    {
        $users = User::with(
            'customer',
            'customer.card'
        )->get();

        return response()->json(UserResource::collection($users));
    }

    public function ay7aga(Request $request): JsonResponse
    {
//        $gg =User::with('customer', 'customer.order_made', 'customer.order', 'customer.favorite', 'customer.cart', 'customer.card')
//            ->get();;
//        $card = auth()->user()->customer->card;

        $customerId = auth()->user()->customer->id;

        return response()->json([$customerId]);
    }


    public function updateUserInfo(Request $request): JsonResponse
    {
        $user= auth()->user();
        $user->fill((UserUpdateDTO::userInfoFromRequest($request)));
        $user->save();

        return response()->json(['message' => 'User Info Updated successfully'], 200);

    }

    //Get User Data
    public function getLoggedInUserData(Request $request): JsonResponse
    {
        $user = auth()->user();

        return response()->json(new UserResource ($user));
    }

    //Check New User
//    public function isNewUser(Request $request)
//    {
//        $user = auth()->user();
//        $created_at_hour = Carbon::parse($user->created_at)->format('Y-m-d H'); // Extract hour from created_at timestamp
//        $last_login_at_hour = Carbon::parse($user->last_login_at)->format('Y-m-d H'); // Extract hour from last_login_at timestamp
//
//        $isNewUser = $created_at_hour === $last_login_at_hour;
//
//        return response()->json(['isNewUser' => $isNewUser]);
//    }

    //Check New User 2nd method
    public function orderedBefore(): JsonResponse
    {
        $user = auth()->user();
        $isNewUser = $user->customer->order_made->isEmpty();

        return response()->json(['isNewUser' => $isNewUser]);
    }

    //Get User Balance
    public function userBalance(): JsonResponse
    {
        $user = auth()->user();

        $card = $user->customer->card;
        $balance = $card->tamween_points;

        // Return response
        return response()->json(['Balance' => $balance]);
    }

    //Delete User Account
    public function deleteUser(): JsonResponse
    {

        $user = auth()->user();
        $card = auth()->user()->customer->card;
        $card->delete();
        $user->delete();


        return response()->json(['message' => 'User deleted successfully'], 200);
    }


    // search or specific user if not found will return all users
    public function findUser($id = null)
    {
        $user = User::where('id', $id)->get();
        return $user;
    }

    // Search for User using Name
    public function search($name)
    {
        return User::where("Name", "like", '%' . $name . '%')->get();
    }

}
//public function updateUserInfo(Request $request)
//{
//    $user= auth()->user();
////        $userId= auth()->user()->id;
////        // Fetch all users with related data
////        $users = User::with('customer', 'customer.card')->get();
////
////        // Retrieve the user from the collection by ID
////        $user = $users->where("id", $userId)->first();
//
//    $user->fill((UserUpdateDTO::userInfoFromRequest($request)));
//
////        $requestData = $request->only([
////            'cardName', 'cardNumber', 'cardNationalId', 'cardPassword',
////        ]);
////        $cardId = $user->customer->card_id;
////        $card = Card::where("Id", $cardId)->first();
////        $card = $user->customer->card;
////
////
////        $card->fill([
////            'card_name' => $requestData['cardName'] ?? $card->card_name,
////            'card_number' => $requestData['cardNumber'] ?? $card->card_number,
////            'card_national_id' => $requestData['cardNationalId'] ?? $card->card_national_id,
////            'card_password' => isset($requestData['cardPassword']) ? Hash::make($requestData['cardPassword']) : $card->card_password,
////        ]);
//
//    // Save changes
//    $user->save();
////        $card->save();
//
//    return response()->json(['message' => 'User Info Updated successfully'], 200);
//
//}



//Kont 3amel kol dah 3shan mkontsh mzbt migrations w m3rfsh ya3ny eih cascade on Delete

//public function deleteUser(Request $request): \Illuminate\Http\JsonResponse
//{
    // Retrieve the user ID from the session
//        $userId = auth()->user()->id;
//    $user = auth()->user();
//    $card = auth()->user()->customer->card;
//    $card->delete();


//        $users = User::with('customer', 'customer.order_made', 'customer.order', 'customer.favorite', 'customer.cart', 'customer.card')
//            ->get();
//        $user = $users->where("id", $userId)->first();
//        // Check if the user exists
//        if (!$user) {
//            return response()->json(['message' => 'User not found'], 404);
//        }
//        $cardId = $user->customer->card_id;
//        $card = Card::where("id", $cardId)->first();
//        if ($user->customer) {
//            // Delete associated records
//            $user->customer->order_made()->delete();
//            $user->customer->favorite()->delete();
//            $user->customer->order()->delete();
//            $user->customer->cart()->delete();
//            $user->customer->delete();
//
//            $card->delete();
//
//        }

//    $user->delete();
//
//
//    return response()->json(['message' => 'User deleted successfully'], 200);
//}
