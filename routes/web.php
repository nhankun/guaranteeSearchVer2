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
});
Route::get('/search', 'SearchController@index');

Route::middleware('IsAdmin')->group(function (){
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admins.dashboard.dashboard');
        });

        Route::resource('users', 'UserController');
        Route::resource('services', 'ServiceController');
        Route::resource('doctors', 'DoctorController');
        Route::resource('gcs', 'guaranteeCertificateController');
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
