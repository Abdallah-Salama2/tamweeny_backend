<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\GovernorAdmin;
use App\Models\Store;
use App\Models\storeOwner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $admin=User::Create([

            'national_id' => '111',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => '0222010',
            'city_state' => '3amk State',
            'street' => '3amk Street',
            'birth_date' => '2000-11-21',
            'user_type'=>'Admin',
            'latitude'=>11.20000000,
            'longitude'=>11.20000000,
        ]);


        $admin->assignRole('admin');



        $user=User::Create([

            'national_id' => '29006141400948',
            'name' => 'Abdallah Fawzi',
            'email' => 'alas@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => '01020304050',
            'city_state' => 'Nasr City, Cairo Governorate',
            'street' => '29VG+H6M, Al Hay Al Asher',
            'birth_date' => '2000-11-21',
            'user_type'=>'Customer',
            'latitude'=>30.043172504337285,
            'longitude'=>31.37297504641439,
        ]);
        Card::create([
            'user_id'=>$user->id,
            'card_name'=>'Abdallah Fawzi',
            'card_number'=>1234567891011,
            'card_national_id'=>29006141400948,
            'card_password'=>static::$password ??= Hash::make('password'),
            'individuals_number'=>4,
            'tamween_balance'=>400
        ]);

        $user->assignRole('customer');
        $currentTimestamp = Carbon::now();

        $supplier = User::create([
            'email' => 'Supplier@gmail.com',
            'name'=>'Tux',
            'password' => static::$password ?? Hash::make('password'),
            'user_type' => 'Supplier',
            'store_owner_info' => json_encode([
                'tax_card_number'=>112233344,
                'tax_registration_number'=>333666999
            ]),
        ]);
        Store::create( [
            'id' => 2,
            'owner_id' => $supplier->id,
            'store_name' => 'تموين الحي العاشر',
            'address' => '29VG+H6P, Al Hay Al Asher, Nasr City, Cairo Governorate 4442255',
            'phone_number' => '0',
            'type' => 'بقاله',
            'valid' => 1,
            'latitude' => '30.04518064',
            'longitude' => '31.37614544',
            'created_at' => $currentTimestamp,
            'updated_at' => $currentTimestamp,
        ]);
        $supplier->assignRole('supplier');



    }
}
