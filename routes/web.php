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

<<<<<<< HEAD
Route::get('/', 'SearchController@searchByIp')->name('welcome');
=======
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//Route::get('/clima', function () {
//    return view('weather');
//})->name('weather');
>>>>>>> parent of c699c5c... 1.0.6

Route::get('/sobre', function () {
    return view('about');
})->name('about');

Route::get('/search', function () {
    return view('search');
})->name('search');

<<<<<<< HEAD
=======
Route::get('/clima/{city}', 'APIController');

>>>>>>> parent of c699c5c... 1.0.6
Route::get('/climaID/{id}', 'SearchController@searchById')->name("searchById");

Route::post('/clima', 'SearchController@searchByCity')->name("basicSearch");

Route::post('/climaZip', 'SearchController@advancedSearch')->name("advancedSearch");

