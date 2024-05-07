<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Customer;
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
    }
}
