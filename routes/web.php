<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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


Route::get('/sitemap.xml', function () {
    $locales = ['ar', 'en']; // your actual supported locales
    $pages = [
        '' => 1.0,          // home
        'about' => 0.8,
        'services' => 0.8,
        'blog' => 0.8,
        'contact' => 0.6,
    ];

    $sitemap = Sitemap::create();

    foreach ($pages as $path => $priority) {
        foreach ($locales as $locale) {
            $url = $path === ''
                ? url("/{$locale}")
                : url("/{$locale}/{$path}");

            $urlTag = Url::create($url)
                ->setPriority($priority)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);

            // Add alternate language versions for this same page
            foreach ($locales as $altLocale) {
                $altUrl = $path === ''
                    ? url("/{$altLocale}")
                    : url("/{$altLocale}/{$path}");

                $urlTag->addAlternate($altUrl, $altLocale);
            }

            $sitemap->add($urlTag);
        }
    }

    return $sitemap->toResponse(request());
});




