<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VanPhong extends Model
{
    use SoftDeletes ;
    use HasFactory;

    protected $table = 'van_phong';
    protected $primaryKey = 'ma_van_phong';

    protected $fillable = [
        'ma_van_phong',
        'ten_van_phong',
        'ma_toa_nha',
        'dien_tich',
        'gia_thue',
        'mo_ta',
        'tien_ich',
        'trang_thai',
    ];

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