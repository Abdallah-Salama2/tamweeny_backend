<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // app/Http/Controllers/CustomerController.php



    public function register(Request $request)
    {
        $request->validate([
            'national_id' => 'required|string|max:255|unique:users,NationalId',
            'tameen_card_name' => 'required|string|max:255',
            'tamween_card_number' => 'required|string|max:255',
            'card_national_id' => 'required|string|max:255',
            'tamween_card_password' => 'required|string|max:255',
        ]);

        $user = User::where('NationalId', $request->national_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $customer = $user->customer()->create([
            'tameen_card_name' => $request->tameen_card_name,
            'tamween_card_number' => $request->tamween_card_number,
            'card_national_id' => $request->card_national_id,
            'tamween_card_password' => Hash::make($request->tamween_card_password),
        ]);

        return response()->json(['message' => 'Customer registered successfully', 'customer' => $customer]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
