<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class YeuCauHoTro extends Model
{
    use SoftDeletes;

    protected $table = 'yeu_cau_ho_tro';
    protected $primaryKey = 'ma_yeu_cau';
    protected $fillable = ['user_id', 'tieu_de', 'noi_dung', 'thoi_gian_gui', 'trang_thai_xu_ly', 'ghi_chu_xu_ly'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}