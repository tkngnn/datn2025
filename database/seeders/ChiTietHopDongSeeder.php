<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChiTietHopDongSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chi_tiet_hop_dong')->insert([
            [
                'ma_hop_dong' => 1,
                'ma_van_phong' => 1,
                'dien_tich' => 50.5,
                'gia_thue' => 15000000,
                'gia_dien' => 1200000,
                'gia_nuoc' => 800000,
                'dich_vu_khac' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 2,
                'ma_van_phong' => 2,
                'dien_tich' => 40,
                'gia_thue' => 20000000,
                'gia_dien' => 1000000,
                'gia_nuoc' => 700000,
                'dich_vu_khac' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 3,
                'ma_van_phong' => 3,
                'dien_tich' => 60,
                'gia_thue' => 12000000,
                'gia_dien' => 1500000,
                'gia_nuoc' => 900000,
                'dich_vu_khac' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 4,
                'ma_van_phong' => 4,
                'dien_tich' => 35,
                'gia_thue' => 18000000,
                'gia_dien' => 800000,
                'gia_nuoc' => 600000,
                'dich_vu_khac' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 5,
                'ma_van_phong' => 5,
                'dien_tich' => 55,
                'gia_thue' => 30000000,
                'gia_dien' => 1300000,
                'gia_nuoc' => 850000,
                'dich_vu_khac' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);

    }
}
