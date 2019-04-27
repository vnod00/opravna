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

Route::get('/', 'PagesController@index');
/* Route::get('/kokot', function () {
    // return view('welcome');
    return "<h1>Du bist kokot!!</h1>";
 });
 Route::get('/about/{id}/{name}', function ($id, $name) {
    return 'toto je ID '.$id.'s jménem '.$name;   
 }); */
 Route::get('/about', 'PagesController@about');
 Route::resource('orders', 'OrderController');
 Route::resource('models', 'DeviceModelController');
 Route::resource('brands', 'DeviceBrandController');
 Route::post('/models/fetch', 'DeviceModelController@fetch')->name('models.fetch');
