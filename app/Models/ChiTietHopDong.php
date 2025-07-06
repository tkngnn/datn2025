<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChiTietHopDong extends Model
{
    use SoftDeletes;

    protected $table = 'chi_tiet_hop_dong';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['ma_hop_dong', 'ma_van_phong', 'dien_tich', 'gia_thue', 'gia_dien', 'gia_nuoc', 'dich_vu_khac'];

    public function hopDong()
    {
        return $this->belongsTo(HopDong::class, 'ma_hop_dong');
    }

    public function vanPhong()
    {
        return $this->belongsTo(VanPhong::class, 'ma_van_phong');
    }

}