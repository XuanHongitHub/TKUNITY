<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about-us', [SiteController::class, 'about'])->name('about');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [SiteController::class, 'submitContact'])->name('contact.submit');
Route::get('/games', [SiteController::class, 'games'])->name('games');
Route::get('/ai-trainer', [SiteController::class, 'aiTrainer'])->name('ai-trainer');
Route::get('/game-publishing', [SiteController::class, 'gamePublishing'])->name('game-publishing');
Route::get('/enterprise-solutions', [SiteController::class, 'enterpriseSolutions'])->name('enterprise-solutions');
Route::get('/documentation', [SiteController::class, 'documentation'])->name('documentation');
Route::get('/help', [SiteController::class, 'help'])->name('help');
Route::get('/faqs', [SiteController::class, 'faqs'])->name('faqs');
// Route::get('/login', [SiteController::class, 'login'])->name('login');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/category/{categorySlug}', [NewsController::class, 'index'])->name('news.category');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/terms', [SiteController::class, 'terms'])->name('terms');
Route::get('/privacy', [SiteController::class, 'privacy'])->name('privacy');

Route::fallback(function () {
    $path = '/' . trim(request()->path(), '/');
    
    $redirect = \Illuminate\Support\Facades\Cache::remember("redirect_{$path}", 3600, function () use ($path) {
        return \App\Models\Redirect::where('source', $path)
            ->where('active', true)
            ->first();
    });

    if ($redirect) {
        return redirect($redirect->destination, $redirect->code);
    }

    abort(404);
});
