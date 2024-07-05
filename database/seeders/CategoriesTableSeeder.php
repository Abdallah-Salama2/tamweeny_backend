<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $currentTimestamp = Carbon::now();

        DB::table('categories')->insert([
            [
                'id' => 1,
                'category_name' => 'ارز',
                'category_image' => 'http://192.168.1.7:8000/public/categories/ارز.jpeg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/ارز.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 2,
                'category_name' => 'الزيت والسمن',
                'category_image' => 'http://192.168.1.7:8000/public/categories/زيت.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/oil.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 3,
                'category_name' => 'نشويات',
                'category_image' => 'http://192.168.1.7:8000/public/categories/مكرونه.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/makrona.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 5,
                'category_name' => 'السكر والمحليات',
                'category_image' => 'http://192.168.1.7:8000/public/categories/سكر.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/sugar.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 6,
                'category_name' => 'منتجات البان',
                'category_image' => 'http://192.168.1.7:8000/public/categories/منتجات البان.jpeg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/milk@3x 1.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 7,
                'category_name' => 'لحوم',
                'category_image' => 'http://192.168.1.7:8000/public/categories/لحوم.jpeg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/meat.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 8,
                'category_name' => 'مساحيق تنظيف',
                'category_image' => 'http://192.168.1.7:8000/public/categories/طريقة-عمل-مسحوق-الغسيل-في-المنزل.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/tanzef.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 9,
                'category_name' => 'اخرى',
                'category_image' => 'http://192.168.1.7:8000/public/categories/etc.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/other.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 10,
                'category_name' => 'الأعشاب، التوابل والخلطات',
                'category_image' => 'http://192.168.1.7:8000/public/categories/اعشاب.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/سشمشي.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 11,
                'category_name' => 'الصلصات',
                'category_image' => 'http://192.168.1.7:8000/public/categories/صلصات.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/salsa.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 12,
                'category_name' => 'زينة السلطة ومستلزماتها',
                'category_image' => 'http://192.168.1.7:8000/public/categories/سلطه.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/salad.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 13,
                'category_name' => 'الدقيق والخبز',
                'category_image' => 'http://192.168.1.7:8000/public/categories/دقيق.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/flour.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 14,
                'category_name' => 'البقوليات والحبوب',
                'category_image' => 'http://192.168.1.7:8000/public/categories/بقوليات.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/bqolyat.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 15,
                'category_name' => 'بسكويت',
                'category_image' => 'http://192.168.1.7:8000/public/categories/بسكويت.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/bsicuit.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 16,
                'category_name' => 'شوكولاته',
                'category_image' => 'http://192.168.1.7:8000/public/categories/شوكولاته.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/chocolate.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 17,
                'category_name' => 'مربى وعسل',
                'category_image' => 'http://192.168.1.7:8000/public/categories/مربى وعسل.jpg',
                'category_icon' => 'http://192.168.1.7:8000/public/categories icons/morba.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
        ]);
    }
}
