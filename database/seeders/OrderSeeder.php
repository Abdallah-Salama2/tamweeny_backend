<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Orders_made;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Order::Create([
            'order_date'=>'2000-11-21',
            'order_price'=>120,
            'customer_id'=>1,
//            'delivery'
        ]);
        //
        DB::table('orders_made')->insert([
            [
                'order_id'=>1,
                'product_id'=>1,
                'product_name'=>'سكر',
                'quantity'=>'2',
                'total_price'=>26,
                'customer_id'=>1,


            ],['order_id'=>1,
                'product_id'=>3,
                'product_name'=>'زيت عباد',
                'quantity'=>'2',
                'total_price'=>40,
                'customer_id'=>1,

            ]]);

    }
}
