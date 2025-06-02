<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
    'name', 'email', 'so_dien_thoai', 'dia_chi', 'cccd',
    'vai_tro', 'trang_thai', 'password',
];

}
