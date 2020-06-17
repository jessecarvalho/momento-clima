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

//Route::get('/clima', function () {
//    return view('weather');
//})->name('weather');

Route::get('/sobre', function () {
    return view('about');
})->name('about');

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/', 'SearchController@searchByIp')->name('welcome');

Route::get('/climaID/{id}', 'SearchController@searchById')->name("searchById");

Route::post('/clima', 'SearchController@searchByCity')->name("basicSearch");

Route::post('/climaZip', 'SearchController@advancedSearch')->name("advancedSearch");

