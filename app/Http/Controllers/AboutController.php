<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;

class AboutController extends Controller
{
    public function index()
    {
        $aboutPage = AboutPage::where('is_active', true)->first();
        return view('pages.about', compact('aboutPage'));
    }
}
