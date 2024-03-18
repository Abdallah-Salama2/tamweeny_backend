<?php

namespace App\Http\Controllers\Api;

use App\DTO\Users\UserRegisterDTO;
use App\DTO\Users\UserUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Card;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{

    public function index(Request $request)
    {
        $users = User::with(
            'customer',
            'customer.card'
        )->get();

        return response()->json(UserResource::collection($users));
    }


    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'nationalId' => 'required|string|max:255|unique:users,national_id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'min:8'],
            'phoneNumber' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'birthDate' => 'required|date',
            'cardName' => 'required|string|max:255',
            'cardNumber' => 'required|string|max:255|unique:cards,card_number',
            'cardNationalId' => 'required|string|max:255|unique:cards,card_national_id',
            'cardPassword' => 'required|string|max:255',
        ]);

        // Create the user
        $user = User::create(UserRegisterDTO::userInfoFromRequest($request));
        $tamweenCard = Card::create(UserRegisterDTO::cardInfoFromRequest($request));
        $customer = Customer::create( ['card_id' => $tamweenCard->id,'user_id'=>$user->id]);
        $customer->save();

        //$token = $user->createToken('registration-token')->plainTextToken;
        //$list = response()->json(['message' => 'Registration successful', 'user' => $user, 'customer' => $customer, 'tamweenCard' => $tamweenCard]);
        //print $list;

        return response()->json(['message' => 'Registration successful'], 201);

    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }


        $user->last_login_at = now();
        $user->save();
        Session::put('user_id', $user->id);


        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token, 'userId' => $user->id], 201);
    }


    public function logout(Request $request)
    {
        Session::forget('user_id');

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    //        foreach ($users as $user) {
//            // Assuming the property you're trying to access is `id` and not `Id`
//            print("Loop UserID " .$user->id); // Accessing the `id` property of each `User` object
//        }

    public function updateUserInfo(Request $request)
    {
        // Retrieve user ID from the session
        //we can u se session to store user Id but using request from middlware is more secure
        $userId = $request->user()->id;

        // Fetch all users with related data
        $users = User::with('customer', 'customer.card')->get();

        // Retrieve the user from the collection by ID
        $user = $users->where("id", $userId)->first();
        $customerId = $user->customer->id;
        //print ("customerId: " . $customerId . "\n");


        $user->fill((UserUpdateDTO::userInfoFromRequest($request)));


        $requestData = $request->only([
            'cardName', 'cardNumber', 'cardNationalId', 'cardPassword',
        ]);

//         Update card information
        $cardId = $user->customer->card_id;
        $card = Card::where("Id", $cardId)->first();
        $card = $user->customer->card;


        $card->fill([
            'card_name' => $requestData['cardName'] ?? $card->card_name,
            'card_number' => $requestData['cardNumber'] ?? $card->card_number,
            'card_national_id' => $requestData['cardNationalId'] ?? $card->card_national_id,
            'card_password' => isset($requestData['cardPassword']) ? Hash::make($requestData['cardPassword']) : $card->card_password,
        ]);

        // Save changes
        $user->save();
        $card->save();
//
//        // Return response
//       // return new UserResource($user);
        return response()->json(['message' => 'User Info Updated successfully'], 200);

//        // Handle any exceptions
//
    }

//    public function updateUserInfo(Request $request)
//    {
//        $user = auth()->user();
//        $userId = $user->id;
//
//        // Fetch user's card information
//        $card = $user->customer->card;
//
//        // Validate and update user's information
//        $userData = UserUpdateDTO::userInfoFromRequest($request);
//        $user->update($userData);
//
//        // Validate and update card information
//        $cardData = UserUpdateDTO::cardInfoFromRequest($request);
//        $card->update($cardData);
//
//        // Return response
//        return response()->json(['message' => 'User info updated successfully'], 200);
//    }

    public function getLoggedInUserData(Request $request)
    {
        $user = auth()->user();

        // Fetch user's card information
        $card = $user->customer->card;

        // Validate and update user's information

        // Return response
        return response()->json(new UserResource ($user));
    }

    public function isNewUser(Request $request)
    {
        $user = auth()->user();
        $created_at_hour = Carbon::parse($user->created_at)->format('Y-m-d H'); // Extract hour from created_at timestamp
        $last_login_at_hour = Carbon::parse($user->last_login_at)->format('Y-m-d H'); // Extract hour from last_login_at timestamp

        $isNewUser = $created_at_hour === $last_login_at_hour;

        // Return response
        return response()->json(['isNewUser' => $isNewUser]);
    }
    public function orderedBefore(Request $request)
    {
        $user = auth()->user();
        // Log the user object
        logger()->info('User:', ['user' => $user]);

        // Check if the user has made any orders before
        $isNewUser = $user->customer->order_made->isEmpty();
        // Return response
        return response()->json(['isNewUser' => $isNewUser]);
    }

    public function userBalance(Request $request)
    {
        $user = auth()->user();

        // Fetch user's card information
        $card = $user->customer->card;
        $balance = $card->tamween_points;

        // Validate and update user's information

        // Return response
        return response()->json(['Balance' => $balance]);
    }

    public function deleteUser(Request $request)
    {
        // Retrieve the user ID from the session
        $userId = $request->user()->id;
        //print("UserID " . $userId . "\t");

        // Fetch all users with related data
        $users = User::with('customer', 'customer.order_made', 'customer.order', 'customer.favorite', 'customer.cart', 'customer.card')
            ->get();
        $user = $users->where("id", $userId)->first();
        $customer = $user->customer;

//        $card = $user->customer->card;
//        if ($card) {
//            print ($card);
//        } else {
//            print ("No card found");
//
//        }
        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        if ($customer) {
            $cardId = $customer->card_id;
            if ($customer->order_made) {
                $customer->order_made->each->delete();
            } else {
                logger()->warning('Order_made record not found for user', ['user_id' => $userId]);
            }
//        print($customer->favorite);

            if ($customer->favorite) {
                $customer->favorite->each->delete();
            } else {
                logger()->warning('Favorite record not found for user', ['user_id' => $userId]);
            }
            if ($customer->order) {
                $customer->order->each->delete();
            } else {
                logger()->warning('Order record not found for user', ['user_id' => $userId]);
            }
            if ($customer->cart) {
                $customer->cart->each->delete();
            } else {
                logger()->warning('Cart record not found for user', ['user_id' => $userId]);
            }
            $card = Card::where("id", $cardId)->first();
            // Delete related customer record
            if ($user->customer) {
                $user->customer->delete();
            }
            $card->delete();
            $user->delete();

        }

//         Get the associated card record


        $user->delete();


        return response()->json(['message' => 'User deleted successfully'], 200);
    }


//    public function test()
//    {
//        $users = User::all();
//        return response()->json(UserResource::collection($users));
//    }

    // search or specific user if not found will return all users
    public function findUser($id = null)
    {
        $user = User::where('id', $id)->get();
        return $user;
    }

    //Route:Get(/users/{id?},[finduser]);

    public function search($name)
    {
        return User::where("Name", "like", '%' . $name . '%')->get();
    }


}


