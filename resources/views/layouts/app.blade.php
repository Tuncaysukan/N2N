<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('messages.site_title'))</title>
    <meta name="description" content="@yield('description', __('messages.site_description'))">
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
    <style>
        /* Slider Container */
        .slider-container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        /* Slider Slides */
        .slider-slide {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            visibility: hidden;
            z-index: 1;
            transition: opacity 1s cubic-bezier(0.4, 0, 0.2, 1), 
                        visibility 1s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            transform: scale(1.05);
        }
        
        .slider-slide.active {
            opacity: 1;
            visibility: visible;
            z-index: 2;
            transform: scale(1);
        }
        
        /* Slider Image Ken Burns Effect */
        .slider-slide img {
            transition: transform 8s ease-out;
        }
        
        .slider-slide.active img {
            transform: scale(1.1);
        }
        
        /* Slider Content Animation */
        .slider-content {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out 0.3s, transform 0.8s ease-out 0.3s;
        }
        
        .slider-slide.active .slider-content {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Slider Title Animation */
        .slider-title {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.6s ease-out 0.5s, transform 0.6s ease-out 0.5s;
        }
        
        .slider-slide.active .slider-title {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Slider Subtitle Animation */
        .slider-subtitle {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.6s ease-out 0.7s, transform 0.6s ease-out 0.7s;
        }
        
        .slider-slide.active .slider-subtitle {
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Slider Button Animation */
        .slider-button {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out 0.9s, transform 0.6s ease-out 0.9s;
        }
        
        .slider-slide.active .slider-button {
            opacity: 1;
            transform: translateY(0);
        }
        
        .slider-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        /* Slider Dots */
        .slider-dot {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .slider-dot:hover {
            transform: scale(1.3);
        }
        
        .slider-dot.active {
            transform: scale(1.2);
        }
        
        /* Slider Nav Buttons */
        .slider-nav-btn {
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
        }
        
        .slider-nav-btn:hover {
            transform: translateY(-50%) scale(1.1);
            background: rgba(255,255,255,0.6);
        }
        
        /* Progress Bar */
        .slider-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            z-index: 30;
            transition: width 0.1s linear;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    @if(isset($settings['site_logo']) && $settings['site_logo'])
                        <a href="{{ route('home') }}" class="flex items-center">
                            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="N2N Tekstil" class="h-8 w-auto mr-2">
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">
                            N2N Tekstil
                        </a>
                    @endif
                </div>
                
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('brands.havaianas') }}" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('messages.havaianas') }}
                    </a>
                    <a href="{{ route('brands.new_era') }}" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('messages.new_era') }}
                    </a>
                    <a href="{{ route('brands.nike_swim') }}" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('messages.nike_swim') }}
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('messages.about') }}
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 transition">
                        {{ __('messages.contact') }}
                    </a>
                </div>

                <!-- Language Switcher -->
                <div class="flex items-center space-x-4">
                    <div class="flex border rounded">
                        <a href="{{ route('language.switch', 'tr') }}" 
                           class="px-3 py-1 {{ app()->getLocale() == 'tr' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            TR
                        </a>
                        <a href="{{ route('language.switch', 'en') }}" 
                           class="px-3 py-1 {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                            EN
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button class="text-gray-700 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">N2N Tekstil</h3>
                    <p class="text-gray-300">
                        {{ __('messages.company_info') }}
                    </p>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">{{ __('messages.quick_links') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">{{ __('messages.home') }}</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white">{{ __('messages.about') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">{{ __('messages.contact_info') }}</h3>
                    <p class="text-gray-300">
                        @if(isset($settings['contact_phone']) && $settings['contact_phone'])
                            {{ $settings['contact_phone'] }}<br>
                        @endif
                        @if(isset($settings['contact_email']) && $settings['contact_email'])
                            {{ $settings['contact_email'] }}<br>
                        @endif
                        @if(isset($settings['contact_address']) && $settings['contact_address'])
                            {{ $settings['contact_address'] }}
                        @endif
                    </p>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    © {{ date('Y') }} N2N. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        // Advanced Slider functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('slider');
            if (slider) {
                const slides = slider.querySelectorAll('.slider-slide');
                const dots = document.querySelectorAll('.slider-dot');
                const prevBtn = document.getElementById('slider-prev');
                const nextBtn = document.getElementById('slider-next');
                const progressBar = document.getElementById('slider-progress');
                let currentSlide = 0;
                let autoPlayInterval;
                let progressInterval;
                const slideDuration = 6000; // 6 saniye
                const progressStep = 50; // Her 50ms'de güncelle
                let progress = 0;
                let isPaused = false;

                function updateProgress() {
                    if (isPaused) return;
                    progress += (progressStep / slideDuration) * 100;
                    if (progressBar) {
                        progressBar.style.width = progress + '%';
                    }
                    if (progress >= 100) {
                        showSlide(currentSlide + 1);
                    }
                }

                function resetProgress() {
                    progress = 0;
                    if (progressBar) {
                        progressBar.style.width = '0%';
                    }
                }

                function showSlide(index) {
                    if (index < 0) index = slides.length - 1;
                    if (index >= slides.length) index = 0;
                    
                    // Tüm slide'lardan active class'ını kaldır
                    slides.forEach(slide => {
                        slide.classList.remove('active');
                    });
                    
                    // Tüm dot'lardan active stilini kaldır
                    dots.forEach(dot => {
                        dot.classList.remove('bg-white', 'active');
                        dot.classList.add('bg-white/50');
                    });
                    
                    // Yeni aktif slide
                    slides[index].classList.add('active');
                    
                    // Yeni aktif dot
                    if (dots[index]) {
                        dots[index].classList.remove('bg-white/50');
                        dots[index].classList.add('bg-white', 'active');
                    }
                    
                    currentSlide = index;
                    resetProgress();
                }

                // Dot click handlers
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        showSlide(index);
                    });
                });

                // Prev/Next button handlers
                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        showSlide(currentSlide - 1);
                    });
                }
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        showSlide(currentSlide + 1);
                    });
                }

                // Mouse hover - pause autoplay
                slider.addEventListener('mouseenter', () => {
                    isPaused = true;
                });
                
                slider.addEventListener('mouseleave', () => {
                    isPaused = false;
                });

                // Touch/Swipe support
                let touchStartX = 0;
                let touchEndX = 0;
                
                slider.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });
                
                slider.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                }, { passive: true });
                
                function handleSwipe() {
                    const swipeThreshold = 50;
                    const diff = touchStartX - touchEndX;
                    if (diff > swipeThreshold) {
                        // Sola kaydırma - sonraki slide
                        showSlide(currentSlide + 1);
                    } else if (diff < -swipeThreshold) {
                        // Sağa kaydırma - önceki slide
                        showSlide(currentSlide - 1);
                    }
                }

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        showSlide(currentSlide - 1);
                    } else if (e.key === 'ArrowRight') {
                        showSlide(currentSlide + 1);
                    }
                });

                // Auto-advance slider with progress
                if (slides.length > 1) {
                    progressInterval = setInterval(updateProgress, progressStep);
                }

                // İlk slide'ın aktif olduğundan emin ol
                showSlide(0);
            }
        });
    </script>
</body>
</html>
