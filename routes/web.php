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
});*/

Route::get('/login','LoginController@index')->name('login');
Route::post('/postlogin','LoginController@postlogin');


Route::group(['middleware' => 'auth'], function () {
        
        Route::get('/logout','LoginController@logout');
	Route::get('/','PagesController@home');
	Route::get('/about','PagesController@about');

	Route::get('/mahasiswa','MahasiswaController@index');

	Route::get('/students','StudentsController@index');
	Route::get('/students/create','StudentsController@create');
	Route::get('/students/{student}','StudentsController@show');
	Route::post('/students','StudentsController@store');
	Route::delete('/students/{students}','StudentsController@destroy');
});
