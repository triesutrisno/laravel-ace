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

// Route Group Master
Route::namespace('Master')->group(function () {
    // Penjualan
    Route::group(['middleware' => ['auth', 'checkLink:cabgud']], function () {
        Route::get('/cabgud', 'CabgudController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:barang']], function () {
        Route::get('/barang', 'BarangController@index');
    });
    Route::group(['middleware' => ['auth', 'checkLink:baranggrup']], function () {
        Route::get('/baranggrup', 'BarangGrupController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:pelanggan']], function () {
        Route::get('/pelanggan', 'PelangganController@index');
    });
});

// Route Group Penjualan
Route::namespace('Penjualan')->group(function () {
    // Penjualan
    Route::group(['middleware' => ['auth', 'checkLink:jualdetail']], function () {
        Route::get('/jualdetail', 'JualDetailController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:jualretur']], function () {
        Route::get('/jualretur', 'JualReturController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:jualkoreksiharga']], function () {
        Route::get('/jualkoreksiharga', 'JualKoreksiHargaController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:jualkoreksipiutang']], function () {
        Route::get('/jualkoreksipiutang', 'JualKoreksiPiutangController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:jualbayar']], function () {
        Route::get('/jualbayar', 'JualBayarController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:jualbayarbatal']], function () {
        Route::get('/jualbayarbatal', 'JualBayarBatalController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:jualbayarlebih']], function () {
        Route::get('/jualbayarlebih', 'JualBayarLebihController@index');
    });

    // summary
    Route::group(['middleware' => ['auth', 'checkLink:jualsummary']], function () {
        Route::get('/jualsummary', 'JualSummaryController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:jualtrend']], function () {
        Route::get('/jualtrend', 'JualTrendController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:jualpelanggan']], function () {
        Route::get('/jualpelanggan', 'JualPelangganController@index');
    });
});

// Route Group Penjualan
Route::namespace('Piutang')->group(function () {

    Route::group(['middleware' => ['auth', 'checkLink:piutangkartu']], function () {
        Route::get('/piutangkartu', 'PiutangKartuController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:piutangmutasi']], function () {
        Route::get('/piutangmutasi', 'PiutangMutasiController@index');
        Route::get('/piutangmutasi/show', 'PiutangMutasiController@show');
    });

    Route::group(['middleware' => ['auth', 'checkLink:piutangaging']], function () {
        Route::get('/piutangaging', 'PiutangAgingController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:piutangaging']], function () {
        Route::get('/caripiutangaging', 'PiutangAgingController@cari');
    });

    Route::group(['middleware' => ['auth', 'checkLink:piutangsaldo']], function () {
        Route::get('/piutangsaldo', 'PiutangSaldoController@index');
    });

    Route::group(['middleware' => ['auth', 'checkLink:piutangcek']], function () {
        Route::get('/piutangcek', 'PiutangCekController@index');
    });
});



Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'PagesController@home');
    /*
	Route::get('/students','StudentsController@index');
	Route::get('/students/create','StudentsController@create');
	Route::get('/students/{student}','StudentsController@show');
	Route::post('/students','StudentsController@store');
	Route::delete('/students/{students}','StudentsController@destroy');        
    */
});
