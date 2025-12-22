<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;

class AboutPageController extends Controller
{
    public function edit()
    {
        $aboutPage = AboutPage::firstOrCreate(['id' => 1]);
        return view('admin.about.edit', compact('aboutPage'));
    }

    public function update(Request $request)
    {
        $aboutPage = AboutPage::firstOrCreate(['id' => 1]);
        
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_tr' => 'required|string',
            'content_en' => 'required|string',
            'meta_title_tr' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_description_tr' => 'nullable|string|max:500',
            'meta_description_en' => 'nullable|string|max:500',
            'meta_keywords_tr' => 'nullable|string',
            'meta_keywords_en' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $aboutPage->update($validated);

        return redirect()->route('admin.about.edit')->with('success', 'Hakkımızda sayfası başarıyla güncellendi.');
    }
}
