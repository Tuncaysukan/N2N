<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Message;
use App\Models\Page;

class DashboardController extends Controller
{
    public function index()
    {
        $brandsCount = Brand::count();
        $messagesCount = Message::where('is_read', false)->count();
        $pagesCount = Page::count();
        $recentMessages = Message::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'brandsCount', 
            'messagesCount', 
            'pagesCount', 
            'recentMessages'
        ));
    }
}
