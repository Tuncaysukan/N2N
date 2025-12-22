<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Setting;

class BrandController extends Controller
{
    public function havaianas()
    {
        $brand = Brand::where('slug', 'havaianas')->firstOrFail();
        $brand->load('activeImages');
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('brands.havaianas', compact('brand', 'settings'));
    }

    public function newEra()
    {
        $brand = Brand::where('slug', 'new-era')->firstOrFail();
        $brand->load('activeImages');
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('brands.new-era', compact('brand', 'settings'));
    }

    public function nikeSwim()
    {
        $brand = Brand::where('slug', 'nike-swim')->firstOrFail();
        $brand->load('activeImages');
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('brands.nike-swim', compact('brand', 'settings'));
    }
}
