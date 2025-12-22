@extends('layouts.app')

@section('title', $brand->{'name'} . ' - N2N Tekstil')
@section('description', $brand->{'description_' . app()->getLocale()})

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-red-500 to-red-700 text-white py-20 relative">
    @if($brand->activeImages->count() > 0)
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('storage/' . $brand->activeImages->first()->image_path) }}" 
                 alt="{{ $brand->name }}" 
                 class="w-full h-full object-cover blur-lg opacity-30">
        </div>
    @endif
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    {{ $brand->{'name'} }}
                </h1>
                <p class="text-xl mb-8">
                    {{ $brand->{'description_' . app()->getLocale()} }}
                </p>
                <a href="{{ route('contact') }}" class="inline-block bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    {{ __('messages.contact_us') }}
                </a>
            </div>
            <div class="text-center">
                @if($brand->image)
                    <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="w-64 h-64 mx-auto object-cover rounded-lg">
                @else
                    <div class="w-64 h-64 mx-auto bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center">
                        <span class="text-3xl font-bold text-white">NE</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Brand Images Gallery -->
@if($brand->activeImages->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            {{ __('messages.product_gallery') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($brand->activeImages as $image)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                         alt="{{ $image->{'title_' . app()->getLocale()} ?? $brand->name }}" 
                         class="w-full h-64 object-cover">
                    <div class="p-6">
                        @if($image->{'title_' . app()->getLocale()})
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                {{ $image->{'title_' . app()->getLocale()} }}
                            </h3>
                        @endif
                        @if($image->{'description_' . app()->getLocale()})
                            <p class="text-gray-600">
                                {{ $image->{'description_' . app()->getLocale()} }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- About Brand -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-6">
                    {{ __('messages.about_brand') }}
                </h2>
                <p class="text-lg text-gray-600 mb-6">
                    {{ $brand->{'description_' . app()->getLocale()} }}
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-red-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-red-800 mb-2">{{ __('messages.quality') }}</h4>
                        <p class="text-red-600">{{ __('messages.quality_description') }}</p>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-orange-800 mb-2">{{ __('messages.innovation') }}</h4>
                        <p class="text-orange-600">{{ __('messages.innovation_description') }}</p>
                    </div>
                </div>
            </div>
            <div>
                @if($brand->activeImages->count() > 0)
                    <img src="{{ asset('storage/' . $brand->activeImages->first()->image_path) }}" 
                         alt="{{ $brand->name }}" 
                         class="w-full h-96 object-cover rounded-lg shadow-xl">
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            {{ __('messages.interested_in_products') }}
        </h2>
        <p class="text-xl text-gray-600 mb-8">
            {{ __('messages.contact_for_info') }}
        </p>
        <a href="{{ route('contact') }}" class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition">
            {{ __('messages.contact_now') }}
        </a>
    </div>
</section>
@endsection
