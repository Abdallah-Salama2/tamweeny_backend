<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\GovernorAdmin;
use App\Models\Store;
use App\Models\storeOwner;
use App\Models\User;
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

            'national_id' => '222',
            'name' => 'Alas',
            'email' => 'alas@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => '0222010',
            'city_state' => '3amk State',
            'street' => '3amk Street',
            'birth_date' => '2000-11-21',
            'user_type'=>'Customer',
            'latitude'=>11.20000000,
            'longitude'=>11.20000000,
        ]);
        Card::create([
            'user_id'=>$user->id,
            'card_name'=>'Alas',
            'card_number'=>1,
            'card_national_id'=>1,
            'card_password'=>static::$password ??= Hash::make('password'),
        ]);

        $user->assignRole('customer');

        $supplier = User::create([
            'email' => 'Supplier@gmail.com',
            'name'=>'Tux',
            'password' => static::$password ?? Hash::make('password'),
            'user_type' => 'Supplier',
            'store_owner_info' => json_encode([
                'tax_card_number'=>11,
                'tax_registration_number'=>11
            ]),
        ]);
        Store::create([
           'owner_id'=>$supplier->id,
           'store_name'=>'TuxStore' ,
            'address'=>'TuxAddr',
            'phone_number'=>111,
            'type'=>'بقالة',
            'valid'=>1,
            'latitude'=>'30.05283352',
            'longitude'=>'30.05283352',
        ]);
        $supplier->assignRole('supplier');


    }
}
