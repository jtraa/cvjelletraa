<?php

namespace App\Http\Controllers;

use App\Models\CvSetting;
use App\Models\Education;
use App\Models\Skill;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\App;

class CvController extends Controller
{
    public function index()
    {
        $locale   = App::getLocale();
        $settings = CvSetting::instance();
        $skills   = Skill::all();
        $education = Education::all();
        $experiences = WorkExperience::all();

        return view('cv.index', compact('locale', 'settings', 'skills', 'education', 'experiences'));
    }
}
