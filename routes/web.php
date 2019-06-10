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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/annonce', 'Adcontroller@create')->name('ad.create');
Route::post('annonce/create', 'Adcontroller@store')->name('ad.store'); 
//comme on est tjrs sur create, ca reste create!


