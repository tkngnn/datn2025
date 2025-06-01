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
        Schema::create('hop_dong_thanh_ly', function (Blueprint $table) {
            $table->id('ma_thanh_ly');
            $table->unsignedBigInteger('ma_hop_dong');

            $table->date('ngay_chuyen_di');
            $table->enum('ly_do_thanh_ly', ['roi_phong', 'bo_coc'])->default('roi_phong');

            $table->decimal('cong_no', 18, 2)->default(0);
            $table->decimal('hoan_tra_tien_coc', 18, 2)->default(0);
            $table->decimal('phi_phat', 18, 2)->default(0);

            $table->decimal('tong_thanh_toan', 18, 2)->default(0);

            $table->string('ghi_chu', 255)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ma_hop_dong')->references('ma_hop_dong')->on('hop_dong')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hop_dong_thanh_ly');
    }
};