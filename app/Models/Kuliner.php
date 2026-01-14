<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;

class Kuliner extends Model
{
    protected $fillable = ['province_id', 'name', 'description', 'price', 'image', 'rasa', 'populer', 'gizi', 'biaya', 'porsi'];
    
    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get all kuliner with optional province filter
     */
    public static function getAllKuliner($provinceId = null): Collection
    {
        if ($provinceId) {
            return self::where('province_id', $provinceId)->get();
        }
        return self::all();
    }
}
