<?php

use App\Http\Controllers\Admin\HenXemController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\Admin\VanPhongController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ToaNhaController;
use App\Http\Controllers\Admin\HopDongController;
use App\Http\Controllers\Admin\TNVPController;
use App\Http\Controllers\Admin\HoaDonController;
use App\Http\Controllers\Admin\ChiSoController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
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