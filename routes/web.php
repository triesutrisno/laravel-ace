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

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/postlogin', 'LoginController@postlogin');
Route::get('/logout', 'LoginController@logout');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'PagesController@home');

    Route::namespace('Menu')->group(function () {
        Route::resource('/menu', 'MenuController');
    });

    Route::namespace('Role')->group(function () {
        Route::resource('/role', 'RoleController');
    });

    Route::namespace('Menurole')->group(function () {
        Route::resource('/menurole', 'MenuroleController');
    });

    Route::namespace('User')->group(function () {
        Route::resource('/user', 'UserController');
    });

    Route::namespace('Userrole')->group(function () {
        Route::resource('/userrole', 'UserroleController');
    });

    Route::namespace('Penjualan')->group(function () {
        Route::resource('/detailpenjualan', 'DetailpenjualanController');
    });

    Route::namespace('Penjualan')->group(function () {
        Route::resource('/returpenjualan', 'ReturpenjualanController');
    });

    Route::get('/about', 'PagesController@about');

    /*
	Route::get('/students','StudentsController@index');
	Route::get('/students/create','StudentsController@create');
	Route::get('/students/{student}','StudentsController@show');
	Route::post('/students','StudentsController@store');
	Route::delete('/students/{students}','StudentsController@destroy');        
        */
});
