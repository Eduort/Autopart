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

Route::get('/panel', 'HomeController@index')->name('panel')->middleware('auth');;

Route::get('/panel/products', 'ProductController@index')->middleware('auth');;

Route::get('/panel/products/approve/{product}', 'ProductController@approve')->name('products.approve')->middleware('auth');;

Route::get('/panel/cars/sold/{car}', 'CarController@sold')->middleware('auth');;

Route::get('/panel/cars/delete/{car}', 'CarController@delete')->name('cars.delete')->middleware('auth');;

Route::resource('/panel/cars','CarController', [
])->middleware('auth');;