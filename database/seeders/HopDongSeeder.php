<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HopDongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hop_dong')->insert([
            [
                'user_id' => 1,
                'ngay_bat_dau' => now()->subMonths(6),
                'ngay_ket_thuc' => now()->addMonths(6),
                'tong_tien_coc' => 15000000,
                'tinh_trang' => 'Dang hieu luc',
                'da_thanh_ly' => false,
                'ngay_thanh_ly' => null,
                'ghi_chu_thanh_ly' => null,
                'ghi_chu_thanh_ly' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'user_id' => 2,
                'ngay_bat_dau' => now()->subMonths(12),
                'ngay_ket_thuc' => now()->addMonths(12),
                'tong_tien_coc' => 20000000,
                'tinh_trang' => 'Dang hieu luc',
                'da_thanh_ly' => false,
                'ngay_thanh_ly' => null,
                'ghi_chu_thanh_ly' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'user_id' => 3,
                'ngay_bat_dau' => now()->subMonths(3),
                'ngay_ket_thuc' => now()->addMonths(9),
                'tong_tien_coc' => 12000000,
                'tinh_trang' => 'Het han',
                'da_thanh_ly' => true,
                'ngay_thanh_ly' => now()->subDays(9),
                'ghi_chu_thanh_ly' => 'Hop dong da het han',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'user_id' => 4,
                'ngay_bat_dau' => now()->subMonths(9),
                'ngay_ket_thuc' => now()->addMonths(3),
                'tong_tien_coc' => 18000000,
                'tinh_trang' => 'Dang hieu luc',
                'da_thanh_ly' => false,
                'ngay_thanh_ly' => null,
                'ghi_chu_thanh_ly' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'user_id' => 5,
                'ngay_bat_dau' => now()->subMonths(1),
                'ngay_ket_thuc' => now()->addMonths(11),
                'tong_tien_coc' => 30000000,
                'tinh_trang' => 'Dang hieu luc',
                'da_thanh_ly' => false,
                'ngay_thanh_ly' => null,
                'ghi_chu_thanh_ly' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
