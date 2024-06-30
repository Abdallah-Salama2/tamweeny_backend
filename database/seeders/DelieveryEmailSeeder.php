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

class DelieveryEmailSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
//        'delivery_info'=>json_encode([
//        'vehicle_type' => 'vehicle car',
//        'license' => 'll',
//    ]),
        $delivery1 = User::create([
            'email' => 'Delivery1@gmail.com',
            'name'=>'Delivery',
            'password' => static::$password ?? Hash::make('password'),
            'user_type' => 'Delivery',
            'delivery_info' => json_encode([
                'order_count'=>0
            ]),
        ]);
        $delivery1->assignRole('delivery');
        $delivery2 = User::create([
            'email' => 'Delivery2@gmail.com',
            'name'=>'7amo',
            'password' => static::$password ?? Hash::make('password'),
            'user_type' => 'Delivery',
            'delivery_info' => json_encode([
                'order_count'=>0
            ]),
        ]);
        $delivery2->assignRole('delivery');
//        $delivery3 = User::create([
//            'email' => 'Delivery3@gmail.com',
//            'password' => static::$password ?? Hash::make('password'),
//            'user_type' => 'Delivery',
//        ]);
//        $delivery3->assignRole('delivery');
//        $delivery4 = User::create([
//            'email' => 'Delivery4@gmail.com',
//            'password' => static::$password ?? Hash::make('password'),
//            'user_type' => 'Delivery',
//        ]);
//        $delivery4->assignRole('delivery');
//        $delivery5 = User::create([
//            'email' => 'Delivery5@gmail.com',
//            'password' => static::$password ?? Hash::make('password'),
//            'user_type' => 'Delivery',
//        ]);
//        $delivery5->assignRole('delivery');
//        $delivery6 = User::create([
//            'email' => 'Delivery6@gmail.com',
//            'password' => static::$password ?? Hash::make('password'),
//            'user_type' => 'Delivery',
//        ]);
//        $delivery6->assignRole('delivery');

    }
}
