<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Setting;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('order')->get();
        $settings = Setting::pluck('value', 'key')->toArray();
        $brands = Brand::where('is_active', true)->orderBy('order')->with('activeImages')->get();
        return view('home', compact('sliders', 'settings', 'brands'));
    }
}
