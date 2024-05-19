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
        DB::table('orders')->insert([
            [
                'order_date' => '2000-11-21',
                'order_price' => 66,
                'customer_id' => 1,
                'delivery_status' => 'Delivered'
//            'delivery'
            ],
            [
                'order_date' => '2000-11-21',
                'order_price' => 66,
                'customer_id' => 1,
                'delivery_status' => 'Pending'


//            'delivery'
            ], [
                'order_date' => '2000-11-21',
                'order_price' => 66,
                'customer_id' => 1,
                'delivery_status' => 'Delivered'

//            'delivery'
            ],
            [
                'order_date' => '2000-11-21',
                'order_price' => 66,
                'customer_id' => 1,
                'delivery_status' => 'Pending'

//            'delivery'
            ],
            [
                'order_date' => '2000-11-21',
                'order_price' => 66,
                'customer_id' => 2,
                'delivery_status' => 'Delivered'

//            'delivery'
            ],
            [
                'order_date' => '2000-11-21',
                'order_price' => 66,
                'customer_id' => 2,
                'delivery_status' => 'Pending'

//            'delivery'
            ], [
                'order_date' => '2000-11-21',
                'order_price' => 66,
                'customer_id' => 2,
                'delivery_status' => 'Delivered'

//            'delivery'
            ],
            [
                'order_date' => '2000-11-21',
                'order_price' => 66,
                'customer_id' => 2,
                'delivery_status' => 'Pending'

//            'delivery'
            ],

        ]);

        //
        DB::table('orders_made')->insert([
            [
                'order_id' => 1,
                'product_id' => 6,
                'product_name' => 'جبنه تتراباك',
                'quantity' => '2',
                'total_price' => 26,
                'customer_id' => 1,


            ], ['order_id' => 2,
                'product_id' => 18,
                'product_name' => 'جبنه تتراباك',
                'quantity' => '2',
                'total_price' => 40,
                'customer_id' => 1,

            ],
            [
                'order_id' => 2,
                'product_id' => 21,
                'product_name' => 'لبن جاف',
                'quantity' => '2',
                'total_price' => 26,
                'customer_id' => 1,


            ], ['order_id' => 1,
                'product_id' => 1,
                'product_name' => 'سكر',
                'quantity' => '2',
                'total_price' => 40,
                'customer_id' => 1,

            ], [
                'order_id' => 4,
                'product_id' => 14,
                'product_name' => 'مسلي',
                'quantity' => '2',
                'total_price' => 26,
                'customer_id' => 1,


            ], ['order_id' => 3,
                'product_id' => 24,
                'product_name' => 'حلاوه طحينيه',
                'quantity' => '2',
                'total_price' => 40,
                'customer_id' => 1,

            ], [
                'order_id' => 3,
                'product_id' => 18,
                'product_name' => 'جبنه تتراباك',
                'quantity' => '2',
                'total_price' => 26,
                'customer_id' => 1,


            ], ['order_id' => 4,
                'product_id' => 12,
                'product_name' => 'مكرونة',
                'quantity' => '2',
                'total_price' => 40,
                'customer_id' => 1,

            ], [
                'order_id' => 5,
                'product_id' => 14,
                'product_name' => 'مسلي',
                'quantity' => '2',
                'total_price' => 26,
                'customer_id' => 2,


            ], ['order_id' => 5,
                'product_id' => 15,
                'product_name' => 'صلصه',
                'quantity' => '2',
                'total_price' => 40,
                'customer_id' => 2,

            ], [
                'order_id' => 6,
                'product_id' => 16,
                'product_name' => 'تونه',
                'quantity' => '2',
                'total_price' => 26,
                'customer_id' => 2,


            ], ['order_id' => 6,
                'product_id' => 19,
                'product_name' => 'مسحوق اتوماتيك',
                'quantity' => '2',
                'total_price' => 40,
                'customer_id' => 2,

            ], [
                'order_id' => 7,
                'product_id' => 21,
                'product_name' => 'لبن جاف',
                'quantity' => '2',
                'total_price' => 26,
                'customer_id' => 2,


            ],
            ['order_id' => 7,
                'product_id' => 22,
                'product_name' => 'خل',
                'quantity' => '2',
                'total_price' => 40,
                'customer_id' => 2,

            ],
            [
                'order_id' => 8,
                'product_id' => 23,
                'product_name' => 'ملح',
                'quantity' => '2',
                'total_price' => 26,
                'customer_id' => 2,


            ], ['order_id' => 8,
                'product_id' => 24,
                'product_name' => 'حلاوه طحينيه',
                'quantity' => '2',
                'total_price' => 40,
                'customer_id' => 2,

            ],


        ]);

    }
}
