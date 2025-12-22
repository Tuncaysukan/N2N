@extends('admin.layouts.app')

@section('title', 'Dashboard - N2N Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Markalar</p>
                <p class="text-2xl font-bold">{{ $brandsCount }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center">
            <div class="bg-green-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Okunmamış Mesajlar</p>
                <p class="text-2xl font-bold">{{ $messagesCount }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center">
            <div class="bg-purple-100 p-3 rounded-full">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">Sayfalar</p>
                <p class="text-2xl font-bold">{{ $pagesCount }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <h3 class="text-lg font-semibold">Son Mesajlar</h3>
    </div>
    <div class="p-6">
        @if($recentMessages->count() > 0)
            <div class="space-y-4">
                @foreach($recentMessages as $message)
                    <div class="border-l-4 {{ $message->is_read ? 'border-gray-300' : 'border-blue-500' }} pl-4 py-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold">{{ $message->name }}</p>
                                <p class="text-sm text-gray-600">{{ $message->email }}</p>
                                <p class="text-sm mt-1">{{ Str::limit($message->message, 100) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">{{ $message->created_at->format('d.m.Y H:i') }}</p>
                                @if(!$message->is_read)
                                    <span class="inline-block mt-1 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Yeni</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Henüz mesaj bulunmuyor.</p>
        @endif
    </div>
</div>
@endsection
