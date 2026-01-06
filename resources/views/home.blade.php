@extends('layouts.app')

@section('title', __('messages.site_title'))
@section('description', __('messages.site_description'))
<style>
    .slider-slide.active .slider-button {
    opacity: 1;
    transform: translateY(0);
    display: none;
}
img.h-16.md\:h-24.mb-4.drop-shadow-lg.object-contain {
    height: 57%;
}
img.h-8.w-auto.mr-2 {
    height: 70px;
    width: 68px;
}
</style>

@section('content')
<!-- Cache cleared: {{ time() }} -->
<!-- Slider Section -->
@if($sliders->count() > 0)
<section class="relative h-96 md:h-[500px] overflow-hidden bg-gray-900">
    <div id="slider" class="slider-container">
        @foreach($sliders as $index => $slider)
            <div class="slider-slide {{ $index === 0 ? 'active' : '' }} h-96 md:h-[500px] bg-gradient-to-r from-blue-600 to-blue-800">
                @if($slider->image_path)
                    <img src="{{ asset('storage/' . $slider->image_path) }}"
                         alt="{{ $slider->{'title_' . app()->getLocale()} }}"
                         class="absolute inset-0 w-full h-full object-cover"
                         loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/40 to-transparent"></div>
                @endif
                <div class="slider-content absolute inset-0 z-10 container mx-auto px-4 h-full flex items-center">
                    <div class="text-white max-w-2xl">
                        @php
                            $logoUrl = null;
                            $slug = null;
                            if (!empty($slider->button_link)) {
                                $path = parse_url($slider->button_link, PHP_URL_PATH);
                                $segments = $path ? explode('/', trim($path, '/')) : [];
                                if (count($segments) >= 2 && $segments[0] === 'brands') {
                                    $slug = $segments[1];
                                }
                            }
                            $brandObj = $slug ? $brands->firstWhere('slug', $slug) : null;
                            if ($brandObj) {
                                if (!empty($brandObj->image)) {
                                    $logoUrl = asset('storage/' . $brandObj->image);
                                } elseif ($brandObj->activeImages->count() > 0) {
                                    $logoUrl = asset('storage/' . $brandObj->activeImages->first()->image_path);
                                }
                            }
                        @endphp
                        @if($logoUrl)
                            <img src="{{ $logoUrl }}" alt="{{ $brandObj?->name ?? $slider->{'title_' . app()->getLocale()} }}" class="h-16 md:h-24 mb-4 drop-shadow-lg object-contain">
                        @elseif($slug)
                            <h1 class="slider-title text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">
                                {{ $slider->{'title_' . app()->getLocale()} }}
                            </h1>
                            @if($slider->{'subtitle_' . app()->getLocale()})
                                <p class="slider-subtitle text-xl md:text-2xl mb-6 drop-shadow-md">{{ $slider->{'subtitle_' . app()->getLocale()} }}</p>
                            @endif
                        @endif
                        @if($slider->button_link)
                            <a href="{{ $slider->button_link }}"
                               class="slider-button inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-all duration-300 shadow-lg">
                                {{ $slider->{'button_text_' . app()->getLocale()} ?? __('messages.explore_brand') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Progress Bar -->
    <div id="slider-progress" class="slider-progress" style="width: 0%;"></div>

    @if($sliders->count() > 1)
    <!-- Slider Dots -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
        @foreach($sliders as $index => $slider)
            <button class="slider-dot w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white active' : 'bg-white/50' }} hover:bg-white shadow-md" data-slide="{{ $index }}"></button>
        @endforeach
    </div>

    <!-- Prev/Next Buttons (Removed as requested) -->
    <!--
    <button id="slider-prev" class="slider-nav-btn absolute left-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full shadow-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button id="slider-next" class="slider-nav-btn absolute right-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full shadow-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
    -->
    @endif
</section>
@else
<!-- Default Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    {{ __('messages.new_era_title') }}
                </h1>
                <p class="text-xl mb-8">
                    {{ __('messages.new_era_subtitle') }}
                </p>
                <p class="text-lg mb-8 opacity-90">
                    {{ __('messages.new_era_description') }}
                </p>
                <a href="{{ route('brands.new_era') }}"
                   class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    {{ __('messages.explore_brand') }}
                </a>
            </div>
            <div class="text-center">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-8">
                    <div class="w-32 h-32 mx-auto bg-white rounded-full flex items-center justify-center">
                        <span class="text-3xl font-bold text-blue-600">NE</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Our Brands Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                {{ __('messages.our_brands') }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ __('messages.brands_description') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($brands as $brand)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                <div class="h-48 relative">
                    @if($brand->activeImages->count() > 0)
                        <img src="{{ asset('storage/' . $brand->activeImages->first()->image_path) }}"
                             alt="{{ $brand->name }}"
                             class="w-full h-full object-cover">
                    @elseif($brand->image)
                        <img src="{{ asset('storage/' . $brand->image) }}"
                             alt="{{ $brand->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="h-full bg-gradient-to-br
                            @if($brand->slug == 'havaianas') from-yellow-400 to-orange-500
                            @elseif($brand->slug == 'new-era') from-red-500 to-red-700
                            @elseif($brand->slug == 'nike-swim') from-green-500 to-green-700
                            @else from-blue-500 to-blue-700
                            @endif
                            flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-4xl font-bold mb-2">
                                    @if($brand->slug == 'havaianas') H
                                    @elseif($brand->slug == 'new-era') NE
                                    @elseif($brand->slug == 'nike-swim') NS
                                    @else {{ strtoupper(substr($brand->name, 0, 2)) }}
                                    @endif
                                </div>
                                <div class="text-lg">{{ $brand->name }}</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-3">{{ $brand->name }}</h3>
                    <p class="text-gray-600 mb-4">
                        {{ $brand->{'short_desc_' . app()->getLocale()} }}
                    </p>
                    <a href="{{ route('brands.show', $brand->slug) }}"
                       class="inline-block text-blue-600 font-semibold hover:text-blue-700">
                        {{ __('messages.explore_brand') }} →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Features Section -->
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Kalite Garantisi</h3>
                <p class="text-gray-600">Tüm ürünlerimiz orijinal ve kalite garantilidir.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Hızlı Teslimat</h3>
                <p class="text-gray-600">Siparişlerinizi en kısa sürede teslim ediyoruz.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Müşteri Desteği</h3>
                <p class="text-gray-600">7/24 müşteri hizmetleri desteği sağlıyoruz.</p>
            </div>
        </div>
    </div>
</section>
@endsection
