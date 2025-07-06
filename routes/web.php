<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HenXemController;
use App\Http\Controllers\Admin\KhachHangController;
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
use App\Http\Controllers\Admin\HoaDonController;
use App\Http\Controllers\Admin\ChiSoController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\User\VanPhongController as UserVanPhongController;

Route::get('/', function () {
    return redirect()->route('user.home');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    
    Route::get('/trang-chu', [HomeController::class, 'index'])->name('home');
    Route::get('/danh-sach', [HomeController::class, 'danhsach'])->name('danhsach');

    Route::get('/van-phong/{slug}', [UserVanPhongController::class, 'show'])->name('vanphong.chitiet');
    Route::get('/van-phong/henxem/{slug}', [UserVanPhongController::class, 'henxem'])->name('vanphong.henxem');
    Route::post('/van-phong/guiyeucau', [UserVanPhongController::class, 'guiyeucau'])->name('vanphong.guiyeucau');
    Route::get('/lienhe', function () {
        return view('user.home.lienhe');
    })->name('lienhe');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
});

Route::middleware(['auth', 'verified', 'check.role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [ AdminController::class, 'index'])->name('dashboard');


    //Route quản lý tòa nhà
    Route::resource('toanha', ToaNhaController::class);
    Route::get('/toanha/preview/{id}', [ToaNhaController::class, 'preview'])->name('toanha.preview');

    //Route quản lý hợp đồng
    Route::resource('hopdong', HopDongController::class);
    Route::get('/hopdong/{id}/view', [HopDongController::class, 'show'])->name('hopdong.view');
    Route::post('/hopdong/xac-nhan-da-ky', [HopDongController::class, 'xacNhanDaKy'])->name('admin.hopdong.xac_nhan_da_ky');
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
    Route::get('vanphong/dathue', [VanPhongController::class, 'dathue'])->name('vanphong.dathue');
    Route::get('vanphong/dangxem', [VanPhongController::class, 'dangxem'])->name('vanphong.dangxem');
    Route::get('vanphong/hethanhopdong', [VanPhongController::class, 'hethan'])->name('vanphong.hethan');
    Route::get('vanphong/dangtrong', [VanPhongController::class, 'dangtrong'])->name('vanphong.dangtrong');
    Route::get('vanphong/create', [VanPhongController::class, 'create'])->name('vanphong.create');
    Route::post('vanphong', [VanPhongController::class, 'store'])->name('vanphong.store');
    Route::get('vanphong/{ma_van_phong}/edit', [VanPhongController::class, 'edit'])->name('vanphong.edit');
    Route::put('vanphong/{ma_van_phong}', [VanPhongController::class, 'update'])->name('vanphong.update');
    Route::get('vanphong/preview/{id}', [VanPhongController::class, 'preview'])->name('vanphong.preview');

    //Route quản lý khách hàng
    Route::get('khachhang', [KhachHangController::class, 'index'])->name('khachhang.index');
    Route::get('khachhang/create', [KhachHangController::class, 'create'])->name('khachhang.create');
    Route::get('khachhang/create/{id}', [KhachHangController::class, 'create'])->name('khachhang.create.henxem');
    Route::post('khachhang', [KhachHangController::class, 'store'])->name('khachhang.store');
    Route::get('khachhang/{id}/edit', [KhachHangController::class, 'edit'])->name('khachhang.edit');
    Route::put('khachhang/{id}', [KhachHangController::class, 'update'])->name('khachhang.update');

    //Route quản lý hẹn xem
    Route::get('henxem', [HenXemController::class, 'index'])->name('henxem.index');
    Route::get('henxem/create', [HenXemController::class, 'create'])->name('henxem.create');
    Route::post('henxem', [HenXemController::class, 'store'])->name('henxem.store');
    Route::get('henxem/khachdadangki/{id}', [HenXemController::class, 'khachdadangki'])->name('henxem.khachdadangki');
    Route::get('henxem/{id}/edit', [HenXemController::class, 'edit'])->name('henxem.edit');
    Route::put('henxem/{id}', [HenXemController::class, 'update'])->name('henxem.update');

    //Route quản lý yêu cầu hỗ trợ
    Route::resource('hotro', HoTroController::class);

    //Route thống kê
    Route::get('thongke', [ThongKeController::class, 'index'])->name('thongke.index');
    Route::get('thongke/doanh-thu-thang', [ThongKeController::class, 'doanhThuThang'])->name('thongke.doanh_thu_thang');
    Route::get('thongke/ty-le-lap-day', [ThongKeController::class, 'tyLeLapDay'])->name('thongke.ty_le_lap_day');
    // Route quản lý chỉ số
    Route::get('chiso', [ChiSoController::class, 'index'])->name('chiso.index');
    Route::get('chiso/create', [ChiSoController::class, 'create'])->name('chiso.create');
    Route::post('chiso', [ChiSoController::class, 'store'])->name('chiso.store');
    Route::get('chiso/{id}/edit', [ChiSoController::class, 'edit'])->name('chiso.edit');
    Route::put('chiso/{id}', [ChiSoController::class, 'update'])->name('chiso.update');

    // Route quản lý hóa đơn
    Route::get('hoadon', [HoaDonController::class, 'index'])->name('hoadon.index');
    Route::get('/hoadon/preview/{id}', [HoaDonController::class, 'preview'])->name('hoadon.preview');
    Route::post('/hoadon/guimail', [HoaDonController::class, 'guiMail'])->name('hoadon.guimail');
    Route::get('/admin/hoadon/{id}/pdf', [HoaDonController::class, 'downloadPDF'])->name('hoadon.downloadPDF');

});

Route::middleware(['auth', 'verified', 'check.role:KT'])->prefix('kt')->name('kt.')->group(function () {

    Route::get('/dashboard', [KTController::class, 'index'])->name('dashboard');
    Route::get('/hopdong', [KTController::class, 'DSHopDong'])->name('hopdong');
    Route::get('/hopdong/preview/{id}', [KTController::class, 'preview_hopdong'])->name('hopdong.preview');
    Route::get('/hopdong/export-pdf/{id}', [KTController::class, 'exportPDF_hopdong'])->name('hopdong.export_pdf');

    Route::get('/hoadon', [KTController::class, 'DSHoaDon'])->name('hoadon');
    Route::get('/hoadon/preview/{id}', [KTController::class, 'preview_hoadon'])->name('hoadon.preview');
    Route::get('/hoadon/export-pdf/{id}', [KTController::class, 'exportPDF_hoadon'])->name('hoadon.export_pdf');
    Route::get('/hoadon/thanh-toan/{id}', [ThanhToanController::class, 'thanhToan'])->name('hoadon.thanh_toan');
    Route::get('/vnpay/return', [ThanhToanController::class, 'vnpayReturn'])->name('vnpay.return');

    Route::get('/hotro', [KTController::class, 'DSHoTro'])->name('hotro');
    Route::get('/hotro/create', [KTController::class, 'hotro_create'])->name('hotro.create');
    Route::post('/hotro', [KTController::class, 'hotro_store'])->name('hotro.store');

});




Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->vai_tro === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->vai_tro === 'KT') {
        return redirect()->route('kt.dashboard');
    }
    abort(403, 'Không có quyền truy cập');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';