//$userResources = UserResource::collection($user);


/* Find the user from the collection by ID
//        $user = $users->first(function ($user) use ($customerId) {
//            return $user->customer->id == $customerId;
//        });
//
//        print($user."\n");
//print($userId2."\n");
//$customerId = 1; // Replace 1 with the actual customer ID you want to search for
//dd(Session::all());
//print($users."\n");
// Transform the users collection into a collection of UserResource
//print ($userResources."\n");
// Check if the user was found
//if ($user) {
//    //  print($user);
//} else {
//    // User not found
//    // Handle the case when the user with the specified ID is not found
//    print("User not found.");
//}
//print($customer);
//        $customer =Customer::where("national_id",$national_id)->first();
//        $customerId=$customer->id;
//        //print ($customerId);
//$national_id=$user->national_id;
//$customer=$user->customer;
//$card=Card::where("Id",$customerId)->first();
//print($card);
//$card->card_name=$request->input('card_name');*/
########################################################################################################################################################
########################################################################################################################################################
########################################################################################################################################################

//    public function fake2(Request $request)
//    {
//        $request->validate([
//            'NationalId' => 'string|max:255|unique:user,NationalId',
//            'Name' => 'string|max:255',
//            'email' => 'string|email|max:255|unique:user,email',
//            'password' => 'string',
//            'Phone_number' => 'string|max:255',
//            'City' => 'string|max:255',
//            'State' => 'string|max:255',
//            'Street' => 'string|max:255',
//            'BirthDate' => 'date',
//            'CardName' => 'string|max:255',
//            'CardNumber' => 'string|max:255|unique:cards,CardNumber',
//            'CardNationalId' => 'string|max:255|unique:cards,CardNationalId',
//            'CardPassword' => 'string|max:255',
//        ]);
//
//        // Create the user
//        $user = User::create([
//            'NationalId' => '132456789 ',
//            'Name' => 'fake',
//            'email' => 'fake@fake.com',
//            'password' => '111',
//            'Phone_number' => '12345678910',
//            'City' => 'fakeCity',
//            'State' => 'fakeState',
//            'Street' => 'fakeStreet',
//            'BirthDate' => '2023-12-11',
//            'UserType' => '1', // Set the default value for UserType
//            'Latitude' => '10.2',
//            'Longitude' => '10.2',
//        ]);
//
//        $tamweenCard = Card::create([
//            'CardName' => 'fakeCard',
//            'CardNumber' => '111',
//            'CardNationalId' => '12347885566321',
//            'CardPassword' => '111',
//            // Add other fields as needed
//            'Individuals Number' => '1',
//            'BreadPoints' => '1',
//            'TamweenPoints' => '1',
//        ]);
//
//        $customer = new Customer([
//            'National_Id' => '132456789',
//            'TamweencardId' => $tamweenCard->id, // Assuming this is the ID of the created TamweenCard
//        ]);
//
//        // Create the Tamween card
//        $user->save();
//        $tamweenCard->save();
//        $customer->save();
//        $token = $user->createToken('registration-token')->plainTextToken;
//        $list= response()->json(['message' => 'Registration successful', 'user' => $user, 'customer' => $customer, 'tamweenCard' => $tamweenCard]);
//        print $list;
//        return response()->json(['token' => $token], 201);
//
//    }


