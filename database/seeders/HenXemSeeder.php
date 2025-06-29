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
                'ho_ten' => 'Nguyễn Hoàng Anh',
                'sdt' => '0912345678',
                'email' => 'hoanganh.nguyen@gmail.com',
                'ma_van_phong' => 3,
                'ngay_hen' => now()->addDays(3),
                'ghi_chu' => 'Muốn xem văn phòng tầng 3, diện tích 40m².',
                'trang_thai' => 'chua xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Trần Văn Bình',
                'sdt' => '0987654321',
                'email' => 'binh.tran@gmail.com',
                'ma_van_phong' => 6,
                'ngay_hen' => now()->addDays(5),
                'ghi_chu' => 'Quan tâm đến phòng 201, có ban công.',
                'trang_thai' => 'da xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Lê Phạm Châu',
                'sdt' => '0909090909',
                'email' => 'chau.lepham@yahoo.com',
                'ma_van_phong' => 10,
                'ngay_hen' => now()->addDays(2),
                'ghi_chu' => 'Xem phòng cho 2 người, có sẵn bàn ghế.',
                'trang_thai' => 'chua xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Phạm Thành Duy',
                'sdt' => '0968888888',
                'email' => 'duy.phamthanh@outlook.com',
                'ma_van_phong' => 9,
                'ngay_hen' => now()->addDays(7),
                'ghi_chu' => 'Xem văn phòng tầng trệt, thuận tiện tiếp khách.',
                'trang_thai' => 'da xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Hoàng Minh Đức',
                'sdt' => '0977123456',
                'email' => 'duc.hoangminh@gmail.com',
                'ma_van_phong' => 22,
                'ngay_hen' => now()->addDays(1),
                'ghi_chu' => 'Cần xem gấp do cần chuyển văn phòng trong tuần.',
                'trang_thai' => 'chua xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}