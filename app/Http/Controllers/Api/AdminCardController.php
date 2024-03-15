<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdminCard;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showAdminCards()
    {
        $adminCards = AdminCard::all();

        return view('adminCard', compact('adminCards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all(); // Fetch all products, adjust the query as needed

        //
        return view('test2',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        // Validate the request data
//        $request->validate([
//            // Add your validation rules here...
//        ]);
//
//        // Store the admin card details
//        $nationalIdCardPath = $request->file('nationalIdCardAndBirthCertificate')->store('public/uploads');
//        $followersNationalIdCardsPaths = [];
//        if ($request->hasFile('followersNationalIdCardsAndBirthCertificates')) {
//            foreach ($request->file('followersNationalIdCardsAndBirthCertificates') as $file) {
//                // Store each uploaded file and save its path
//                $path = $file->store('public/uploads');
//                $followersNationalIdCardsPaths[] = $path;
//            }
//        }
//
//        // Serialize the array of file paths into a JSON string
//        $followersNationalIdCardsPathsJson = json_encode($followersNationalIdCardsPaths);
//
//        // Create a new AdminCard instance and store the file paths in the database
//        $adminCard = AdminCard::create([
//            'name' => $request->input('name'),
//            'admin_id' => 1,
//            'email' => $request->input('email'),
//            'gender' => $request->input('gender'),
//            'phone_number' => $request->input('phoneNumber'),
//            'social_status' => $request->input('socialStatus'),
//            'salary' => $request->input('salary'),
//            'national_id_card_and_birth_certificate' => $nationalIdCardPath,
//            'followers_national_id_cards_and_birth_certificates' => $followersNationalIdCardsPathsJson,
//        ]);
//        return response()->json(["message"=>"Card created and waiting for approval"],200);
//
//        // Redirect or respond with success message
//    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
