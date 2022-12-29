<?php

use App\Http\Controllers\ShortUrlsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('short-url/generate', [ShortUrlsController::class, 'index']);
Route::post('short-url/generate', [ShortUrlsController::class, 'store'])->name('short-url.generate.post');
Route::get('short-url/{code}', [ShortUrlsController::class, 'redirectUrl'])->name('short-url.redirect');
