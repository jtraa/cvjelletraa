<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvSetting extends Model
{
    protected $table = 'cv_settings';

    protected $fillable = [
        'name',
        'job_title_nl',
        'job_title_en',
        'dob',
        'address_line1',
        'address_line2',
        'availability',
        'email',
        'phone',
        'linkedin',
        'github',
        'photo',
        'profile_nl',
        'profile_en',
    ];

    /**
     * Always return (or create) the single settings row.
     */
    public static function instance(): self
    {
        return self::firstOrCreate(['id' => 1], [
            'name'          => 'Jelle Traa',
            'job_title_nl'  => 'PHP Developer',
            'job_title_en'  => 'PHP Developer',
        ]);
    }
}
