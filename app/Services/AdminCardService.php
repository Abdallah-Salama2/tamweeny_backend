<?php

namespace App\Services;

use App\Models\AdminCard;
use App\Models\User;
use App\Services\FileStorage\FileStorageService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class AdminCardService
{
    protected $fileStorageService;

    public function __construct(FileStorageService $fileStorageService)
    {
        $this->fileStorageService = $fileStorageService;
    }

    public function createNewCard($request)
    {
        // Generate unique directory path
        $username = $request->input('name'); // Assuming 'username' is the input field name
        $uniqueDir = '/public/uploads/CardFiles/' . $username;
        Storage::makeDirectory($uniqueDir);

        // Store files
        $nationalIdCardPath = $this->fileStorageService->storeMultipleFiles($request->file('nationalIdCardAndBirthCertificate'), $uniqueDir.'/nationalIdCardAndBirthCertificate');
        $followersNationalIdCardsPaths = $this->fileStorageService->storeMultipleFiles($request->file('followersNationalIdCardsAndBirthCertificates'), $uniqueDir.'/followersNationalIdCardsAndBirthCertificates');

        // Retrieve the admin user
        $user = User::where('user_type', 'Admin')->firstOrFail();

        // Create AdminCard record
         AdminCard::create([
            'name' => $request->input('name'),
            'admin_id' => $user->id,
            'national_id'=>$request->input('nationalId'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'phone_number' => $request->input('phoneNumber'),
            'social_status' => $request->input('socialStatus'),
            'salary' => $request->input('salary'),
            'individuals_number' => 4,
            'national_id_card_and_birth_certificate' =>  json_encode(array_map('asset', $nationalIdCardPath)),
            'followers_national_id_cards_and_birth_certificates' => json_encode(array_map('asset', $followersNationalIdCardsPaths)),
        ]);

    }
}



