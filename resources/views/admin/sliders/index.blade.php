@extends('admin.layouts.app')

@section('title', 'Slider Yönetimi - N2N Admin')
@section('page-title', 'Slider Yönetimi')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-lg font-semibold">Slider Listesi</h3>
    <a href="{{ route('admin.sliders.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Yeni Slider Ekle
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Görsel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Başlık (TR)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Başlık (EN)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sıra</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if($sliders->count() > 0)
                    @foreach($sliders as $slider)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($slider->image_path)
                                    <img src="{{ asset('storage/' . $slider->image_path) }}" alt="{{ $slider->title_tr }}" class="h-16 w-24 object-cover rounded">
                                @else
                                    <div class="h-16 w-24 bg-gray-200 rounded flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">Görsel Yok</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $slider->title_tr }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $slider->title_en }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($slider->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Pasif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $slider->order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.sliders.edit', $slider) }}" class="text-blue-600 hover:text-blue-900 mr-3">Düzenle</a>
                                <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Bu slider\'ı silmek istediğinizden emin misiniz?')">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Henüz slider eklenmemiş.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
