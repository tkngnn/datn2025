<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HenXem extends Model
{
    use SoftDeletes;

    protected $table = 'hen_xem';
    protected $primaryKey = 'ma_hen_xem';
    protected $fillable = ['ho_ten', 'sdt', 'email', 'ma_van_phong', 'ngay_hen', 'ghi_chu', 'trang_thai'];

    public function vanPhong()
    {
        return $this->belongsTo(VanPhong::class, 'ma_van_phong');
    }
}