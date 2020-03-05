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

/*Route::get('/', function () {
    return view('welcome');
});
Route::get('/about',function(){
    return view('pages.about'); */

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::resource('posts','PostController');
Route::resource('users','UsersController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
