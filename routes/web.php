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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('home/{id}/edit', 'HomeController@edit');
Route::put('home/{id}', 'HomeController@update');
Route::get('home/create', 'HomeController@create');
Route::post('home', 'HomeController@store');     
Route::delete('home/{id}', 'HomeController@destroy');
