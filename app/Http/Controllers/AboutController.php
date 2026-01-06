<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Setting;

class AboutController extends Controller
{
    public function index()
    {
        $aboutPage = AboutPage::where('is_active', true)->first();
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('pages.about', compact('aboutPage', 'settings'));
    }
}
