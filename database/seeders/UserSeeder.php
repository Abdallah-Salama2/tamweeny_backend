<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\GovernorAdmin;
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

        $user=User::Create([

            'national_id' => '9999999999',
            'name' => 'test',
            'email' => 'test@gamil.com',
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => '000000000000',
            'city_state' => '3amk State',
            'street' => '3amk Street',
            'birth_date' => '2000-11-21',
            'user_type'=>1,
            'latitude'=>10.20000000,
            'longitude'=>10.20000000,
        ]);
        $tamweenCard=Card::Create([
            'card_name' => 'test',
            'card_number' => '0000',
            'card_national_id' => '1231',
            'card_password' => static::$password ??= Hash::make('password'),
        ]);
        Customer::create(['card_id' => $tamweenCard->id, 'user_id' => $user->id]);
        $user->assignRole('customer');

        $user=User::Create([

            'national_id' => '9988888',
            'name' => 'Rady',
            'email' => 'Rady@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => '0222010',
            'city_state' => '3amk State',
            'street' => '3amk Street',
            'birth_date' => '2000-11-21',
            'user_type'=>1,
            'latitude'=>11.20000000,
            'longitude'=>11.20000000,
        ]);
        $tamweenCard=Card::Create([
            'card_name' => 'test',
            'card_number' => '1111',
            'card_national_id' => '1241',
            'card_password' => static::$password ??= Hash::make('password'),
        ]);
        Customer::create(['card_id' => $tamweenCard->id, 'user_id' => $user->id]);
        $user->assignRole('customer');


        $driver=User::Create([

            'national_id' => '1321321',
            'name' => 'Driver',
            'email' => 'driver@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => '0222010',
            'city_state' => '3amk State',
            'street' => '3amk Street',
            'birth_date' => '2000-11-21',
            'user_type'=>2,
            'latitude'=>11.20000000,
            'longitude'=>11.20000000,
        ]);
        Delivery::create([
            'user_id'=>$driver->id,
            'vehicle_type'=>'vehicle',
            'license_plate'=>'license',

        ]);

        $driver->assignRole('delivery');


        $storeOnwer=User::Create([

            'national_id' => '222232',
            'name' => 'Owner',
            'email' => 'Owner@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => '0222010',
            'city_state' => '3amk State',
            'street' => '3amk Street',
            'birth_date' => '2000-11-21',
            'user_type'=>3,
            'latitude'=>11.20000000,
            'longitude'=>11.20000000,
        ]);
        storeOwner::create([
            'tax_registration_number'=>'11111',
            'user_id'=>$storeOnwer->id,
            'tax_card'=>'taxCard'
        ]);
        $storeOnwer->assignRole('storeOwner');

        $admin=User::Create([

            'national_id' => '33333322',
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => '0222010',
            'city_state' => '3amk State',
            'street' => '3amk Street',
            'birth_date' => '2000-11-21',
            'user_type'=>4,
            'latitude'=>11.20000000,
            'longitude'=>11.20000000,
        ]);

        GovernorAdmin::create([
            'user_id'=>$admin->id,
        ]);
        $admin->assignRole('admin');


    }
}
