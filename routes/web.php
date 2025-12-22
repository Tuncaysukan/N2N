<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController as FrontendBrandController;
use App\Http\Controllers\PageController as FrontendPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;

 // Clear Cache Route
Route::get('/clear', function() {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('event:clear');
            return redirect()->back()->with('success', 'All caches cleared successfully!');
        })->name('clear.cache');
        
// Language Switch
Route::get('/language/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->back();
})->name('language.switch');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        
        // Storage Link Route
        Route::get('/storage-link', function() {
            Artisan::call('storage:link');
            return redirect()->back()->with('success', 'Storage linked successfully!');
        })->name('storage.link');
        
        // Brand Routes
        Route::prefix('brands')->name('brands.')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/create', [BrandController::class, 'create'])->name('create');
            Route::post('/', [BrandController::class, 'store'])->name('store');
            Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('edit');
            Route::put('/{brand}', [BrandController::class, 'update'])->name('update');
            Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('destroy');
            
            // Brand Image Routes
            Route::prefix('{brand}/images')->name('images.')->group(function () {
                Route::post('/', [BrandController::class, 'addImage'])->name('add');
                Route::put('/{brandImage}', [BrandController::class, 'updateImage'])->name('update');
                Route::delete('/{brandImage}', [BrandController::class, 'deleteImage'])->name('delete');
            });
        });
        
        // Slider Routes
        Route::prefix('sliders')->name('sliders.')->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('index');
            Route::get('/create', [SliderController::class, 'create'])->name('create');
            Route::post('/', [SliderController::class, 'store'])->name('store');
            Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('edit');
            Route::put('/{slider}', [SliderController::class, 'update'])->name('update');
            Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('destroy');
        });
        
        // Page Routes
        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('index');
            Route::get('/create', [PageController::class, 'create'])->name('create');
            Route::post('/', [PageController::class, 'store'])->name('store');
            Route::get('/{page}/edit', [PageController::class, 'edit'])->name('edit');
            Route::put('/{page}', [PageController::class, 'update'])->name('update');
            Route::delete('/{page}', [PageController::class, 'destroy'])->name('destroy');
        });
        
        // Message Routes
        Route::prefix('messages')->name('messages.')->group(function () {
            Route::get('/', [MessageController::class, 'index'])->name('index');
            Route::get('/{message}', [MessageController::class, 'show'])->name('show');
            Route::put('/{message}/read', [MessageController::class, 'markAsRead'])->name('mark.read');
            Route::delete('/{message}', [MessageController::class, 'destroy'])->name('destroy');
        });
        
        // Setting Routes
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::put('/', [SettingController::class, 'update'])->name('update');
        });
        
        // About Page Routes
        Route::prefix('about')->name('about.')->group(function () {
            Route::get('/edit', [AboutPageController::class, 'edit'])->name('edit');
            Route::post('/', [AboutPageController::class, 'update'])->name('update');
        });
    });
    
    // Redirect admin root to login if not authenticated
    Route::get('/', function () {
        return redirect()->route('admin.login');
    })->withoutMiddleware('auth:admin');
});

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Brand Routes
Route::prefix('brands')->name('brands.')->group(function () {
    Route::get('/havaianas', [FrontendBrandController::class, 'havaianas'])->name('havaianas');
    Route::get('/new-era', [FrontendBrandController::class, 'newEra'])->name('new_era');
    Route::get('/nike-swim', [FrontendBrandController::class, 'nikeSwim'])->name('nike_swim');
});

// Page Routes
Route::get('/hakkimizda', [AboutController::class, 'index'])->name('about');
Route::get('/iletisim', [ContactController::class, 'show'])->name('contact');
Route::post('/iletisim', [ContactController::class, 'send'])->name('contact.send');
