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
        // NguoiDung
        Schema::table('users', function (Blueprint $table) {
            $table->string('so_dien_thoai', 20)->nullable();
            $table->string('dia_chi', 255)->nullable();
            $table->string('cccd', 20)->nullable();
            $table->string('vai_tro', 50)->default('KT');
            $table->boolean('trang_thai')->default(true);
            $table->softDeletes();
        });

        // ToaNha
        Schema::create('toa_nha', function (Blueprint $table) {
            $table->id('ma_toa_nha');
            $table->string('ten_toa_nha', 100);
            $table->string('dia_chi', 255);
            $table->text('mo_ta');
            $table->integer('so_tang');
            $table->string('trang_thai', 50);
            $table->timestamps();
            $table->softDeletes();
        });

        // VanPhong
        Schema::create('van_phong', function (Blueprint $table) {
            $table->id('ma_van_phong');
            $table->unsignedBigInteger('ma_toa_nha');
            $table->float('dien_tich');
            $table->decimal('gia_thue', 18, 2);
            $table->text('mo_ta');
            $table->string('tien_ich', 255);
            $table->string('trang_thai', 50);
            $table->foreign('ma_toa_nha')->references('ma_toa_nha')->on('toa_nha')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // HenXem
        Schema::create('hen_xem', function (Blueprint $table) {
            $table->id('ma_hen_xem');
            $table->string('ho_ten', 100);
            $table->string('sdt', 20);
            $table->string('email', 100);
            $table->unsignedBigInteger('ma_van_phong');
            $table->dateTime('ngay_hen');
            $table->string('ghi_chu', 255)->nullable();
            $table->string('trang_thai', 50);
            $table->foreign('ma_van_phong')->references('ma_van_phong')->on('van_phong')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // HopDong
        Schema::create('hop_dong', function (Blueprint $table) {
            $table->id('ma_hop_dong');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('ngay_bat_dau');
            $table->dateTime('ngay_ket_thuc');
            $table->decimal('tong_tien_coc', 18, 2);
            $table->string('tinh_trang', 50);
            $table->boolean('da_thanh_ly')->default(false);
            $table->dateTime('ngay_thanh_ly')->nullable();
            $table->string('ghi_chu_thanh_ly', 255)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // ChiTietHopDong
        Schema::create('chi_tiet_hop_dong', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_hop_dong');
            $table->unsignedBigInteger('ma_van_phong');
            $table->float('dien_tich');
            $table->decimal('gia_thue', 18, 2);
            $table->decimal('gia_dien', 18, 2);
            $table->decimal('gia_nuoc', 18, 2);
            $table->decimal('dich_vu_khac', 18, 2)->default(0);
            $table->primary(['ma_hop_dong', 'ma_van_phong']);
            $table->foreign('ma_hop_dong')->references('ma_hop_dong')->on('hop_dong')->onDelete('cascade');
            $table->foreign('ma_van_phong')->references('ma_van_phong')->on('van_phong')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // HoaDon
        Schema::create('hoa_don', function (Blueprint $table) {
            $table->id('ma_hoa_don');
            $table->unsignedBigInteger('ma_hop_dong');
            $table->string('thang_nam', 7);
            $table->integer('so_dien');
            $table->integer('so_nuoc');
            $table->decimal('tien_dien', 18, 2);
            $table->decimal('tien_nuoc', 18, 2);
            $table->decimal('tien_thue', 18, 2);
            $table->decimal('tong_tien', 18, 2);
            $table->string('trang_thai', 50);
            $table->foreign('ma_hop_dong')->references('ma_hop_dong')->on('hop_dong')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // ThanhToan
        Schema::create('thanh_toan', function (Blueprint $table) {
            $table->id('ma_thanh_toan');
            $table->unsignedBigInteger('ma_hoa_don');
            $table->string('ma_giao_dich', 100);
            $table->decimal('so_tien', 18, 2);
            $table->string('phuong_thuc', 50);
            $table->string('trang_thai', 50);
            $table->dateTime('thoi_gian');
            $table->string('noi_dung', 255);
            $table->string('phan_hoi_tu_cong_thanh_toan', 255)->nullable();
            $table->foreign('ma_hoa_don')->references('ma_hoa_don')->on('hoa_don')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // YeuCauHoTro
        Schema::create('yeu_cau_ho_tro', function (Blueprint $table) {
            $table->id('ma_yeu_cau');
            $table->unsignedBigInteger('user_id');
            $table->string('tieu_de', 255);
            $table->text('noi_dung');
            $table->dateTime('thoi_gian_gui');
            $table->string('trang_thai_xu_ly', 50);
            $table->text('ghi_chu_xu_ly')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // LichSuCoc
        Schema::create('lich_su_coc', function (Blueprint $table) {
            $table->id('ma_coc');
            $table->unsignedBigInteger('ma_hop_dong');
            $table->decimal('so_tien', 18, 2);
            $table->dateTime('ngay_coc');
            $table->dateTime('ngay_tra_phong');
            $table->string('tinh_trang_hoan', 50);
            $table->decimal('so_tien_hoan', 18, 2)->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['so_dien_thoai', 'dia_chi', 'cccd', 'vai_tro', 'trang_thai', 'deleted_at']);
        });

        Schema::dropIfExists('lich_su_coc');
        Schema::dropIfExists('yeu_cau_ho_tro');
        Schema::dropIfExists('thanh_toan');
        Schema::dropIfExists('hoa_don');
        Schema::dropIfExists('chi_tiet_hop_dong');
        Schema::dropIfExists('hop_dong');
        Schema::dropIfExists('hen_xem');
        Schema::dropIfExists('van_phong');
        Schema::dropIfExists('toa_nha');
    }
};