<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Nguyễn Hoàng Nam',
                'email' => 'nam.nguyen@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0912345678',
                'dia_chi' => 'Số 15 Lê Duẩn, Phường Bến Nghé, Quận 1, TP. Hồ Chí Minh',
                'cccd' => '001092000123',
                'vai_tro' => 'admin',
                'trang_thai' => '1',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Lê Văn Phúc',
                'email' => 'phuc.le@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0934567890',
                'dia_chi' => '98 Nguyễn Oanh, Phường 17, Quận Gò Vấp, TP. Hồ Chí Minh',
                'cccd' => '079299003567',
                'vai_tro' => 'admin',
                'trang_thai' => '0',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Trần Thị Minh Thư',
                'email' => 'minhthu.tran@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0923456789',
                'dia_chi' => '123 Nguyễn Thị Minh Khai, Phường Phạm Ngũ Lão, Quận 1, TP. Hồ Chí Minh',
                'cccd' => '205085002345',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Phạm Thị Hồng Nhung',
                'email' => 'hongnhung.pham@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0945678901',
                'dia_chi' => '25 Hoàng Diệu, Phường 10, Quận Phú Nhuận, TP. Hồ Chí Minh',
                'cccd' => '323188004789',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Đỗ Quốc Khánh',
                'email' => 'quockhanh.do@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0956789012',
                'dia_chi' => '42 Lý Thường Kiệt, Phường 7, Quận Tân Bình, TP. Hồ Chí Minh',
                'cccd' => '123456007890',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Vũ Thị Mai Hương',
                'email' => 'maihuong.vu@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0961234567',
                'dia_chi' => '35 Nguyễn Thị Tú, Phường Bình Hưng Hòa B, Quận Bình Tân, TP. Hồ Chí Minh',
                'cccd' => '089123456789',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Ngô Văn Tài',
                'email' => 'tai.ngo@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0972345678',
                'dia_chi' => '52 Trần Phú, Phường Hải Châu 1, Quận Hải Châu, TP. Đà Nẵng',
                'cccd' => '204567891234',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Phan Thị Lan',
                'email' => 'lan.phan@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0983456789',
                'dia_chi' => 'Số 2 Phạm Văn Đồng, Phường Dịch Vọng Hậu, Quận Cầu Giấy, TP. Hà Nội',
                'cccd' => '012345670001',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Ngô Thị Hạnh',
                'email' => 'hanh.ngo@gmail.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0966666666',
                'dia_chi' => '12 Phạm Văn Chiêu, Phường 9, Quận Gò Vấp, TP. Hồ Chí Minh',
                'cccd' => '522345678901',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Vũ Văn Minh',
                'email' => 'minh.vu@gmail.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0977777777',
                'dia_chi' => '24 Đường số 5, Phường Linh Trung, TP. Thủ Đức, TP. Hồ Chí Minh',
                'cccd' => '622345678901',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Phan Thị Thu',
                'email' => 'thu.phan@gmail.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0988888888',
                'dia_chi' => '88 Lê Văn Quới, Phường Bình Hưng Hòa A, Quận Bình Tân, TP. Hồ Chí Minh',
                'cccd' => '722345678901',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Đặng Văn Tâm',
                'email' => 'tam.dang@gmail.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0999999999',
                'dia_chi' => '56 Trần Não, Phường Bình An, TP. Thủ Đức, TP. Hồ Chí Minh',
                'cccd' => '822345678901',
                'vai_tro' => 'KT',
                'trang_thai' => '1',
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Trịnh Đức Minh',
                'email' => 'minh.trinh@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0994567890',
                'dia_chi' => '18 Nguyễn Văn Cừ, Phường An Bình, Quận Ninh Kiều, TP. Cần Thơ',
                'cccd' => '327654321098',
                'vai_tro' => 'KT',
                'trang_thai' => '0',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Bùi Thị Kim Ngân',
                'email' => 'kimngan.bui@example.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0905678901',
                'dia_chi' => '12 Lạch Tray, Phường Lạch Tray, Quận Ngô Quyền, TP. Hải Phòng',
                'cccd' => '134567890123',
                'vai_tro' => 'KT',
                'trang_thai' => '0',
                'created_at' => now(), 'updated_at' => now()
            ]
        ]);
    }
}
