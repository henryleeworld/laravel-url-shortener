<?php

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

Route::get('short-url/generate', 'ShortUrlsController@index');
Route::post('short-url/generate', 'ShortUrlsController@store')->name('short-url.generate.post');
Route::get('short-url/{code}', 'ShortUrlsController@redirectUrl')->name('short-url.redirect');
