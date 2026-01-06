@extends('layouts.app')

@section('title', $aboutPage->{'meta_title_' . app()->getLocale()} ?? $aboutPage->{'title_' . app()->getLocale()})
@section('description', $aboutPage->{'meta_description_' . app()->getLocale()})
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
img.w-64.h-64.mx-auto.object-contain.rounded-lg {
    height: auto;
    width: auto;
}
</style>
@section('content')
@if($aboutPage)
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center">
            @if(isset($settings['site_logo']) && $settings['site_logo'])
                <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="N2N Tekstil" class="h-24 w-auto mx-auto mb-6 bg-white p-3 rounded-lg shadow-lg">
            @endif
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                {{ $aboutPage->{'title_' . app()->getLocale()} }}
            </h1>
            <div class="w-24 h-1 bg-white mx-auto"></div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="prose prose-lg max-w-none">
                    {!! $aboutPage->{'content_' . app()->getLocale()} !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Company Values Section -->
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Değerlerimiz</h2>
            <p class="text-xl text-gray-600">N2N Tekstil olarak bizi tanımlayan ilkeler</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Kalite</h3>
                <p class="text-gray-600">En yüksek kalite standartlarına uygun ürünler sunuyoruz.</p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Müşteri Odaklılık</h3>
                <p class="text-gray-600">Müşteri memnuniyetini her zaman ön planda tutuyoruz.</p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">İnovasyon</h3>
                <p class="text-gray-600">Sektördeki trendleri takip ederek yenilikçi çözümler sunuyoruz.</p>
            </div>

            <div class="text-center">
                <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Güvenilirlik</h3>
                <p class="text-gray-600">Yılların getirdiği tecrübe ve güvenilir hizmet anlayışı.</p>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">N2N Tekstil Rakamlarla</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">13+</div>
                <p class="text-gray-600">Yıllık Tecrübe</p>
            </div>

            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">3</div>
                <p class="text-gray-600">Premium Marka</p>
            </div>

            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">1000+</div>
                <p class="text-gray-600">Mutlu Müşteri</p>
            </div>

            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">100%</div>
                <p class="text-gray-600">Orijinal Ürün</p>
            </div>
        </div>
    </div>
</section>
@endsection
