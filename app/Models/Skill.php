<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_nl',
        'category_en',
        'items',
        'sort_order',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('sorted', fn ($q) => $q->orderBy('sort_order'));
    }
}
