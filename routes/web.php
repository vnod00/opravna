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
 Route::resource('customers', 'CustomerController');
 Route::resource('repairs', 'RepairController');
 Route::post('/orders/fetch_staff', 'OrderController@fetchStaff')->name('orders.fetch_staff');
 Route::post('/orders/fetch_cus', 'OrderController@fetch')->name('orders.fetch');
 Route::post('/orders/fetch_mod', 'OrderController@fetchMod')->name('orders.fetch_mod');
 Route::post('/models/fetch', 'DeviceModelController@fetch')->name('models.fetch');
 Route::post('/auth/fetch', 'Auth\RegisterController@fetch')->name('auth.fetch');
 Auth::routes();

 Route::get('/logged', 'HomeController@logged')->name('logged');
 Route::get('/registered', 'HomeController@registered')->name('registered');
