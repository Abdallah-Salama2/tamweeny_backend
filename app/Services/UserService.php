<?php

namespace App\Services;

use App\DTO\Users\UserRegisterDTO;
use App\Models\User;
use App\Models\Card;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $userData, array $cardData): User
    {
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        Card::create($cardData);

        $user->assignRole('customer');
        return $user;
    }

    public function updateLastLogin(User $user)
    {
        $user->last_login_at = now();
        $user->save();
    }
}
