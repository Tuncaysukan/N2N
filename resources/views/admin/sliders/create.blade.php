@extends('admin.layouts.app')

@section('title', 'Yeni Slider - N2N Admin')
@section('page-title', 'Yeni Slider Ekle')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="bg-white shadow rounded-lg">
            <div class="p-6 space-y-6">
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_tr" class="block text-sm font-medium text-gray-700 mb-2">
                            Başlık (Türkçe)
                        </label>
                        <input type="text" id="title_tr" name="title_tr"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('title_tr') }}">
                    </div>

                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700 mb-2">
                            Başlık (İngilizce)
                        </label>
                        <input type="text" id="title_en" name="title_en"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('title_en') }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="subtitle_tr" class="block text-sm font-medium text-gray-700 mb-2">
                            Alt Başlık (Türkçe)
                        </label>
                        <textarea id="subtitle_tr" name="subtitle_tr" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('subtitle_tr') }}</textarea>
                    </div>

                    <div>
                        <label for="subtitle_en" class="block text-sm font-medium text-gray-700 mb-2">
                            Alt Başlık (İngilizce)
                        </label>
                        <textarea id="subtitle_en" name="subtitle_en" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('subtitle_en') }}</textarea>
                    </div>
                </div>

                <div>
                    <label for="image_path" class="block text-sm font-medium text-gray-700 mb-2">
                        Görsel <span class="text-red-500">*</span>
                    </label>
                    <input type="file" id="image_path" name="image_path" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        accept="image/*">
                    <p class="text-sm text-gray-500 mt-1">JPEG, PNG, JPG, GIF formatlarında. Maksimum 2MB.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="button_text_tr" class="block text-sm font-medium text-gray-700 mb-2">
                            Buton Metni (Türkçe)
                        </label>
                        <input type="text" id="button_text_tr" name="button_text_tr"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('button_text_tr') }}">
                    </div>

                    <div>
                        <label for="button_text_en" class="block text-sm font-medium text-gray-700 mb-2">
                            Buton Metni (İngilizce)
                        </label>
                        <input type="text" id="button_text_en" name="button_text_en"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('button_text_en') }}">
                    </div>
                </div>

                <div>
                    <label for="button_link" class="block text-sm font-medium text-gray-700 mb-2">
                        Buton Linki
                    </label>
                    <input type="text" id="button_link" name="button_link"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="https://ornek.com"
                        value="{{ old('button_link') }}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                            Sıra No
                        </label>
                        <input type="number" id="order" name="order" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('order', 0) }}">
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" checked
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg">
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.sliders.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        İptal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Slider Ekle
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
