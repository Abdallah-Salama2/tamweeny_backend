<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Models\Post;



class AuthController extends Controller
{

    public function index()
    {
       $users = UserResource::collection(User::paginate(10)); // Adjust the number based on your requirements
       // $users=User::paginate(10);
        return response()->json($users);
    }

    // search or specific user if not found will return all users
    public function findUser($id=null){
        return $id?User::find($id):User::all();
    }
    //Route:Get(/users/{id?},[finduser]);

    public function search($name) {
        return User::where("Name", "like", '%' . $name . '%')->get();
    }




    public function register(Request $request)
    {
        $request->validate([
            'NationalId' => 'required|string|max:255|unique:user,NationalId',
            'Name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => ['required', 'confirmed', 'min:8'],
            'Phone_number' => 'required|string|max:255',
            'City' => 'required|string|max:255',
            'State' => 'required|string|max:255',
            'Street' => 'required|string|max:255',
            'BirthDate' => 'required|date',
            'CardName' => 'required|string|max:255',
            'CardNumber' => 'required|string|max:255|unique:cards,CardNumber',
            'CardNationalId' => 'required|string|max:255|unique:cards,CardNationalId',
            'CardPassword' => 'required|string|max:255',
        ]);

        // Create the user
        $user = User::create([
            'NationalId' => $request->NationalId,
            'Name' => $request->Name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'Phone_number' => $request->Phone_number,
            'City' => $request->City,
            'State' => $request->State,
            'Street' => $request->Street,
            'BirthDate' => $request->BirthDate,
            'UserType' => '1', // Set the default value for UserType
            'Latitude' => '10.2',
            'Longitude' => '10.2',
        ]);

        $tamweenCard = Card::create([
            'CardName' => $request->CardName,
            'CardNumber' => $request->CardNumber,
            'CardNationalId' => $request->CardNationalId,
            'CardPassword' => Hash::make($request->CardPassword),
            // Add other fields as needed
            'Individuals Number' => '1',
            'BreadPoints' => '1',
            'TamweenPoints' => '1',
        ]);

        $customer = new Customer([
            'National_Id' => $request->NationalId,
            'TamweencardId' => $tamweenCard->id, // Assuming this is the ID of the created TamweenCard
        ]);

        // Create the Tamween card
        $user->save();
        $tamweenCard->save();
        $customer->save();
        $token = $user->createToken('registration-token')->plainTextToken;
        $list= response()->json(['message' => 'Registration successful', 'user' => $user, 'customer' => $customer, 'tamweenCard' => $tamweenCard]);
        print $list;
        return response()->json(['token' => $token], 201);

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

        return $user->createToken($request->device_name)->plainTextToken;
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
