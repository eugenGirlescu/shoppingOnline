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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/categories', 'CategoryController');

Route::resource('/products', 'ProductController');

Route::get('check-exist/{name}', 'CategoryController@checkIfExists');

Route::get('check-exist-update/{id}/{name}', 'CategoryController@checkOnUpdate');

Route::get('check-prod/{name}/{categId}', 'ProductController@checkIfExists');

Route::get('check-prod-update/{id}/{name}/{categId}', 'ProductController@checkOnUpdate');

Route::post('add-order-items', 'OrderController@addItems');