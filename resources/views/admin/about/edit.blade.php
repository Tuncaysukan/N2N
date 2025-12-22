@extends('admin.layouts.app')

@section('title', 'Hakkımızda Sayfası - N2N Admin')
@section('page-title', 'Hakkımızda Sayfası')

@section('content')
<div class="mb-6">
    <h3 class="text-lg font-semibold">Hakkımızda Sayfası Yönetimi</h3>
    <p class="text-gray-600 mt-1">Hakkımızda sayfası içeriğini buradan yönetebilirsiniz.</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <form action="{{ route('admin.about.update') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <!-- Türkçe İçerik -->
                <div class="border-b pb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Türkçe İçerik</h4>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="title_tr" class="block text-sm font-medium text-gray-700 mb-2">
                                Başlık (TR)
                            </label>
                            <input type="text" id="title_tr" name="title_tr" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $aboutPage->title_tr ?? '' }}">
                        </div>

                        <div>
                            <label for="content_tr" class="block text-sm font-medium text-gray-700 mb-2">
                                İçerik (TR)
                            </label>
                            <textarea id="content_tr" name="content_tr" rows="10" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $aboutPage->content_tr ?? '' }}</textarea>
                        </div>

                        <div>
                            <label for="meta_title_tr" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Başlık (TR)
                            </label>
                            <input type="text" id="meta_title_tr" name="meta_title_tr"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $aboutPage->meta_title_tr ?? '' }}"
                                placeholder="SEO başlığı">
                        </div>

                        <div>
                            <label for="meta_description_tr" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Açıklama (TR)
                            </label>
                            <textarea id="meta_description_tr" name="meta_description_tr" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="SEO açıklaması">{{ $aboutPage->meta_description_tr ?? '' }}</textarea>
                        </div>

                        <div>
                            <label for="meta_keywords_tr" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Keywords (TR)
                            </label>
                            <textarea id="meta_keywords_tr" name="meta_keywords_tr" rows="2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="anahtar1, anahtar2, anahtar3">{{ $aboutPage->meta_keywords_tr ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- İngilizce İçerik -->
                <div class="border-b pb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">İngilizce İçerik</h4>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="title_en" class="block text-sm font-medium text-gray-700 mb-2">
                                Başlık (EN)
                            </label>
                            <input type="text" id="title_en" name="title_en" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $aboutPage->title_en ?? '' }}">
                        </div>

                        <div>
                            <label for="content_en" class="block text-sm font-medium text-gray-700 mb-2">
                                İçerik (EN)
                            </label>
                            <textarea id="content_en" name="content_en" rows="10" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $aboutPage->content_en ?? '' }}</textarea>
                        </div>

                        <div>
                            <label for="meta_title_en" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Başlık (EN)
                            </label>
                            <input type="text" id="meta_title_en" name="meta_title_en"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ $aboutPage->meta_title_en ?? '' }}"
                                placeholder="SEO title">
                        </div>

                        <div>
                            <label for="meta_description_en" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Açıklama (EN)
                            </label>
                            <textarea id="meta_description_en" name="meta_description_en" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="SEO description">{{ $aboutPage->meta_description_en ?? '' }}</textarea>
                        </div>

                        <div>
                            <label for="meta_keywords_en" class="block text-sm font-medium text-gray-700 mb-2">
                                Meta Keywords (EN)
                            </label>
                            <textarea id="meta_keywords_en" name="meta_keywords_en" rows="2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="keyword1, keyword2, keyword3">{{ $aboutPage->meta_keywords_en ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Durum -->
                <div>
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ $aboutPage->is_active ? 'checked' : '' }}>
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Sayfa Aktif
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                    Kaydet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
