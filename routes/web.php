<?php

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

Auth::routes();



Route::get('/', 'ShortUrlController@index')->name('home');
Route::get('/home', 'ShortUrlController@index')->name('home');
Route::get('/detail/{id}', 'ShortUrlController@show')->name('show');
Route::post('generate-shorten-link', 'ShortUrlController@store')->name('generate.shorten.link.post');

Route::get('options', 'OptionsController@index')->name('option.index');
Route::post('options', 'OptionsController@store')->name('option.post');

Route::get('{code}', 'ShortUrlController@shortenLink')->name('shorten.link');


