<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hop_dong', function (Blueprint $table) {
            $table->unsignedInteger('phien_ban_mau')->default(1)->after('ngay_thanh_ly');
        });

        Schema::table('hop_dong_thanh_ly', function (Blueprint $table) {
            $table->unsignedInteger('phien_ban_mau')->default(1)->after('tong_thanh_toan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hop_dong', function (Blueprint $table) {
            $table->dropColumn('phien_ban_mau');
        });

        Schema::table('hop_dong_thanh_ly', function (Blueprint $table) {
            $table->dropColumn('phien_ban_mau');
        });
    }
};
