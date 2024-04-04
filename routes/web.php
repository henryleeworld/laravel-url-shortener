<?php

use App\Http\Controllers\ShortUrlsController;
use Illuminate\Support\Facades\Route;

Route::get('short-url/generate', [ShortUrlsController::class, 'index']);
Route::post('short-url/generate', [ShortUrlsController::class, 'store'])->name('short-url.generate.post');
Route::get('short-url/{code}', [ShortUrlsController::class, 'redirectUrl'])->name('short-url.redirect');