//   $user->fill($request->only(['name', 'email', 'national_id', 'password', 'phone_number', 'city', 'state', 'street', 'birth_date', 'user_type', 'latitude','longitude',]));
//        $card->fill($request->only(['card_name', 'card_number', 'card_national_id', 'individuals_number','bread_points','tamween_points']));

########################################################################################################################################################
########################################################################################################################################################
########################################################################################################################################################


/*       $users = DB::table('users')
//        ->join('customers','users.national_id','=','customers.national_id')
//        ->join('cards','customers.card_id','=','cards.Id')
//        ->get(); // Joining posts with users and paginating the results
//$users = Customer::with('card')->paginate(10); // Joining posts with users and paginating the results
//return response()->json($users);
//    public function index()
//    {
//        $users = DB::table('users')
//            ->join('customers','users.national_id','=','customers.national_id')
//            ->join('cards','customers.card_id','=','cards.Id')
//            ->get(); // Joining users with customers and cards
//
//        $formattedData = [];
//
//        foreach ($users as $user) {
//            $formattedData[] = [
//                'id' => $user->id,
//                'national_id' => $user->national_id,
//                'name' => $user->name,
//                'email' => $user->email,
//                'password' => $user->password,
//                'phone_number' => $user->phone_number,
//                'city' => $user->city,
//                'state' => $user->state,
//                'street' => $user->street,
//                'birth_date' => $user->birth_date,
//                'user_type' => $user->user_type,
//                'latitude' => $user->latitude,
//                'longitude' => $user->longitude,
//                'created_at' => $user->created_at,
//                'updated_at' => $user->updated_at,
//                'national_id' => $user->national_id,
//                'cardId' => $user->card_id,
//                'card_name' => $user->card_name,
//                'card_number' => $user->card_number,
//                'card_national_id' => $user->card_national_id,
//                'card_password' => $user->card_password,
//                'individuals_number' => $user->individuals_number,
//                'bread_points' => $user->bread_points,
//                'tamween_points' => $user->tamween_points,
//            ];
//        }
//
//        return response()->json($formattedData);
    }*/
