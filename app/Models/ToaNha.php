<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToaNha extends Model
{
    protected $table = 'toa_nha';
    
    protected $fillable = ['ten_toa_nha'];

    public function vanphongs()
    {
        return $this->hasMany(VanPhong::class,'ma_toa_nha', 'ma_toa_nha');
    }
}
