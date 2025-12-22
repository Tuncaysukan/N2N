@extends('admin.layouts.app')

@section('title', 'Marka Düzenle - N2N Admin')
@section('page-title', 'Marka Düzenle')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="bg-white shadow rounded-lg mb-6">
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

                @if($brand->image)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Logo</label>
                        <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}" class="h-20 w-20 object-cover rounded">
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Marka Adı <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('name', $brand->name) }}">
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            Slug <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="slug" name="slug" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="marka-adi"
                            value="{{ old('slug', $brand->slug) }}">
                        <p class="text-sm text-gray-500 mt-1">URL için kullanılacak benzersiz kimlik</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="description_tr" class="block text-sm font-medium text-gray-700 mb-2">
                            Açıklama (Türkçe) <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description_tr" name="description_tr" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description_tr', $brand->description_tr) }}</textarea>
                    </div>

                    <div>
                        <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">
                            Açıklama (İngilizce) <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description_en" name="description_en" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description_en', $brand->description_en) }}</textarea>
                    </div>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Marka Logosu (Değiştirmek için yeni dosya seçin)
                    </label>
                    <input type="file" id="image" name="image"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        accept="image/*">
                    <p class="text-sm text-gray-500 mt-1">JPEG, PNG, JPG, GIF formatlarında. Maksimum 2MB.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                            Sıra No
                        </label>
                        <input type="number" id="order" name="order" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('order', $brand->order) }}">
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ $brand->is_active ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg">
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.brands.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        İptal
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Marka Güncelle
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Marka Görselleri -->
    <div class="bg-white shadow rounded-lg">
        <div class="p-6 border-b">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold">Marka Görselleri</h3>
                <button onclick="document.getElementById('imageUpload').showModal()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Yeni Görsel Ekle
                </button>
            </div>
        </div>
        
        <div class="p-6">
            @if($brand->images->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($brand->images as $image)
                        <div class="border rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title_tr ?? '' }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h4 class="font-medium text-gray-900 mb-2">{{ $image->title_tr ?? 'Başlıksız' }}</h4>
                                <p class="text-sm text-gray-600 mb-3">{{ Str::limit($image->description_tr ?? '', 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs {{ $image->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2 py-1 rounded">
                                        {{ $image->is_active ? 'Aktif' : 'Pasif' }}
                                    </span>
                                    <div class="space-x-2">
                                        <button onclick="editImage({{ $image->id }})" class="text-blue-600 hover:text-blue-900 text-sm">Düzenle</button>
                                        <form action="{{ route('admin.brands.images.delete', [$brand, $image]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Bu görseli silmek istediğinizden emin misiniz?')">Sil</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Henüz görsel eklenmemiş.</p>
            @endif
        </div>
    </div>
</div>

<!-- Görsel Ekleme Modal -->
<dialog id="imageUpload" class="modal">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <h3 class="text-lg font-semibold mb-4">Yeni Görsel Ekle</h3>
        <form action="{{ route('admin.brands.images.add', $brand) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="image_path" class="block text-sm font-medium text-gray-700 mb-2">
                        Görsel <span class="text-red-500">*</span>
                    </label>
                    <input type="file" id="image_path" name="image_path" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        accept="image/*">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="title_tr" class="block text-sm font-medium text-gray-700 mb-2">Başlık (TR)</label>
                        <input type="text" id="title_tr" name="title_tr" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700 mb-2">Başlık (EN)</label>
                        <input type="text" id="title_en" name="title_en" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="description_tr" class="block text-sm font-medium text-gray-700 mb-2">Açıklama (TR)</label>
                        <textarea id="description_tr" name="description_tr" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                    </div>
                    <div>
                        <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">Açıklama (EN)</label>
                        <textarea id="description_en" name="description_en" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Sıra</label>
                        <input type="number" id="order" name="order" min="0" value="0" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" checked class="h-4 w-4 text-blue-600">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" onclick="document.getElementById('imageUpload').close()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    İptal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Ekle
                </button>
            </div>
        </form>
    </div>
</dialog>
@endsection
