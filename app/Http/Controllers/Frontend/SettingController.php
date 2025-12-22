<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public static function getSettings()
    {
        return Setting::pluck('value', 'key')->toArray();
    }
}
