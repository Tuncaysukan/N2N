<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Brand;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_tr' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'subtitle_tr' => 'nullable|string',
            'subtitle_en' => 'nullable|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text_tr' => 'nullable|string|max:255',
            'button_text_en' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $derivedTitle = '';
        if ($request->filled('button_link')) {
            $path = parse_url($request->button_link, PHP_URL_PATH);
            $segments = $path ? explode('/', trim((string) $path, '/')) : [];
            if (count($segments) >= 2 && $segments[0] === 'brands') {
                $slug = $segments[1];
                $brand = Brand::where('slug', $slug)->first();
                if ($brand) {
                    $derivedTitle = $brand->name;
                }
            }
        }

        $imagePath = $request->file('image_path')->store('sliders', 'public');

        Slider::create([
            'title_tr' => $request->title_tr ?? $derivedTitle ?? '',
            'title_en' => $request->title_en ?? $derivedTitle ?? '',
            'subtitle_tr' => $request->subtitle_tr,
            'subtitle_en' => $request->subtitle_en,
            'image_path' => $imagePath,
            'button_text_tr' => $request->button_text_tr,
            'button_text_en' => $request->button_text_en,
            'button_link' => $request->button_link,
            'is_active' => $request->is_active ?? true,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider başarıyla eklendi.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title_tr' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'subtitle_tr' => 'nullable|string',
            'subtitle_en' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text_tr' => 'nullable|string|max:255',
            'button_text_en' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $derivedTitle = '';
        if ($request->filled('button_link')) {
            $path = parse_url($request->button_link, PHP_URL_PATH);
            $segments = $path ? explode('/', trim((string) $path, '/')) : [];
            if (count($segments) >= 2 && $segments[0] === 'brands') {
                $slug = $segments[1];
                $brand = Brand::where('slug', $slug)->first();
                if ($brand) {
                    $derivedTitle = $brand->name;
                }
            }
        }

        $data = [
            'title_tr' => ($request->title_tr ?? $slider->title_tr ?? $derivedTitle ?? ''),
            'title_en' => ($request->title_en ?? $slider->title_en ?? $derivedTitle ?? ''),
            'subtitle_tr' => $request->subtitle_tr,
            'subtitle_en' => $request->subtitle_en,
            'button_text_tr' => $request->button_text_tr,
            'button_text_en' => $request->button_text_en,
            'button_link' => $request->button_link,
            'is_active' => $request->is_active ?? true,
            'order' => $request->order ?? 0,
        ];

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider başarıyla güncellendi.');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider başarıyla silindi.');
    }
}
