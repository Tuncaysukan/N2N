<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\BrandImage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('order')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug',
            'description_tr' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $data = $request->except(['image', 'is_active']);
        $data['is_active'] = $request->is_active ?? true;
        $data['order'] = $request->order ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('brands', 'public');
        }

        $brand = Brand::create($data);

        return redirect()->route('admin.brands.index')->with('success', 'Marka başarıyla eklendi.');
    }

    public function edit(Brand $brand)
    {
        $brand->load('images');
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands,slug,' . $brand->id,
            'description_tr' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $data = $request->except(['image', 'is_active']);
        $data['is_active'] = $request->is_active ?? true;
        $data['order'] = $request->order ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('brands', 'public');
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', 'Marka başarıyla güncellendi.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Marka başarıyla silindi.');
    }

    // Brand Image Management
    public function addImage(Request $request, Brand $brand)
    {
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_tr' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $data = $request->except(['image_path', 'is_active']);
        $data['brand_id'] = $brand->id;
        $data['image_path'] = $request->file('image_path')->store('brand_images', 'public');
        $data['is_active'] = $request->is_active ?? true;
        $data['order'] = $request->order ?? 0;

        BrandImage::create($data);

        return redirect()->back()->with('success', 'Görsel başarıyla eklendi.');
    }

    public function updateImage(Request $request, Brand $brand, BrandImage $brandImage)
    {
        $request->validate([
            'title_tr' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $data = $request->except(['is_active']);
        $data['is_active'] = $request->is_active ?? true;
        $data['order'] = $request->order ?? 0;

        $brandImage->update($data);

        return redirect()->back()->with('success', 'Görsel başarıyla güncellendi.');
    }

    public function deleteImage(Brand $brand, BrandImage $brandImage)
    {
        $brandImage->delete();
        return redirect()->back()->with('success', 'Görsel başarıyla silindi.');
    }
}
