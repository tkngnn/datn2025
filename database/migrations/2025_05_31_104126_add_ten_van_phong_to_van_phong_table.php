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
        Schema::table('van_phong', function (Blueprint $table) {
            $table->string('ten_van_phong')->after('ma_van_phong');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('van_phong', function (Blueprint $table) {
            $table->dropColumn('ten_van_phong');
        });
    }
};
