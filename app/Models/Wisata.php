<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;

class Wisata extends Model
{
    protected $fillable = ['province_id', 'name', 'description', 'image', 'daya_tarik', 'populer', 'harga', 'fasilitas', 'kebersihan'];
    
    // protected $casts = [
    //     'price' => 'decimal:2',
    // ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get all wisata with optional province filter
     */
    public static function getAllWisata($provinceId = null): Collection
    {
        if ($provinceId) {
            return self::where('province_id', $provinceId)->get();
        }
        return self::all();
    }
}
