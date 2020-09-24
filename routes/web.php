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

Route::get('/home','CustomerController@home')->name('home');

Route::any('delete/{user_id?}','CustomerController@deleteCustomer')->name('delete');

Route::any('edit/{user_id?}','CustomerController@editCustomer')->name('edit');

Route::any('editAction','CustomerController@editAction')->name('editAction');

Route::any('add','CustomerController@addCustomer')->name('add');

