<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VanPhong;
use Illuminate\Support\Facades\File;

class VanPhongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            [//1
                'ma_toa_nha' => 1,
                'ten_van_phong' => 'Văn phòng 1001',
                'slug' => 'van-phong-1001',
                'dien_tich' => 100,
                'gia_thue' => 760000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'May lanh, Wifi',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 1,
                'ten_van_phong' => 'Văn phòng 1002',
                'slug' => 'van-phong-1002',
                'dien_tich' => 104,
                'gia_thue' => 760000,
                'mo_ta' => '<ul><li>Tầng: 2</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang may, Bao ve 24/7',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 1,
                'ten_van_phong' => 'Văn phòng 1003',
                'slug' => 'van-phong-1003',
                'dien_tich' => 176,
                'gia_thue' => 760000,
                'mo_ta' => '<ul><li>Tầng: 3</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang may, Bao ve 24/7',
                'trang_thai' => 'khong hoat dong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 2,
                'ten_van_phong' => 'Văn phòng 2001',
                'slug' => 'van-phong-2001',
                'dien_tich' => 330,
                'gia_thue' => 760000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Wifi, Ban ghe',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [//5
                'ma_toa_nha' => 2,
                'ten_van_phong' => 'Văn phòng 2002',
                'slug' => 'van-phong-2002',
                'dien_tich' => 202,
                'gia_thue' => 760000,
                'mo_ta' => '<ul><li>Tầng: 2</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'May lanh, Bao ve',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 2,
                'ten_van_phong' => 'Văn phòng 2003',
                'slug' => 'van-phong-2003',
                'dien_tich' => 144,
                'gia_thue' => 760000,
                'mo_ta' => '<ul><li>Tầng: 3</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Wifi, Ban ghe',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 3,
                'ten_van_phong' => 'Văn phòng 3001',
                'slug' => 'van-phong-3001',
                'dien_tich' => 246,
                'gia_thue' => 730000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang may, Wifi, Bao ve',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 3,
                'ten_van_phong' => 'Văn phòng 3002',
                'slug' => 'van-phong-3002',
                'dien_tich' => 79,
                'gia_thue' => 730000,
                'mo_ta' => '<ul><li>Tầng: 2</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Wifi, Bảo vệ',
                'trang_thai' => 'dang xem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 4,
                'ten_van_phong' => 'Văn phòng 4001',
                'slug' => 'van-phong-4001',
                'dien_tich' => 104,
                'gia_thue' => 675000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Camera an ninh, Lễ tân',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [//10
                'ma_toa_nha' => 4,
                'ten_van_phong' => 'Văn phòng 4002',
                'slug' => 'van-phong-4002',
                'dien_tich' => 137,
                'gia_thue' => 675000,
                'mo_ta' => '<ul><li>Tầng: 2</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Lễ tân, Máy phát điện',
                'trang_thai' => 'dang xem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 5,
                'ten_van_phong' => 'Văn phòng 5001',
                'slug' => 'van-phong-5001',
                'dien_tich' => 84,
                'gia_thue' => 730000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Lễ tân, Máy phát điện',
                'trang_thai' => 'cho ban giao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 5,
                'ten_van_phong' => 'Văn phòng 5002',
                'slug' => 'van-phong-5002',
                'dien_tich' => 116,
                'gia_thue' => 730000,
                'mo_ta' => '<ul><li>Tầng: 2</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Máy lạnh, Thang máy, Khu vực tiếp khách',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 6,
                'ten_van_phong' => 'Văn phòng 6001',
                'slug' => 'van-phong-6001',
                'dien_tich' => 140,
                'gia_thue' => 675000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Lễ tân, Máy phát điện',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 6,
                'ten_van_phong' => 'Văn phòng 6002',
                'slug' => 'van-phong-6002',
                'dien_tich' => 204,
                'gia_thue' => 675000,
                'mo_ta' => '<ul><li>Tầng: 2</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Wifi, Bảo vệ',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [//15
                'ma_toa_nha' => 6,
                'ten_van_phong' => 'Văn phòng 6003',
                'slug' => 'van-phong-6003',
                'dien_tich' => 184,
                'gia_thue' => 675000,
                'mo_ta' => '<ul><li>Tầng: 3</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Wifi, Bảo vệ',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 7,
                'ten_van_phong' => 'Văn phòng 7001',
                'slug' => 'van-phong-7001',
                'dien_tich' => 946,
                'gia_thue' => 760000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Máy lạnh, Wifi',
                'trang_thai' => 'khong hoat dong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 8,
                'ten_van_phong' => 'Văn phòng 8001',
                'slug' => 'van-phong-8001',
                'dien_tich' => 435,
                'gia_thue' => 700000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Máy lạnh, Wifi',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 8,
                'ten_van_phong' => 'Văn phòng 8002',
                'slug' => 'van-phong-8002',
                'dien_tich' => 470,
                'gia_thue' => 700000,
                'mo_ta' => '<ul><li>Tầng: 2</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Máy lạnh, Thang máy, Khu vực tiếp khách',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 8,
                'ten_van_phong' => 'Văn phòng 8003',
                'slug' => 'van-phong-8003',
                'dien_tich' => 200,
                'gia_thue' => 615000,
                'mo_ta' => '<ul><li>Tầng: 3</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Wifi, Bảo vệ',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [//20
                'ma_toa_nha' => 9,
                'ten_van_phong' => 'Văn phòng 9001',
                'slug' => 'van-phong-9001',
                'dien_tich' => 216,
                'gia_thue' => 615000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Camera an ninh, Lễ tân',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            [
                'ma_toa_nha' => 9,
                'ten_van_phong' => 'Văn phòng 9002',
                'slug' => 'van-phong-9002',
                'dien_tich' => 238,
                'gia_thue' => 633000,
                'mo_ta' => '<ul><li>Tầng: 2</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Camera an ninh, Lễ tân',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 10,
                'ten_van_phong' => 'Văn phòng 10001',
                'slug' => 'van-phong-10001',
                'dien_tich' => 80,
                'gia_thue' => 635000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Camera an ninh, Lễ tân',
                'trang_thai' => 'dang trong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 11,
                'ten_van_phong' => 'Văn phòng 11002',
                'slug' => 'van-phong-11002',
                'dien_tich' => 190,
                'gia_thue' => 700000,
                'mo_ta' => '<ul><li>Tầng: 1</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Thang máy, Camera an ninh, Lễ tân',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_toa_nha' => 11,
                'ten_van_phong' => 'Văn phòng 11003',
                'slug' => 'van-phong-11002',
                'dien_tich' => 77,
                'gia_thue' => 70000,
                'mo_ta' => '<ul><li>Tầng: 2</li><li>Không gian thoáng mát</li><li>Camera an ninh</li><li>Thang máy đầy đủ, tiện nghi</li></ul>',
                'tien_ich' => 'Máy lạnh, Wifi',
                'trang_thai' => 'da thue',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];
        foreach ($data as $vpData) {
            $vanPhong = VanPhong::create($vpData);

            $imageFolder = storage_path('app/public/seeder_images/' . $vanPhong->ma_van_phong);

            if (File::isDirectory($imageFolder)) {
                $vanPhong->clearMediaCollection('anh_van_phong');
                foreach (File::files($imageFolder) as $imageFile) {
                    $vanPhong->addMedia($imageFile->getPathname())
                        ->preservingOriginal()
                        ->toMediaCollection('anh_van_phong');
                }
            }
        }
    }
}