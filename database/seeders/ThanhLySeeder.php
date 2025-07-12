<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThanhLySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hop_dong_thanh_ly')->insert([
            [
                'ma_hop_dong' => 13,
                'ngay_chuyen_di' => '2025-02-12',
                'ly_do_thanh_ly' => 'roi_phong',
                'cong_no' => 0,
                'hoan_tra_tien_coc' => 328320000,
                'phi_phat' => 0,
                'tong_thanh_toan' => 0,
                'id_mau' => 2,
                'ghi_chu' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 14,
                'ngay_chuyen_di' => now()->subMonths(7),
                'ly_do_thanh_ly' => 'bo_coc',
                'cong_no' => 0,
                'hoan_tra_tien_coc' => 0,
                'phi_phat' => 0,
                'tong_thanh_toan' => 0,
                'id_mau' => 2,
                'ghi_chu' => 'Bỏ cọc',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}