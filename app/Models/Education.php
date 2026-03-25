<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';

    protected $fillable = [
        'title_nl',
        'title_en',
        'institution',
        'period',
        'learned_nl',
        'learned_en',
        'sort_order',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('sorted', fn ($q) => $q->orderBy('sort_order'));
    }
}
