<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Seed the products table.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        // Insert data into the products table
        DB::table('products')->insert([
            [
                'id' => 1,
                'product_name' => 'سكر',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/FZ4ktQs.jpeg',
                'image_extension' => 'jpg',
                'description' => 'سكر معبأ 1 كجم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 5,
                'favorite_count' => 3,
                'order_count' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'product_name' => 'عدس',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/BYvXhtj.jpeg',
                'image_extension' => 'jpg',
                'description' => 'عدس مجروش 500 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 14,
                'favorite_count' => 1,
                'order_count' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products here
            [
                'id' => 3,
                'product_name' => 'زيت عباد',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/0aOcvk6.jpeg',
                'image_extension' => 'jpg',
                'description' => 'زيت 1 لتر',
                'stock_quantity' => 100,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 2,
                'favorite_count' => 2,
                'order_count' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'product_name' => 'زيت خليط',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/ayOwsbo.jpeg',
                'image_extension' => 'jpg',
                'description' => 'زيت خليط 1 لتر',
                'stock_quantity' => 30,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 2,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'product_name' => 'شاي',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/ZN5OUHQ.jpeg',
                'image_extension' => 'jpg',
                'description' => 'شاي ناعم 40 جم',
                'stock_quantity' => 100,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 9,
                'favorite_count' => 0,
                'order_count' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'product_name' => 'جبنه تتراباك',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/s4Z3Zu2.jpeg',
                'image_extension' => 'jpg',
                'description' => 'جبنة تتراباك 125 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 6,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'product_name' => 'صابون غسيل',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/nvMXZbA.png',
                'image_extension' => 'jpg',
                'description' => 'صابون غسيل 125 جم',
                'stock_quantity' => 100,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 8,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products here
            [
                'id' => 8,
                'product_name' => 'صابون حمام',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/S09QqjP.jpeg',
                'image_extension' => 'jpg',
                'description' => 'صابون تواليت 125جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 8,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 9,
                'product_name' => 'مكرونة',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/eFVqW3O.jpeg',
                'image_extension' => 'jpg',
                'description' => 'مكرونة  800 جم',
                'stock_quantity' => 100,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 3,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 10,
                'product_name' => 'ارز',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/UeGWknT.jpg',
                'image_extension' => 'jpg',
                'description' => ' أرز معبأ 1 كجم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 1,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 11,
                'product_name' => 'فول',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/5KfdFjq.jpeg',
                'image_extension' => 'jpg',
                'description' => 'فول معبأ 500 جم',
                'stock_quantity' => 100,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 14,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 12,
                'product_name' => 'مكرونة ',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/d2ByB7Z.jpeg',
                'image_extension' => 'jpg',
                'description' => 'مكرونة 400 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 3,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products here
            [
                'id' => 13,
                'product_name' => 'دقيق ',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/wdKBjpB.jpeg',
                'image_extension' => 'jpg',
                'description' => 'دقيق معبأ ورقي أو بلاستيك 1 كجم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 13,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 14,
                'product_name' => 'مسلي',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/wwUl7uZ.jpeg',
                'image_extension' => 'jpg',
                'description' => 'مسلى صناعي 800 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 5,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 15,
                'product_name' => 'صلصه',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/6ugrRGl.jpeg',
                'image_extension' => 'jpg',
                'description' => ' صلصة 300 جم',
                'stock_quantity' => 5,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 11,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 16,
                'product_name' => 'تونه',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/dCTeEZS.jpeg',
                'image_extension' => 'jpg',
                'description' => 'تونة مفتتة وزن 140 جراما',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 9,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 17,
                'product_name' => 'مربى',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/77Cyj2G.jpeg',
                'image_extension' => 'jpg',
                'description' => 'مربى أنواع 350 جراما',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 17,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 18,
                'product_name' => 'جبنه تتراباك',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/VRU6QE0.jpeg',
                'image_extension' => 'jpg',
                'description' => 'جبنة تتراباك 250 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 6,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 19,
                'product_name' => 'مسحوق اتوماتيك',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/RBjX4uN.jpeg',
                'image_extension' => 'jpg',
                'description' => 'مسحوق أتوماتيك 800 كجم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 8,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 20,
                'product_name' => 'مسحوق عادي',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/JO0tq0K.jpeg',
                'image_extension' => 'jpg',
                'description' => 'مسحوق عادي يدوي 800 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 8,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 21,
                'product_name' => 'لبن جاف',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/KsEsK47.jpeg',
                'image_extension' => 'jpg',
                'description' => 'لبن جاف 125 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 6,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 22,
                'product_name' => 'خل',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/sKHPSP9.jpeg',
                'image_extension' => 'jpg',
                'description' => 'خل 5% 900 ملي',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 10,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 23,
                'product_name' => 'ملح',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/sRtvfSe.jpeg',
                'image_extension' => 'jpg',
                'description' => 'کیس ملح طعام 300 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 10,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 24,
                'product_name' => 'حلاوه طحينيه',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/X9g4nKs.jpeg',
                'image_extension' => 'jpg',
                'description' => 'بار حلاوة طحينية سادة 40 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 5,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 25,
                'product_name' => 'بسكويت يويوز',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/reqg5Hc.png',
                'image_extension' => 'jpg',
                'description' => 'بسكويت يويوز سادة',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 15,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
            [
                'id' => 26,
                'product_name' => 'بسكويت يويوز ويفر',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/Qe6URWB.jpeg',
                'image_extension' => 'jpg',
                'description' => 'بسكويت يويوز ويفر أنواع',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 15,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 27,
                'product_name' => 'بسكويت تومورو',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/hlGBkoY.jpeg',
                'image_extension' => 'jpg',
                'description' => 'بسكويت تومورو أنواع',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 15,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 28,
                'product_name' => 'بسكويت بوو',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/Jh0ggRG.png',
                'image_extension' => 'jpg',
                'description' => 'بسكويت بوو أنواع',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 15,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 29,
                'product_name' => 'طحينه',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/Q0q2R35.jpeg',
                'image_extension' => 'jpg',
                'description' => 'طحينة بيضاء ظرف 140 جراما',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 12,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 30,
                'product_name' => 'قهوه',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/WlEh3EW.jpeg',
                'image_extension' => 'jpg',
                'description' => 'قهوة سريعة الذوبان 18 جم',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 9,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 31,
                'product_name' => 'مرقة الدجاج',
                'product_type' => 0,
                'product_image' => 'https://i.imgur.com/8wnvKU9.jpeg',
                'image_extension' => 'jpg',
                'description' => 'علبة مرقة دجاج عدد 8 مكعبات',
                'stock_quantity' => 50,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 10,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 32,
                'product_name' => 'ابو علاء قطع',
                'product_type' => 1,
                'product_image' => 'https://i.imgur.com/5Rip25c.jpeg',
                'image_extension' => 'jpg',
                'description' => 'قطع مفتتع',
                'stock_quantity' => 2,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 17,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 33,
                'product_name' => 'شوكلاته مندولين',
                'product_type' => 1,
                'product_image' => 'https://i.imgur.com/62rbYY3.jpeg',
                'image_extension' => 'jpg',
                'description' => 'شيكولاتة ماندولين - 50جم - عبوة من 12',
                'stock_quantity' => 2,
                'points_price' => '0.00',
                'store_id' => 1,
                'cat_id' => 16,
                'favorite_count' => 0,
                'order_count' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Add more products as needed
        ]);
    }
}