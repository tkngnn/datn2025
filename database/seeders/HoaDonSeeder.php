<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HoaDonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hoa_don')->insert([
            [
                'ma_hop_dong' => 1,
                'thang_nam' => '2025-04',
                'so_dien' => 150,
                'so_nuoc' => 30,
                'tien_dien' => 450000.00,
                'tien_nuoc' => 150000.00,
                'tien_thue' => 15000000.00,
                'tong_tien' => 15750000.00,
                'trang_thai' => 'Da thanh toan',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 2,
                'thang_nam' => '2025-04',
                'so_dien' => 200,
                'so_nuoc' => 50,
                'tien_dien' => 600000.00,
                'tien_nuoc' => 250000.00,
                'tien_thue' => 20000000.00,
                'tong_tien' => 20850000.00,
                'trang_thai' => 'Chua thanh toan',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 3,
                'thang_nam' => '2025-04',
                'so_dien' => 100,
                'so_nuoc' => 20,
                'tien_dien' => 300000.00,
                'tien_nuoc' => 100000.00,
                'tien_thue' => 12000000.00,
                'tong_tien' => 12400000.00,
                'trang_thai' => 'Da thanh toan',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 4,
                'thang_nam' => '2025-04',
                'so_dien' => 180,
                'so_nuoc' => 40,
                'tien_dien' => 540000.00,
                'tien_nuoc' => 200000.00,
                'tien_thue' => 18000000.00,
                'tong_tien' => 18740000.00,
                'trang_thai' => 'Chua thanh toan',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 5,
                'thang_nam' => '2025-04',
                'so_dien' => 220,
                'so_nuoc' => 60,
                'tien_dien' => 660000.00,
                'tien_nuoc' => 300000.00,
                'tien_thue' => 30000000.00,
                'tong_tien' => 30960000.00,
                'trang_thai' => 'Da thanh toan',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
