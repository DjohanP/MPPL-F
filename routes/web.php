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

Route::post('/loginx','HomeController@loginx');

Route::group(['middleware' => ['auth']], function() {
	Route::group(['middleware'=>['admin']],function(){
		Route::get('/homeadmin','HomeController@admin');
	});
	Route::group(['middleware'=>['penyewa']],function(){
		Route::get('/homepenyewa','HomeController@penyewa');
	});
});


Auth::routes();
Route::get('master',function(){
	return view('master');
});
Route::get('/home', 'HomeController@index')->name('home');
