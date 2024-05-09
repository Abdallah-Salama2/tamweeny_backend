<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminRole=Role::create(['name' => 'admin']);
        $deliveryRole=Role::create(['name' => 'delivery']);
        $storeOwnerRole=Role::create(['name' => 'storeOwner']);
        $customerRole=Role::create(['name' => 'customer']);

    }
}
