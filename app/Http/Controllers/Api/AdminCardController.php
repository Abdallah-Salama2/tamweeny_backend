<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCardRequest;
use App\Models\AdminCard;
use App\Models\User;
use App\Services\FileStorage\FolderCounterService;
use App\Services\FileStorage\Interfaces\FileStorageInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminCardController extends Controller
{
    private $fileStorageService;

    public function __construct(FileStorageInterface $fileStorageService)
    {
        $this->fileStorageService = $fileStorageService;
    }

    public function store(AdminCardRequest $request)
    {
        $request->validated();

        try {
            // Generate unique directory path
            $uniqueDir = '/public/uploads/CardFiles/' . $this->fileStorageService->getNextFolderCounter();
            Storage::makeDirectory($uniqueDir);

            // Store files
            $nationalIdCardPath = $this->fileStorageService->storeFile($request->file('nationalIdCardAndBirthCertificate'), $uniqueDir);
            $followersNationalIdCardsPaths = $this->fileStorageService->storeMultipleFiles($request->file('followersNationalIdCardsAndBirthCertificates'), $uniqueDir);

            // Retrieve the admin user
            $user = User::where('user_type', 'Admin')->firstOrFail();
//            dd($user);
            // Create AdminCard record
            $adminCard = AdminCard::create([
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

            return response()->json(["message" => "Card created and waiting for approval"], 200);
        } catch (\Exception $e) {
            Log::error("Error storing admin card: " . $e->getMessage());
            return response()->json(["message" => "An error occurred while creating the card"], 500);
        }
    }

    // Other methods (show, edit, update, destroy) can be implemented similarly
}
