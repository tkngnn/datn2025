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
                'ho_ten' => 'Đặng Phan Thanh Trúc',
                'sdt' => '0923456789',
                'email' => 'dangtruc2004444@gmail.com',
                'ma_van_phong' => 3,
                'ngay_hen' => now()->addDays(3),
                'ghi_chu' => 'Muốn xem văn phòng tầng 3, diện tích 40m².',
                'trang_thai' => 'chua xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Đỗ Quốc Khánh',
                'sdt' => '0956789012',
                'email' => 'quockhanh.do@gmail.com',
                'ma_van_phong' => 6,
                'ngay_hen' => now()->addDays(5),
                'ghi_chu' => 'Quan tâm đến phòng 201, có ban công.',
                'trang_thai' => 'da xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Bùi Thị Kim Ngân',
                'sdt' => '0905678901',
                'email' => 'kimngan.bui@gmail.com',
                'ma_van_phong' => 8,
                'ngay_hen' => now()->addDays(7),
                'ghi_chu' => 'Đang cần xem văn phòng gấp',
                'trang_thai' => 'dang xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Phan Thị Lan',
                'sdt' => '0983456789',
                'email' => 'lan.phan@gmail.com',
                'ma_van_phong' => 10,
                'ngay_hen' => now()->addDays(7),
                'ghi_chu' => 'Đang cần xem văn phòng gấp',
                'trang_thai' => 'dang xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Lê Phạm Châu',
                'sdt' => '0909090909',
                'email' => 'chau.lepham@gmail.com',
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
                'email' => 'duy.phamthanh@gmail.com',
                'ma_van_phong' => 9,
                'ngay_hen' => now()->addDays(7),
                'ghi_chu' => 'Xem văn phòng tầng trệt, thuận tiện tiếp khách.',
                'trang_thai' => 'da xu ly',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ho_ten' => 'Trần Tuấn Tài',
                'sdt' => '0968888888',
                'email' => 'tuantai@gmail.com',
                'ma_van_phong' => 9,
                'ngay_hen' => now()->addDays(7),
                'ghi_chu' => 'Tôi muốn xem văn phòng',
                'trang_thai' => 'da huy',
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