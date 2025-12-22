<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - N2N Tekstil')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-xl font-bold">N2N Admin</h1>
            </div>
            <nav class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.brands.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.brands.*') ? 'bg-gray-700' : '' }}">
                    Markalar
                </a>
                <a href="{{ route('admin.sliders.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.sliders.*') ? 'bg-gray-700' : '' }}">
                    Slider
                </a>
                <a href="{{ route('admin.pages.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.pages.*') ? 'bg-gray-700' : '' }}">
                    Sayfalar
                </a>
                <a href="{{ route('admin.messages.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.messages.*') ? 'bg-gray-700' : '' }}">
                    Mesajlar
                </a>
                <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700' : '' }}">
                    Ayarlar
                </a>
                <a href="{{ route('admin.about.edit') }}" class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.about.*') ? 'bg-gray-700' : '' }}">
                    Hakkımızda
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Çıkış Yap
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
