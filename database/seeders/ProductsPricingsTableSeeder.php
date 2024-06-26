<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsPricingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_pricings')->insert([
            [
                'id' => 1,
                'product_id' => 1,
                'base_price' => '13.00',
                'selling_price' => '12.25',
                'discount' => 5,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'base_price' => '21.00',
                'selling_price' => '15.75',
                'discount' => 25,
                'discount_unit' => '%',
                'date_created' => '2024-03-12',
                'expired_date' => '2024-03-20',
            ],
            [
                'id' => 3,
                'product_id' => 3,
                'base_price' => '20.00',
                'selling_price' => '20.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],

            [
                'id' => 4,
                'product_id' => 4,
                'base_price' => '30.00',
                'selling_price' => '30.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 5,
                'product_id' => 5,
                'base_price' => '5.00',
                'selling_price' => '5.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 6,
                'product_id' => 6,
                'base_price' => '7.00',
                'selling_price' => '7.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 7,
                'product_id' => 7,
                'base_price' => '3.00',
                'selling_price' => '3.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 8,
                'product_id' => 8,
                'base_price' => '8.00',
                'selling_price' => '8.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 9,
                'product_id' => 9,
                'base_price' => '13.00',
                'selling_price' => '13.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 10,
                'product_id' => 10,
                'base_price' => '13.00',
                'selling_price' => '13.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 11,
                'product_id' => 11,
                'base_price' => '9.00',
                'selling_price' => '9.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 12,
                'product_id' => 12,
                'base_price' => '7.00',
                'selling_price' => '7.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 13,
                'product_id' => 13,
                'base_price' => '18.00',
                'selling_price' => '18.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 14,
                'product_id' => 14,
                'base_price' => '30.00',
                'selling_price' => '30.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 15,
                'product_id' => 15,
                'base_price' => '8.00',
                'selling_price' => '8.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 16,
                'product_id' => 16,
                'base_price' => '18.00',
                'selling_price' => '18.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 17,
                'product_id' => 17,
                'base_price' => '16.00',
                'selling_price' => '16.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 18,
                'product_id' => 18,
                'base_price' => '14.00',
                'selling_price' => '14.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 19,
                'product_id' => 19,
                'base_price' => '25.00',
                'selling_price' => '25.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 20,
                'product_id' => 20,
                'base_price' => '16.00',
                'selling_price' => '16.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 21,
                'product_id' => 21,
                'base_price' => '26.00',
                'selling_price' => '26.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 22,
                'product_id' => 22,
                'base_price' => '6.00',
                'selling_price' => '6.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 23,
                'product_id' => 23,
                'base_price' => '2.00',
                'selling_price' => '2.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 24,
                'product_id' => 24,
                'base_price' => '3.00',
                'selling_price' => '3.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 25,
                'product_id' => 25,
                'base_price' => '2.00',
                'selling_price' => '2.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 26,
                'product_id' => 26,
                'base_price' => '3.00',
                'selling_price' => '3.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 27,
                'product_id' => 27,
                'base_price' => '3.00',
                'selling_price' => '3.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 28,
                'product_id' => 28,
                'base_price' => '4.00',
                'selling_price' => '4.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 29,
                'product_id' => 29,
                'base_price' => '4.00',
                'selling_price' => '4.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 30,
                'product_id' => 30,
                'base_price' => '3.00',
                'selling_price' => '3.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 31,
                'product_id' => 31,
                'base_price' => '4.00',
                'selling_price' => '4.00',
                'discount' => 0,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
            [
                'id' => 32,
                'product_id' => 32,
                'base_price' => '88.80',
                'selling_price' => '76.56',
                'discount' => 13,
                'discount_unit' => '%',
                'date_created' => null,
                'expired_date' => null,
            ],
        ]);
    }
}
