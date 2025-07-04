<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HopDong extends Model
{
    use SoftDeletes;

    protected $table = 'hop_dong';
    protected $primaryKey = 'ma_hop_dong';
    protected $fillable = ['user_id', 'ngay_ky' ,'ngay_bat_dau', 'ngay_ket_thuc', 'tong_tien_coc', 'tinh_trang', 'da_thanh_ly', 'ngay_thanh_ly', 'ghi_chu_thanh_ly'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function chiTietHopDongs()
    {
        return $this->hasMany(ChiTietHopDong::class, 'ma_hop_dong');
    }

    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'ma_hop_dong');
    }

    public function lichSuCocs()
    {
        return $this->hasMany(LichSuCoc::class, 'ma_hop_dong');
    }
    public function vanPhongs()
    {
        return $this->belongsToMany(VanPhong::class, 'chi_tiet_hop_dong', 'ma_hop_dong', 'ma_van_phong')
            ->withTimestamps()
            ->withPivot(['dien_tich', 'gia_thue']);
    }
}