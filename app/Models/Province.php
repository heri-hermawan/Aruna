<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = ['name', 'code', 'image', 'description'];

    public function tradisis(): HasMany
    {
        return $this->hasMany(Tradisi::class);
    }

    public function peraturans(): HasMany
    {
        return $this->hasMany(Peraturan::class);
    }

    public function wisatas(): HasMany
    {
        return $this->hasMany(Wisata::class);
    }

    public function kuliners(): HasMany
    {
        return $this->hasMany(Kuliner::class);
    }

    public function getIconAttribute(): string
    {
        $icons = [
            'Aceh' => '🕌',
            'Bali' => '🏯',
            'Banten' => '🏰',
            'Bengkulu' => '🌺',
            'DI Yogyakarta' => '⛩️',
            'DKI Jakarta' => '🗼',
            'Gorontalo' => '🏖️',
            'Jambi' => '🛕',
            'Jawa Barat' => '🏛️',
            'Jawa Tengah' => '⛰️',
            'Jawa Timur' => '🌋',
            'Kalimantan Barat' => '🌍',
            'Kalimantan Selatan' => '🛶',
            'Kalimantan Tengah' => '🌴',
            'Kalimantan Timur' => '🦧',
            'Kalimantan Utara' => '🌲',
            'Kepulauan Bangka Belitung' => '🏖️',
            'Kepulauan Riau' => '⚓',
            'Lampung' => '🐘',
            'Maluku' => '🏝️',
            'Maluku Utara' => '🦜',
            'Nusa Tenggara Barat' => '🏔️',
            'Nusa Tenggara Timur' => '🦎',
            'Papua' => '🦅',
            'Papua Barat' => '🐠',
            'Papua Barat Daya' => '🌊',
            'Papua Pegunungan' => '⛰️',
            'Papua Selatan' => '🌿',
            'Papua Tengah' => '🏞️',
            'Riau' => '🛢️',
            'Sulawesi Barat' => '☕',
            'Sulawesi Selatan' => '⛵',
            'Sulawesi Tengah' => '🦀',
            'Sulawesi Tenggara' => '🏖️',
            'Sulawesi Utara' => '🤿',
            'Sumatera Barat' => '🕰️',
            'Sumatera Selatan' => '🌉',
            'Sumatera Utara' => '🏞️',
        ];

        return $icons[$this->name] ?? '🏝️';
    }
}
