<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tradisi extends Model
{
    protected $fillable = ['province_id', 'name', 'description', 'image'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
