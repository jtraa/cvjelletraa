<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $fillable = [
        'period',
        'company',
        'description_nl',
        'description_en',
        'url',
        'tech_stack',
        'sort_order',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('sorted', fn ($q) => $q->orderBy('sort_order'));
    }
}
