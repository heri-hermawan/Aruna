<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peraturan extends Model
{
    protected $fillable = ['province_id', 'name', 'description', 'type', 'document', 'image'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
