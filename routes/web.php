<?php

use App\Http\Controllers\HenXemController;
use App\Http\Controllers\KhachHangController;
//use App\Http\Controllers\VanPhongController;
use App\Http\Controllers\Admin\VanPhongController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ToaNhaController;
use App\Http\Controllers\Admin\HopDongController;
use App\Http\Controllers\Admin\TNVPController;
use App\Http\Controllers\Admin\HoTroController;
use App\Http\Controllers\Admin\ThongKeController;

use App\Http\Controllers\Admin\KT\KTController;
use App\Http\Controllers\Admin\KT\ThanhToanController;
use App\Http\Controllers\User\HomeController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/trang-chu', [HomeController::class, 'index'])->name('user.home');
    Route::get('/danh-sach', [HomeController::class, 'danhsach'])->name('user.danhsach');
});

Route::middleware(['auth', 'verified', 'check.role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    //Route quản lý tòa nhà
    Route::resource('toanha', ToaNhaController::class);

    //Route quản lý hợp đồng
    Route::resource('hopdong', HopDongController::class);
    Route::get('/hopdong/{id}/view', [HopDongController::class, 'show'])->name('hopdong.view');
    Route::get('/ajax/vanphong/{toaNhaId}', [TNVPController::class, 'getByToaNha']);
    Route::get('/ajax/vanphong-detail/{vanPhongId}', [TNVPController::class, 'getDetails']);
    Route::get('/ajax/user/{id}', function ($id) {
        $user = App\Models\User::findOrFail($id);
        return response()->json([
            'name' => $user->name,
            'phone' => $user->so_dien_thoai,
            'email' => $user->email,
            'dia_chi' => $user->dia_chi,
            'cmnd' => $user->cccd,
        ]);
    });
    Route::post('/hopdong/thanhly/{ma_hop_dong}', [HopDongController::class, 'thanhLy'])
        ->name('admin.hopdong.thanhly');
    Route::get('/hopdong/{id}/bien-ban-thanh-ly', [HopDongController::class, 'showBienBanThanhLy']);
    Route::get('/hopdong/{id}/export-pdf', [HopDongController::class, 'exportPDF'])->name('hopdong.export_pdf');

    //Route quản lý văn phòng
    Route::get('vanphong', [VanPhongController::class, 'index'])->name('vanphong.index');
    Route::get('vanphong/create', [VanPhongController::class, 'create'])->name('vanphong.create');
    Route::post('vanphong', [VanPhongController::class, 'store'])->name('vanphong.store');
    Route::get('vanphong/{ma_van_phong}/edit', [VanPhongController::class, 'edit'])->name('vanphong.edit');
    Route::put('vanphong/{ma_van_phong}', [VanPhongController::class, 'update'])->name('vanphong.update');

    //Route quản lý khách hàng
    Route::get('khachhang', [KhachHangController::class, 'index'])->name('khachhang.index');
    Route::get('khachhang/create', [KhachHangController::class, 'create'])->name('khachhang.create');
    Route::post('khachhang', [KhachHangController::class, 'store'])->name('khachhang.store');
    Route::get('khachhang/{id}/edit', [KhachHangController::class, 'edit'])->name('khachhang.edit');
    Route::put('khachhang/{id}', [KhachHangController::class, 'update'])->name('khachhang.update');

    //Route quản lý hẹn xem
    Route::get('henxem', [HenXemController::class, 'index'])->name('henxem.index');
    Route::get('henxem/create', [HenXemController::class, 'create'])->name('henxem.create');
    Route::post('henxem', [HenXemController::class, 'store'])->name('henxem.store');
    Route::get('henxem/{id}/edit', [HenXemController::class, 'edit'])->name('henxem.edit');
    Route::put('henxem/{id}', [HenXemController::class, 'update'])->name('henxem.update');

    //Route quản lý yêu cầu hỗ trợ
    Route::resource('hotro', HoTroController::class);

    //Route thống kê
    Route::get('thongke', [ThongKeController::class, 'index'])->name('thongke.index');
    Route::get('thongke/doanh-thu-thang', [ThongKeController::class, 'doanhThuThang'])->name('thongke.doanh_thu_thang');
    Route::get('thongke/ty-le-lap-day', [ThongKeController::class, 'tyLeLapDay'])->name('thongke.ty_le_lap_day');
});

Route::middleware(['auth', 'verified', 'check.role:KT'])->prefix('kt')->name('kt.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.kt.index');
    })->name('dashboard');

    Route::get('/dashboard', [KTController::class, 'index'])->name('dashboard');
    Route::get('/hopdong', [KTController::class, 'DSHopDong'])->name('hopdong');
    Route::get('/hoadon', [KTController::class, 'DSHoaDon'])->name('hoadon');
    Route::get('/hoadon/preview/{id}', [KTController::class, 'preview_hoadon'])->name('hoadon.preview');
    Route::get('/hoadon/export-pdf/{id}', [KTController::class, 'exportPDF'])->name('hoadon.export_pdf');
    Route::get('/hoadon/thanh-toan/{id}', [ThanhToanController::class, 'thanhToan'])->name('hoadon.thanh_toan');
    Route::get('/vnpay/return', [ThanhToanController::class, 'vnpayReturn'])->name('vnpay.return');
});




Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';