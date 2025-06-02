<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LichSuCocSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lich_su_coc')->insert([
            [
                'ma_hop_dong' => 1,
                'so_tien' => 45000000.00,
                'ngay_coc' => now()->subMonths(6),
                'ngay_tra_phong' => now()->addMonths(6),
                'tinh_trang_hoan' => 'chua hoan',
                'so_tien_hoan' => null,
                'ghi_chu' => 'Dat coc hop dong 1',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 2,
                'so_tien' => 60000000.00,
                'ngay_coc' => now()->subMonths(12),
                'ngay_tra_phong' => now()->addMonths(12),
                'tinh_trang_hoan' => 'da hoan',
                'so_tien_hoan' => 60000000,
                'ghi_chu' => 'Dat coc hop dong 2 da hoan tien',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 3,
                'so_tien' => 36000000.00,
                'ngay_coc' => now()->subMonths(3),
                'ngay_tra_phong' => now()->addMonths(9),
                'tinh_trang_hoan' => 'chua hoan',
                'so_tien_hoan' => null,
                'ghi_chu' => 'Dat coc hop dong 3',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 4,
                'so_tien' => 54000000.00,
                'ngay_coc' => now()->subMonths(9),
                'ngay_tra_phong' => now()->addMonths(3),
                'tinh_trang_hoan' => 'Dang xu ly',
                'so_tien_hoan' => null,
                'ghi_chu' => 'Dat coc hop dong 4, dang xu ly hoan',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'ma_hop_dong' => 5,
                'so_tien' => 90000000.00,
                'ngay_coc' => now()->subMonths(1),
                'ngay_tra_phong' => now()->addMonths(11),
                'tinh_trang_hoan' => 'chua hoan',
                'so_tien_hoan' => null,
                'ghi_chu' => 'Dat coc hop dong 5',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}