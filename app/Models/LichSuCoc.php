<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LichSuCoc extends Model
{
    use SoftDeletes;

    protected $table = 'lich_su_coc';
    protected $primaryKey = 'ma_coc';
    protected $fillable = ['ma_hop_dong', 'so_tien', 'ngay_coc', 'ngay_tra_phong', 'tinh_trang_hoan', 'so_tien_hoan', 'ghi_chu'];

    public function hopDong()
    {
        return $this->belongsTo(HopDong::class, 'ma_hop_dong');
    }
}