<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\HopDong;
use App\Models\YeuCauHoTro;
use App\Models\HoaDon;
use App\Models\LichSuCoc; 

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'so_dien_thoai',
        'dia_chi',
        'cccd',
        'vai_tro',
        'trang_thai',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function isAdmin(): bool
    {
        return $this->vai_tro === 'admin';
    }
    
    public function isUser(): bool
    {
        return $this->vai_tro === 'KT';
    }
    /**
     * Quan hệ: Một người dùng có nhiều hợp đồng.
     */
    public function hopDongs(): HasMany
    {
        return $this->hasMany(HopDong::class, 'user_id');
    }

    /**
     * Quan hệ: Một người dùng có nhiều yêu cầu hỗ trợ.
     */
    public function yeuCauHoTros(): HasMany
    {
        return $this->hasMany(YeuCauHoTro::class, 'user_id');
    }

    /**
     * Nếu muốn lấy tất cả hóa đơn thông qua các hợp đồng.
     */
    public function hoaDons()
    {
        return $this->hasManyThrough(
            HoaDon::class,
            HopDong::class,
            'user_id',         // Khóa ngoại trên bảng hop_dong
            'ma_hop_dong',     // Khóa ngoại trên bảng hoa_don
            'id',              // Khóa chính bảng users
            'ma_hop_dong'      // Khóa chính bảng hop_dong
        );
    }

    /**
     * Nếu muốn lấy tất cả lịch sử cọc thông qua hợp đồng.
     */
    public function lichSuCocs()
    {
        return $this->hasManyThrough(
            LichSuCoc::class,
            HopDong::class,
            'user_id',
            'ma_hop_dong',
            'id',
            'ma_hop_dong'
        );
    } 
}