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
        $uniqueDir = '/public/uploads/CardFiles/' . $this->fileStorageService->getNextFolderCounter();
        Storage::makeDirectory($uniqueDir);

        // Store files
        $nationalIdCardPath = $this->fileStorageService->storeFile($request->file('nationalIdCardAndBirthCertificate'), $uniqueDir);
        $followersNationalIdCardsPaths = $this->fileStorageService->storeMultipleFiles($request->file('followersNationalIdCardsAndBirthCertificates'), $uniqueDir);

        // Retrieve the admin user
        $user = User::where('user_type', 'Admin')->firstOrFail();

        // Create AdminCard record
         AdminCard::create([
            'name' => $request->input('name'),
            'admin_id' => $user->id,
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'phone_number' => $request->input('phoneNumber'),
            'social_status' => $request->input('socialStatus'),
            'salary' => $request->input('salary'),
            'individuals_number' => 1,
            'national_id_card_and_birth_certificate' => asset($nationalIdCardPath),
            'followers_national_id_cards_and_birth_certificates' => json_encode(array_map('asset', $followersNationalIdCardsPaths)),
        ]);

    }
}



