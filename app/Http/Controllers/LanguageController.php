<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request, string $locale)
    {
        if (! in_array($locale, ['nl', 'en'])) {
            abort(404);
        }

        session(['locale' => $locale]);

        return redirect()->back()->withHeaders([
            'Cache-Control' => 'no-store, no-cache',
        ]);
    }
}
