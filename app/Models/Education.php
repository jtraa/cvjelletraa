<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;

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
