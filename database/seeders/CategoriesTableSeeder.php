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
                'category_image' => 'https://i.imgur.com/jX9yetm.jpg',
                'category_icon' => 'https://i.imgur.com/aBuhOdZ.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 2,
                'category_name' => 'الزيت والسمن',
                'category_image' => 'https://i.imgur.com/hrj5VGm.jpg',
                'category_icon' => 'https://i.imgur.com/CiKKoRA.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 3,
                'category_name' => 'نشويات',
                'category_image' => 'https://i.imgur.com/NFqTmqI.jpeg',
                'category_icon' => 'https://i.imgur.com/KN8whv7.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 5,
                'category_name' => 'السكر والمحليات',
                'category_image' => 'https://i.imgur.com/rC6deOt.jpg',
                'category_icon' => 'https://i.imgur.com/h9f5LHA.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 6,
                'category_name' => 'منتجات البان',
                'category_image' => 'https://i.imgur.com/UNt2AbU.jpeg',
                'category_icon' => 'https://i.imgur.com/rbo175Z.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 7,
                'category_name' => 'لحوم',
                'category_image' => 'https://i.imgur.com/3Fk3Ne2.jpg',
                'category_icon' => 'https://i.imgur.com/Q9baIe1.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 8,
                'category_name' => 'مساحيق تنظيف',
                'category_image' => 'https://i.imgur.com/t2Y5f4c.jpeg',
                'category_icon' => 'https://i.imgur.com/SAD21tm.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 9,
                'category_name' => 'اخرى',
                'category_image' => 'https://i.imgur.com/m80Q4fr.jpg',
                'category_icon' => 'https://i.imgur.com/x9Q4lmM.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 10,
                'category_name' => 'الأعشاب، التوابل والخلطات',
                'category_image' => 'https://i.imgur.com/qiVxe91.jpg',
                'category_icon' => 'https://i.imgur.com/8AnHPKG.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 11,
                'category_name' => 'الصلصات',
                'category_image' => 'https://i.imgur.com/jBMm0bE.png',
                'category_icon' => 'https://i.imgur.com/WCPf4w3.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 12,
                'category_name' => 'زينة السلطة ومستلزماتها',
                'category_image' => 'https://i.imgur.com/iyxZPJq.jpg',
                'category_icon' => 'https://i.imgur.com/kqUFhr0.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 13,
                'category_name' => 'الدقيق والخبز',
                'category_image' => 'https://i.imgur.com/ZGf7flF.jpg',
                'category_icon' => 'https://i.imgur.com/TbdjVbd.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 14,
                'category_name' => 'البقوليات والحبوب',
                'category_image' => 'https://i.imgur.com/ZgLcbWE.jpg',
                'category_icon' => 'https://i.imgur.com/fwI9MvD.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 15,
                'category_name' => 'بسكويت',
                'category_image' => 'https://i.imgur.com/jHTaiFi.jpg',
                'category_icon' => 'https://i.imgur.com/R6hDkF5.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 16,
                'category_name' => 'شوكولاته',
                'category_image' => 'https://i.imgur.com/4RHhSr0.jpg',
                'category_icon' => 'https://i.imgur.com/MYZLOgF.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 17,
                'category_name' => 'مربى وعسل',
                'category_image' => 'https://i.imgur.com/Ax7CWFt.jpg',
                'category_icon' => 'https://i.imgur.com/MtifNQd.png',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
        ]);
    }
}
