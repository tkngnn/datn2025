<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VanPhong extends Model
{
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

    public function toanha()
    {
        return $this->belongsTo(ToaNha::class,'ma_toa_nha', 'ma_toa_nha');
    }
}
