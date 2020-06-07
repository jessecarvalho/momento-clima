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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Route::get('/clima', function () {
//    return view('weather');
//})->name('weather');

Route::get('/sobre', function () {
    return view('about');
})->name('about');

Route::get('/clima/{city}', 'APIController');

Route::post('/clima', 'SearchController@searchByCity')->name("city");

route::post('/climaZip', 'SearchController@searchByZip')->name("zip");
