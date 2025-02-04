<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\UserController;

// Group routes with optional locale

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about'])->name('about-us');

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact-us');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/our-projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/our-products', [HomeController::class, 'products'])->name('products');
Route::get('/services/{slug}', [HomeController::class, 'service'])->name('services.show');

// Language switcher route
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fr'])) {
        Session::put('locale', $locale);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

// Dashboard and authenticated routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('admin.')->prefix('admin')->group(function () {
        Route::resource('services', ServiceController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('slides', SlideController::class);
        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);
    });
});

// Include auth routes
require __DIR__ . '/auth.php';
