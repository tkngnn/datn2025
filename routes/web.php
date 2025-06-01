<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ToaNhaController;
use App\Http\Controllers\Admin\HopDongController;
use App\Http\Controllers\Admin\TNVPController;

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
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';