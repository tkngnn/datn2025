<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HenXem extends Model
{
    use HasFactory;

    protected $table = 'hen_xem';
    protected $primaryKey = 'ma_hen_xem';

    protected $fillable = [
    'ma_hen_xem', 'ho_ten', 'sdt', 'email', 'ma_van_phong',
    'ngay_hen', 'trang_thai', 'ghi_chu',];

    public function vanphong()
    {
        return $this->belongsTo(VanPhong::class, 'ma_van_phong', 'ma_van_phong');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}