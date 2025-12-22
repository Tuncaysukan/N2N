<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('title_tr')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255|unique:pages,slug',
            'title_tr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_tr' => 'required|string',
            'content_en' => 'required|string',
            'meta_title_tr' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_description_tr' => 'nullable|string|max:500',
            'meta_description_en' => 'nullable|string|max:500',
            'meta_keywords_tr' => 'nullable|string|max:500',
            'meta_keywords_en' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->is_active ?? true;

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Sayfa başarıyla eklendi.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'title_tr' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_tr' => 'required|string',
            'content_en' => 'required|string',
            'meta_title_tr' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_description_tr' => 'nullable|string|max:500',
            'meta_description_en' => 'nullable|string|max:500',
            'meta_keywords_tr' => 'nullable|string|max:500',
            'meta_keywords_en' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->is_active ?? true;

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Sayfa başarıyla güncellendi.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Sayfa başarıyla silindi.');
    }
}
