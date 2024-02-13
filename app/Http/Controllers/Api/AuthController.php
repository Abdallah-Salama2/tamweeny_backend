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
use Illuminate\Support\Facades\DB;




class AuthController extends Controller
{

    public function index()
    {


        $users = DB::table('user')
        ->join('customer','user.nationalId','=','customer.national_id')
        ->join('cards','customer.tamweenCardId','=','cards.cardId')
        ->get(); // Joining posts with users and paginating the results
        //$users = Customer::with('card')->paginate(10); // Joining posts with users and paginating the results

        return response()->json($users);
    }

    // search or specific user if not found will return all users
    public function findUser($id=null){
        $user=User::where('Id',$id)->get();
        return $user;
    }
    //Route:Get(/users/{id?},[finduser]);

    public function search($name) {
        return User::where("Name", "like", '%' . $name . '%')->get();
    }




    public function register(Request $request)
    {
        $request->validate([
            'nationalId' => 'required|string|max:255|unique:user,nationalId',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => ['required', 'confirmed', 'min:8'],
            'phone_number' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'birthDate' => 'required|date',
            'cardName' => 'required|string|max:255',
            'cardNumber' => 'required|string|max:255|unique:cards,cardNumber',
            'cardNationalId' => 'required|string|max:255|unique:cards,cardNationalId',
            'cardPassword' => 'required|string|max:255',
        ]);

        // Create the user
        $user = User::create([
            'nationalId' => $request->nationalId,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'city' => $request->city,
            'state' => $request->state,
            'street' => $request->street,
            'birthDate' => $request->birthDate,
            'userType' => '1', // Set the default value for UserType
            'latitude' => '10.2',
            'longitude' => '10.2',
        ]);

        $tamweenCard = Card::create([
            'cardName' => $request->cardName,
            'cardNumber' => $request->cardNumber,
            'cardNationalId' => $request->cardNationalId,
            'cardPassword' => Hash::make($request->cardPassword),
            // Add other fields as needed
            'individualsNumber' => '1',
            'breadPoints' => '1',
            'tamweenPoints' => '1',
        ]);

        $customer = new Customer([
            'national_id' => $request->nationalId,
            'tamweenCardId' => $tamweenCard->cardId, // Assuming this is the ID of the created TamweenCard
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
    public function fake2(Request $request)
    {
        $request->validate([
            'NationalId' => 'string|max:255|unique:user,NationalId',
            'Name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:user,email',
            'password' => 'string',
            'Phone_number' => 'string|max:255',
            'City' => 'string|max:255',
            'State' => 'string|max:255',
            'Street' => 'string|max:255',
            'BirthDate' => 'date',
            'CardName' => 'string|max:255',
            'CardNumber' => 'string|max:255|unique:cards,CardNumber',
            'CardNationalId' => 'string|max:255|unique:cards,CardNationalId',
            'CardPassword' => 'string|max:255',
        ]);

        // Create the user
        $user = User::create([
            'NationalId' => '132456789 ',
            'Name' => 'fake',
            'email' => 'fake@fake.com',
            'password' => '111',
            'Phone_number' => '12345678910',
            'City' => 'fakeCity',
            'State' => 'fakeState',
            'Street' => 'fakeStreet',
            'BirthDate' => '2023-12-11',
            'UserType' => '1', // Set the default value for UserType
            'Latitude' => '10.2',
            'Longitude' => '10.2',
        ]);

        $tamweenCard = Card::create([
            'CardName' => 'fakeCard',
            'CardNumber' => '111',
            'CardNationalId' => '12347885566321',
            'CardPassword' => '111',
            // Add other fields as needed
            'Individuals Number' => '1',
            'BreadPoints' => '1',
            'TamweenPoints' => '1',
        ]);

        $customer = new Customer([
            'National_Id' => '132456789',
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


        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token,'id'=>$user->Id], 201);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
