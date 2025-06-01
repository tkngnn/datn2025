<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HopDongThanhLy extends Model
{
    use SoftDeletes;

    protected $table = 'hop_dong_thanh_ly';

    protected $primaryKey = 'ma_thanh_ly';

    protected $fillable = [
        'ma_hop_dong',
        'ngay_chuyen_di',
        'ly_do_thanh_ly',
        'cong_no',
        'hoan_tra_tien_coc',
        'phi_phat',
        'tong_thanh_toan',
        'ghi_chu',
    ];

    protected $dates = [
        'ngay_chuyen_di',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function hopDong()
    {
        return $this->belongsTo(HopDong::class, 'ma_hop_dong', 'ma_hop_dong');
    }
}