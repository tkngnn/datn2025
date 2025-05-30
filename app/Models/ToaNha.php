<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToaNha extends Model
{
    use SoftDeletes;

    protected $table = 'toa_nha';
    protected $primaryKey = 'ma_toa_nha';
    protected $fillable = ['ten_toa_nha', 'dia_chi', 'mo_ta', 'so_tang', 'trang_thai'];

    public function vanPhongs()
    {
        return $this->hasMany(VanPhong::class, 'ma_toa_nha');
    }
}