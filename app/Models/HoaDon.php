<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoaDon extends Model
{
    use SoftDeletes;

    protected $table = 'hoa_don';
    protected $primaryKey = 'ma_hoa_don';
    protected $fillable = ['ma_hop_dong', 'thang_nam', 'so_dien', 'so_nuoc', 'tien_dien', 'tien_nuoc', 'tien_thue', 'tong_tien', 'trang_thai'];

    public function hopDong()
    {
        return $this->belongsTo(HopDong::class, 'ma_hop_dong');
    }

    public function thanhToans()
    {
        return $this->hasMany(ThanhToan::class, 'ma_hoa_don');
    }
}