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
    return 'Это главная';
});

Route::get('/test.html','TestController@index');

Route::get('/test/{name}', 'TestController@name');

Route::resource('/brands', 'BrandController');
Route::resource('/actions', 'ActionController');
