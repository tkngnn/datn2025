<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

class VanPhong extends Model implements HasMedia
{
    use SoftDeletes ;
    use HasFactory, InteractsWithMedia;

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
        'slug',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('anh_van_phong')
             ->useDisk('public');
    }

    public function toaNha()
    {
        return $this->belongsTo(ToaNha::class, 'ma_toa_nha');
    }

    public function chiTietHopDongs()
    {
        return $this->hasMany(ChiTietHopDong::class, 'ma_van_phong');
    }

    public function hopDongs()
    {
        return $this->belongsToMany(HopDong::class, 'chi_tiet_hop_dong', 'ma_van_phong', 'ma_hop_dong')
            ->withTimestamps()
            ->withPivot(['dien_tich', 'gia_thue']);
    }
    public function henXems()
    {
        return $this->hasMany(HenXem::class, 'ma_van_phong');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($vanphong) {
            $slug = Str::slug($vanphong->ten_van_phong);
            $originalSlug = $slug;
            $count = 1;

            while (VanPhong::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $vanphong->slug = $slug;
        });
        
        static::updating(function ($vanphong) {
            if ($vanphong->isDirty('ten_van_phong')) {
                $slug = Str::slug($vanphong->ten_van_phong);
                $originalSlug = $slug;
                $count = 1;

                while (VanPhong::where('slug', $slug)->where('ma_van_phong', '!=', $vanphong->ma_van_phong)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }

                $vanphong->slug = $slug;
            }
        });
    }
}