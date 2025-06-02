<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VanPhongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('van_phong')->insert([
            [
                'ma_toa_nha' => 1,
                'ten_van_phong' => 'Van phong 101',
                'dien_tich' => 50.5,
                'gia_thue' => 15000000,
                'mo_ta' => 'Van phong tang 3, view dep',
                'tien_ich' => 'May lanh, Wifi',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 2,
                'ten_van_phong' => 'Van phong 201',
                'dien_tich' => 75.0,
                'gia_thue' => 20000000,
                'mo_ta' => 'Van phong tang 5, thoang mat',
                'tien_ich' => 'Thang may, Bao ve 24/7',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 2,
                'ten_van_phong' => 'Van phong 202',
                'dien_tich' => 40.0,
                'gia_thue' => 12000000,
                'mo_ta' => 'Van phong nho, tien nghi',
                'tien_ich' => 'Wifi, Ban ghe',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 2,
                'ten_van_phong' => 'Van phong 203',
                'dien_tich' => 60.0,
                'gia_thue' => 18000000,
                'mo_ta' => 'Van phong view bien',
                'tien_ich' => 'May lanh, Bao ve',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 1,
                'ten_van_phong' => 'Van phong 301',
                'dien_tich' => 100.0,
                'gia_thue' => 30000000,
                'mo_ta' => 'Van phong rong, sang trong',
                'tien_ich' => 'Thang may, Wifi, Bao ve',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}