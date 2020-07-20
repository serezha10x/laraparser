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

Route::get('/', 'MainController@main')->name('main');

Route::get('/parser', 'ParserController@parse')->name('parser');

Route::get('/articles/show/teacher', 'ArticlesController@show')->name('show-teacher');

Route::post('/parser/submit', 'ParserController@submit')->name('parser-submit');

