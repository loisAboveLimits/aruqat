<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about-us', [AboutController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'show']);

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Arabic (default)
Route::middleware('locale')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about-us', [AboutController::class, 'index'])->name('about-us');
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
});

// English
Route::prefix('en')
    ->middleware('locale')
    ->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('home.en');
 		Route::get('/about-us', [AboutController::class, 'index'])->name('about-us.en');
        Route::get('/services', [ServiceController::class, 'index'])->name('services.en');
        Route::get('/blog', [BlogController::class, 'index'])->name('blog.en');
        Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.en');
        Route::get('/contact', [ContactController::class, 'index'])->name('contact.en');
    });




