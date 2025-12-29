<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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
