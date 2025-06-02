<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToaNhaSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('toa_nha')->insert([
            [
                'ten_toa_nha' => 'Toa Nha A',
                'dia_chi' => '1 Le Loi', 
                'mo_ta' => 'Van phong cao cap', 
                'so_tang' => 10, 
                'trang_thai' => 'hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'ten_toa_nha' => 'Toa Nha B',
                'dia_chi' => '2 Nguyen Trai', 
                'mo_ta' => 'Toa nha moi', 
                'so_tang' => 8, 
                'trang_thai' => 'khong hoat dong', 
                'created_at' => now(), 
                'updated_at' => now()
            ],   
        ]);
    }
}