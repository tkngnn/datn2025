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
                'name' => 'Nguyễn Văn A',
                'email' => 'a@gmail.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0911111111',
                'dia_chi' => 'Hà Nội',
                'cccd' => '012345678901',
                'vai_tro' => 'Admin',
                'trang_thai' => true,
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Trần Thị B',
                'email' => 'b@gmail.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0922222222',
                'dia_chi' => 'Đà Nẵng',
                'cccd' => '112345678901',
                'vai_tro' => 'KT',
                'trang_thai' => true,
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Lê Văn C',
                'email' => 'c@gmail.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0933333333',
                'dia_chi' => 'TP HCM',
                'cccd' => '212345678901',
                'vai_tro' => 'Admin',
                'trang_thai' => false,
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Phạm Thị D',
                'email' => 'd@gmail.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0944444444',
                'dia_chi' => 'Cần Thơ',
                'cccd' => '312345678901',
                'vai_tro' => 'KT',
                'trang_thai' => true,
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Đỗ Văn E',
                'email' => 'e@gmail.com',
                'password' => Hash::make('123456'),
                'so_dien_thoai' => '0955555555',
                'dia_chi' => 'Hải Phòng',
                'cccd' => '412345678901',
                'vai_tro' => 'KT',
                'trang_thai' => true,
                'created_at' => now(), 'updated_at' => now()
            ]
        ]);
    }
}
