<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wisata extends Model
{
    protected $fillable = ['province_id', 'name', 'description', 'image'];
    
    // protected $casts = [
    //     'price' => 'decimal:2',
    // ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
