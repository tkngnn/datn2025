<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UsersTableSeeder::class,
            ToaNhaSeeder::class,
            VanPhongSeeder::class,
            HenXemSeeder::class,
            HopDongSeeder::class,
            ChiTietHopDongSeeder::class,
            HoaDonSeeder::class,
            ThanhToanSeeder::class,
            YeuCauHoTroSeeder::class,
            LichSuCocSeeder::class,
        ]);
    }
}
