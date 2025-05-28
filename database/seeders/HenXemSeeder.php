<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HenXemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hen_xem')->insert([
            [
                'ho_ten' => 'Nguyen Hoang A',
                'sdt' => '0111111111',
                'email' => 'NguyenA@example.com',
                'ma_van_phong' => 1,
                'ngay_hen' => now()->addDays(3),
                'ghi_chu' => 'Muon xem phong tang 3',
                'trang_thai' => 'Chua xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Tran Van B',
                'sdt' => '0222222222',
                'email' => 'TranB@example.com',
                'ma_van_phong' => 2,
                'ngay_hen' => now()->addDays(5),
                'ghi_chu' => null,
                'trang_thai' => 'Da xac nhan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Le Pham C',
                'sdt' => '0333333333',
                'email' => 'LeC@example.com',
                'ma_van_phong' => 3,
                'ngay_hen' => now()->addDays(2),
                'ghi_chu' => 'Xem phong 2 nguoi',
                'trang_thai' => 'Chua xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Pham Thanh D',
                'sdt' => '0444444444',
                'email' => 'PhamD@example.com',
                'ma_van_phong' => 4,
                'ngay_hen' => now()->addDays(7),
                'ghi_chu' => null,
                'trang_thai' => 'Da xac nhan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Hoang Minh E',
                'sdt' => '0555555555',
                'email' => 'HoangE@example.com',
                'ma_van_phong' => 5,
                'ngay_hen' => now()->addDays(1),
                'ghi_chu' => 'Can xem phong rat gap',
                'trang_thai' => 'Chua xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
