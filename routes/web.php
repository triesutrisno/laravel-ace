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


Route::group(['middleware' => ['auth', 'checkLink:menu']], function () {
    Route::namespace('Menu')->group(function () {
        Route::resource('/menu', 'MenuController');
    });
});

Route::group(['middleware' => ['auth', 'checkLink:role']], function () {
    Route::namespace('Role')->group(function () {
        Route::resource('/role', 'RoleController');
    });
});

Route::group(['middleware' => ['auth', 'checkLink:menurole']], function () {
    Route::namespace('Menurole')->group(function () {
        Route::resource('/menurole', 'MenuroleController');
    });
});

Route::group(['middleware' => ['auth', 'checkLink:user']], function () {
    Route::namespace('User')->group(function () {
        Route::resource('/user', 'UserController');
    });
});

Route::group(['middleware' => ['auth', 'checkLink:userrole']], function () {
    Route::namespace('Userrole')->group(function () {
        Route::resource('/userrole', 'UserroleController');
    });
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'PagesController@home');

    Route::namespace('Penjualan')->group(function () {
        Route::get('/jualdetail', 'JualDetailController@index');
        Route::get('/jualretur', 'JualReturController@index');
        Route::get('/jualkoreksiharga', 'JualKoreksiHargaController@index');
        Route::get('/jualkoreksipiutang', 'JualKoreksiPiutangController@index');
        Route::get('/jualbayar', 'JualBayarController@index');
        Route::get('/jualbayarbatal', 'JualBayarBatalController@index');
        Route::get('/jualbayarlebih', 'JualBayarLebihController@index');
        Route::get('/piutangkartu', 'PiutangKartuController@index');
        Route::get('/piutangmutasi', 'PiutangMutasiController@index');
        Route::get('/piutangaging', 'PiutangAgingController@index');
    });

    Route::namespace('Penjualan')->group(function () {
        Route::resource('/returpenjualan', 'ReturpenjualanController');
    });

    /*
	Route::get('/students','StudentsController@index');
	Route::get('/students/create','StudentsController@create');
	Route::get('/students/{student}','StudentsController@show');
	Route::post('/students','StudentsController@store');
	Route::delete('/students/{students}','StudentsController@destroy');        
        */
});
