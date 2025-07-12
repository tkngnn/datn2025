<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mau extends Model
{
    protected $table = 'maus';
    protected $fillable = [
        'ten_mau',
        'phien_ban',
        'noi_dung',
    ];
}
