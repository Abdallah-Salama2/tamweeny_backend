<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCardRequest;
use App\Models\AdminCard;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCardController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCardRequest $request)
    {
        // Validate the request data
        $request->validated();

        // Store the admin card details
        $nationalIdCardPath = $this->storeFile($request->file('nationalIdCardAndBirthCertificate'));
        $followersNationalIdCardsPaths = $this->storeMultipleFiles($request->file('followersNationalIdCardsAndBirthCertificates'));

        // Create a new AdminCard instance and store the file paths in the database
        $adminCard = AdminCard::create([
            'name' => $request->input('name'),
            'admin_id' => 1, // Assuming a default admin ID here
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'phone_number' => $request->input('phoneNumber'),
            'social_status' => $request->input('socialStatus'),
            'salary' => $request->input('salary'),
            'individuals_number' => 1,
            'national_id_card_and_birth_certificate' => $nationalIdCardPath,
            'followers_national_id_cards_and_birth_certificates' => json_encode($followersNationalIdCardsPaths),
        ]);

        return response()->json(["message" => "Card created and waiting for approval"], 200);
    }

    /**
     * Validate the request data.
     */
    private function validateRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_cards,email',
            'gender' => ['required', Rule::in(['male', 'female'])],
            'phoneNumber' => 'required|string|max:20',
            'socialStatus' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'nationalIdCardAndBirthCertificate' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'followersNationalIdCardsAndBirthCertificates.*' => 'file|mimes:jpeg,png,pdf|max:2048',
        ]);
    }

    /**
     * Store a single file and return its path.
     */
    private function storeFile($file)
    {
        // Store the file with its original name
        return $file->storeAs('public/uploads', $file->getClientOriginalName());
    }

    /**
     * Store multiple files and return an array of paths.
     */
    private function storeMultipleFiles($files)
    {
        $paths = [];

        if ($files) {
            foreach ($files as $file) {
                $paths[] = $this->storeFile($file);
            }
        }

        return $paths;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Your implementation
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Your implementation
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Your implementation
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Your implementation
    }
}
