@extends('admin.layouts.app')

@section('title', 'Site Ayarları - N2N Admin')
@section('page-title', 'Site Ayarları')

@section('content')
<div class="mb-6">
    <h3 class="text-lg font-semibold">Site Genel Ayarları</h3>
    <p class="text-gray-600 mt-1">Site genel ayarlarını buradan yönetebilirsiniz.</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Site Bilgileri -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-800 border-b pb-2">Site Bilgileri</h4>
                    
                    <div>
                        <label for="site_title_tr" class="block text-sm font-medium text-gray-700 mb-2">
                            Site Başlığı (Türkçe)
                        </label>
                        <input type="text" id="site_title_tr" name="site_title_tr"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $settings['site_title_tr'] ?? 'N2N Tekstil' }}">
                    </div>

                    <div>
                        <label for="site_title_en" class="block text-sm font-medium text-gray-700 mb-2">
                            Site Başlığı (İngilizce)
                        </label>
                        <input type="text" id="site_title_en" name="site_title_en"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $settings['site_title_en'] ?? 'N2N Tekstil' }}">
                    </div>

                    <div>
                        <label for="site_description_tr" class="block text-sm font-medium text-gray-700 mb-2">
                            Site Açıklaması (Türkçe)
                        </label>
                        <textarea id="site_description_tr" name="site_description_tr" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $settings['site_description_tr'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label for="site_description_en" class="block text-sm font-medium text-gray-700 mb-2">
                            Site Açıklaması (İngilizce)
                        </label>
                        <textarea id="site_description_en" name="site_description_en" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $settings['site_description_en'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-2">
                            Site Logosu
                        </label>
                        @if($settings['site_logo'] ?? false)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Site Logo" class="h-16 w-auto">
                            </div>
                        @endif
                        <input type="file" id="site_logo" name="site_logo"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            accept="image/*">
                        <p class="text-sm text-gray-500 mt-1">JPEG, PNG, JPG formatlarında. Maksimum 2MB.</p>
                    </div>
                </div>

                <!-- İletişim Bilgileri -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-800 border-b pb-2">İletişim Bilgileri</h4>
                    
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                            İletişim E-postası
                        </label>
                        <input type="email" id="contact_email" name="contact_email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $settings['contact_email'] ?? 'info@n2n.com.tr' }}">
                    </div>

                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">
                            İletişim Telefonu
                        </label>
                        <input type="tel" id="contact_phone" name="contact_phone"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $settings['contact_phone'] ?? '+90 212 555 0123' }}">
                    </div>

                    <div>
                        <label for="contact_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Adres
                        </label>
                        <textarea id="contact_address" name="contact_address" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $settings['contact_address'] ?? 'İstanbul, Türkiye' }}</textarea>
                    </div>

                    <div>
                        <label for="map_coordinates" class="block text-sm font-medium text-gray-700 mb-2">
                            Harita Konumu (Google Maps Embed)
                        </label>
                        <textarea id="map_coordinates" name="map_coordinates" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Google Maps embed URL...">{{ $settings['map_coordinates'] ?? '' }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Google Maps embed URL'sini buraya yapıştırın.</p>
                    </div>

                    <div>
                        <label for="social_facebook" class="block text-sm font-medium text-gray-700 mb-2">
                            Facebook URL
                        </label>
                        <input type="url" id="social_facebook" name="social_facebook"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $settings['social_facebook'] ?? '' }}"
                            placeholder="https://facebook.com/...">
                    </div>

                    <div>
                        <label for="social_instagram" class="block text-sm font-medium text-gray-700 mb-2">
                            Instagram URL
                        </label>
                        <input type="url" id="social_instagram" name="social_instagram"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ $settings['social_instagram'] ?? '' }}"
                            placeholder="https://instagram.com/...">
                    </div>
                </div>
            </div>

            <!-- SEO Ayarları -->
            <div class="mt-8 space-y-4">
                <h4 class="text-lg font-semibold text-gray-800 border-b pb-2">SEO Ayarları</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="meta_keywords_tr" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Keywords (Türkçe)
                        </label>
                        <textarea id="meta_keywords_tr" name="meta_keywords_tr" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="anahtar1, anahtar2, anahtar3">{{ $settings['meta_keywords_tr'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label for="meta_keywords_en" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Keywords (İngilizce)
                        </label>
                        <textarea id="meta_keywords_en" name="meta_keywords_en" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="keyword1, keyword2, keyword3">{{ $settings['meta_keywords_en'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                    Ayarları Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
