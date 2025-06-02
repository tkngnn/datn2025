<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YeuCauHoTroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('yeu_cau_ho_tro')->insert([
            [
                'user_id' => 1,
                'tieu_de' => 'Lỗi đăng nhập không được',
                'noi_dung' => 'Tôi không thể đăng nhập vào hệ thống dù đã nhập đúng tài khoản và mật khẩu.',
                'thoi_gian_gui' => now()->subDays(3),
                'trang_thai_xu_ly' => 'chua xu ly',
                'ghi_chu_xu_ly' => null,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'deleted_at' => null,
            ],
            [
                'user_id' => 2,
                'tieu_de' => 'Yêu cầu thêm tính năng xuất báo cáo',
                'noi_dung' => 'Mong muốn có thêm chức năng xuất báo cáo theo định dạng PDF và Excel.',
                'thoi_gian_gui' => now()->subDays(10),
                'trang_thai_xu_ly' => 'da xu ly',
                'ghi_chu_xu_ly' => 'Đã nhận yêu cầu, đang triển khai.',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(2),
                'deleted_at' => null,
            ],
            [
                'user_id' => 3,
                'tieu_de' => 'Lỗi hiển thị trang quản lý',
                'noi_dung' => 'Trang quản lý hiện không load được dữ liệu đúng cách.',
                'thoi_gian_gui' => now()->subDays(5),
                'trang_thai_xu_ly' => 'da xu ly',
                'ghi_chu_xu_ly' => 'Đã sửa lỗi liên quan đến truy vấn database.',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
                'deleted_at' => null,
            ],
            [
                'user_id' => 4,
                'tieu_de' => 'Yêu cầu hỗ trợ thay đổi mật khẩu',
                'noi_dung' => 'Muốn được hỗ trợ thay đổi mật khẩu tài khoản.',
                'thoi_gian_gui' => now()->subDays(7),
                'trang_thai_xu_ly' => 'chua xu ly',
                'ghi_chu_xu_ly' => null,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
                'deleted_at' => null,
            ],
            [
                'user_id' => 5,
                'tieu_de' => 'Lỗi khi tải file mẫu nhập liệu',
                'noi_dung' => 'Không tải được file mẫu nhập liệu khách hàng.',
                'thoi_gian_gui' => now()->subDays(1),
                'trang_thai_xu_ly' => 'da xu ly',
                'ghi_chu_xu_ly' => 'Đang kiểm tra lỗi server.',
                'created_at' => now()->subDays(1),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}