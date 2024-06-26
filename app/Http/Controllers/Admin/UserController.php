<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    //

    public function customerIndex()
    {
        //
//        $customerId = auth()->user()->id;

        $users = User::with('card','order')->where('user_type', 'Customer')->get();


        return Inertia::render('Admin/Users/CustomerIndex', ['users' => $users]);
    }

    public function deliveryIndex()
    {
        //
//        $customerId = auth()->user()->id;
        $users = User::with('card')->where('user_type', 'Delivery')->get();



        return Inertia::render('Admin/Users/DeliveryIndex', ['users' => $users]);
    }

    public function supplierIndex()
    {
        //
//        $customerId = auth()->user()->id;
        $deliveries = User::with('card')->where('user_type', 'Delivery')->get();
        $suppliers = User::with('card')->where('user_type', 'Supplier')->get();


        return Inertia::render('Admin/Users/EmployeesIndex', ['suppliers' => $suppliers,'deliveries' => $deliveries]);
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(Request $request, $userType)
    {
//        dd($request,$userType);

//        $request->validate([
//            'nationalId' => 'required|string|max:255|unique:users,national_id',
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users,email',
//            'password' => ['required', 'min:8'],
//            'phoneNumber' => 'required|string|max:255',
//            'address' => 'required|string|max:255',
//            'birthDate' => 'required|date',
//            'cardNumber' => 'required|string|max:255|unique:cards,card_number',
//            'taxNumber' => 'required|string|max:255',
//        ]);


        if ($userType === "Supplier") {
            $onwerIfo = ['tax_card_number' => $request->cardNumber, 'tax_registration_number' => $request->taxNumber];
            $ownerInfoJson = json_encode($onwerIfo);

            $user = User::create([
                'name' => $request->name,
                'national_id' => $request->nationalId,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phoneNumber,
                'city_state' => $request->address,
                'birth_date' => $request->birthDate,
                'user_type' => $userType,
                'store_owner_info' => $ownerInfoJson,
            ]);
            Store::create([
                'owner_id' => $user->id,
                'store_name' => $request->storeName,
                'address' => $request->storeAddress
            ]);
            $user->assignRole('supplier');

        } else if ($userType === "Delivery") {
            $deliveryInfo = ['car_type' => 'Motorcycle', 'license_plate' => "gg123"];
            $deliveryInfoJson = json_encode($deliveryInfo);
            $user=User::create([
                'name' => $request->name,
                'national_id' => $request->nationalId,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phoneNumber,
                'city_state' => $request->address,
                'birth_date' => $request->birthDate,
                'user_type' => $userType,
                'delivery_info' => $deliveryInfoJson,
            ]);
            $user->assignRole('delivery');

        }
        return redirect()->route('admin.product.index');
    }
}
