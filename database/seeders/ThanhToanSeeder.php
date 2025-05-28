<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThanhToanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('thanh_toan')->insert([
            [
                'ma_hoa_don' => 1,
                'ma_giao_dich' => 'GD20250401',
                'so_tien' => 15750000.00,
                'phuong_thuc' => 'Chuyen khoan',
                'trang_thai' => 'Hoan thanh',
                'thoi_gian' => now()->subDays(10),
                'noi_dung' => 'Thanh toan tien thue thang 4',
                'phan_hoi_tu_cong_thanh_toan' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hoa_don' => 3,
                'ma_giao_dich' => 'GD20250402',
                'so_tien' => 12400000.00,
                'phuong_thuc' => 'Tien mat',
                'trang_thai' => 'Hoan thanh',
                'thoi_gian' => now()->subDays(8),
                'noi_dung' => 'Thanh toan tien thue thang 4',
                'phan_hoi_tu_cong_thanh_toan' => 'Thanh toan thanh cong',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hoa_don' => 5,
                'ma_giao_dich' => 'GD20250403',
                'so_tien' => 30960000.00,
                'phuong_thuc' => 'Chuyen khoan',
                'trang_thai' => 'Hoan thanh',
                'thoi_gian' => now()->subDays(3),
                'noi_dung' => 'Thanh toan tien thue thang 4',
                'phan_hoi_tu_cong_thanh_toan' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hoa_don' => 2,
                'ma_giao_dich' => 'GD20250404',
                'so_tien' => 0.00,
                'phuong_thuc' => 'Chua thanh toan',
                'trang_thai' => 'Dang cho',
                'thoi_gian' => now(),
                'noi_dung' => 'Chua thanh toan tien thue thang 4',
                'phan_hoi_tu_cong_thanh_toan' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hoa_don' => 4,
                'ma_giao_dich' => 'GD20250405',
                'so_tien' => 0.00,
                'phuong_thuc' => 'Chua thanh toan',
                'trang_thai' => 'Dang cho',
                'thoi_gian' => now(),
                'noi_dung' => 'Chua thanh toan tien thue thang 4',
                'phan_hoi_tu_cong_thanh_toan' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
