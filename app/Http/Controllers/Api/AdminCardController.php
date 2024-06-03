<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCardRequest;
use App\Models\AdminCard;
use App\Models\User;
use App\Services\AdminCardService;
use App\Services\FileStorage\Interfaces\FileStorageInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminCardController extends Controller
{

    protected $adminCardService;

    public function __construct(AdminCardService $adminCardService)
    {
        $this->adminCardService = $adminCardService;
    }

    public function store(AdminCardRequest $request)
    {
        $request->validated();

        try {
            $this->adminCardService->createNewCard($request);

            return response()->json(["message" => "Card created and waiting for approval"], 200);
        } catch (\Exception $e) {
            Log::error("Error storing admin card: " . $e->getMessage());
            return response()->json(["message" => "An error occurred while creating the card"], 500);
        }
    }

    // Other methods (show, edit, update, destroy) can be implemented similarly
}
