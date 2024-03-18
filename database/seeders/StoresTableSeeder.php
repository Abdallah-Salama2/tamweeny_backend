<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StoresTableSeeder extends Seeder
{
    public function run()
    {
        $currentTimestamp = Carbon::now();

        DB::table('stores')->insert([
            [
                'id' => 1,
                'owner_id' => null,
                'store_name' => 'مكتب تموين مدينة نصر',
                'address' => '78 مساكن عثمان بجوار شركه كاسيو مدينة نصر',
                'phone_number' => '01102034578',
                'type' => 'مكتب حكومي',
                'valid' => 1,
                'latitude' => '30.05283352',
                'longitude' => '31.33477916',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 2,
                'owner_id' => null,
                'store_name' => 'تموين الحي العاشر',
                'address' => '29VG+H6P, Al Hay Al Asher, Nasr City, Cairo Governorate 4442255',
                'phone_number' => '0',
                'type' => 'بقاله',
                'valid' => 1,
                'latitude' => '30.04518064',
                'longitude' => '31.37614544',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 3,
                'owner_id' => null,
                'store_name' => 'مكتب التموين الحى العاشر',
                'address' => '29WG+GFM، فى اخر شارع سوق الحى العاشر محل الاسلامية للادوات الكهربية تخش الحارة اللى جنبه على طول هتلقى صيدلية بنفس عمارة الصيدلية الدور الثالث, Nasr City, Cairo Governorate',
                'phone_number' => '0',
                'type' => 'مكتب حكومي',
                'valid' => 1,
                'latitude' => '30.04848509',
                'longitude' => '31.37632299',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 4,
                'owner_id' => null,
                'store_name' => 'تموين الحاج شكوكو',
                'address' => '27VM+P3J, Al Abageyah, Manshiyat Naser, Cairo Governorate 4421553',
                'phone_number' => '0',
                'type' => 'بقالة',
                'valid' => 0,
                'latitude' => '30.04466362',
                'longitude' => '31.28357688',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'id' => 5,
                'owner_id' => null,
                'store_name' => 'بقاله اسامه تموين',
                'address' => '393M+227، مدينة نصر',
                'phone_number' => '0',
                'type' => 'بقاله',
                'valid' => 1,
                'latitude' => '30.05357878',
                'longitude' => '31.38593515',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
        ]);
    }
}
