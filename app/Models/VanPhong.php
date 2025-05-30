<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VanPhong extends Model
{
    use SoftDeletes;

    protected $table = 'van_phong';
    protected $primaryKey = 'ma_van_phong';
    protected $fillable = ['ma_toa_nha', 'dien_tich', 'gia_thue', 'mo_ta', 'tien_ich', 'trang_thai'];

    public function toaNha()
    {
        return $this->belongsTo(ToaNha::class, 'ma_toa_nha');
    }

    public function chiTietHopDongs()
    {
        return $this->hasMany(ChiTietHopDong::class, 'ma_van_phong');
    }

    public function henXems()
    {
        return $this->hasMany(HenXem::class, 'ma_van_phong');
    }
}