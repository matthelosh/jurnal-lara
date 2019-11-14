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
    return view('login');
})->name('login');
Route::post('/login', 'LoginController@authenticate')->name('authenticateuser');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function() {
	Route::get('/', 'DashController@index')->name('dashboardindex');
	Route::get('/users', 'DashController@indexUsers')->name('dashboardusers');

	Route::get('/siswa', 'DashController@indexSiswa')->name('dashboardsiswas');

	Route::get('/rombel', 'DashController@indexRombel')->name('dashboardrombel');

	Route::get('/mapel', 'DashController@indexMapel')->name('dashboardmapel');
});


Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function() {
	Route::get('/users', 'UserController@index')->name('indexusers');
	Route::post('/add/user', 'UserController@create')->name('adduser');
	Route::delete('/delete/user/{nip}', 'UserController@destroy')->name('destroyuser');
	Route::put('/update/user/{id}', 'UserController@update')->name('updateuser');

	// Siswa
	Route::get('/siswas', 'SiswaController@index')->name('indexsiswas');
	Route::post('/add/siswa', 'SiswaController@create')->name('createsiswa');
	Route::put('/update/siswa/{id}', 'SiswaController@update')->name('updatesiswa');
	Route::delete('/delete/siswa/{nisn}', 'SiswaController@delete')->name('deletesiswa');

	// Rombel
	// Route::get('/rombels', 'RombelController@index')->name('indexrombels');
	Route::get('/rombels', 'RombelController@index')->name('indexrombels');
	Route::post('/add/rombel', 'RombelController@create')->name('createrombel');
	Route::put('/update/rombel/{rombel_id}', 'RombelController@update')->name('updaterombel');
	Route::delete('/delete/rombel/{rombel_id}', 'RombelController@delete')->name('deleterombel');

	// Get Members
	Route::get('/members/rombel/{rombel_id}', 'SiswaController@getMembers')->name('getmembers');
	Route::get('/nonmembers', 'SiswaController@getNonMembers')->name('getnonmembers');
	// Pindah ROmbel
	Route::put('/pindahrombel', 'SiswaController@pindahRombel')->name('pindahrombel');
	// Keluarkan siswa dari rombel
	Route::put('/keluarkansiswa', 'SiswaController@keluarRombel')->name('keluarrombel');
	// Masukkan ke rombel
	Route::put('/masukkansiswa', 'SiswaController@masukkanSiswa')->name('masukkansiswa');

	// Mapel
	Route::get('/mapels', 'MapelController@index')->name('indexmapel');
	Route::post('/add/mapel', 'MapelController@create')->name('createmapel');
	Route::put('/update/mapel', 'MapelController@update')->name('updatemapel');
});


Route::group(['prefix' => 'import', 'as' => 'import.'], function() {
	Route::post('/users', 'UserController@import')->name('importusers');
	Route::post('/siswas', 'SiswaController@import')->name('importsiswas');
});

