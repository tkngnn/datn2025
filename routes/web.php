<?php

use App\Http\Controllers\VanPhongController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function() {
        Route::get('vanphong', [VanPhongController::class, 'index'])->name('vanphong.index');
        Route::get('vanphong/create', [VanPhongController::class, 'create'])->name('vanphong.create');
        Route::post('vanphong', [VanPhongController::class, 'store'])->name('vanphong.store');
        Route::get('vanphong/{ma_van_phong}/edit', [VanPhongController::class, 'edit'])->name('vanphong.edit');
        Route::put('vanphong/{ma_van_phong}', [VanPhongController::class, 'update'])->name('vanphong.update');
        Route::delete('vanphong/{ma_van_phong}', [VanPhongController::class, 'destroy'])->name('vanphong.destroy');
    });
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