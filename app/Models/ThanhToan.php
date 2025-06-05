<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThanhToan extends Model
{
    use SoftDeletes;

    protected $table = 'thanh_toan';
    protected $primaryKey = 'ma_thanh_toan';
    protected $fillable = ['ma_hoa_don', 'ma_giao_dich', 'so_tien', 'phuong_thuc', 'trang_thai', 'thoi_gian', 'noi_dung', 'phan_hoi_tu_cong_thanh_toan'];

    protected $casts = [
        'thoi_gian' => 'datetime',
    ];

    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'ma_hoa_don');
    }
}
