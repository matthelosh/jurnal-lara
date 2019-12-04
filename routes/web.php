<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuruMiddleware;

Route::get('/', function (Request $request) {
	$sekolah = \App\Sekolah::first();
	$request->session()->put('sekolah', $sekolah->nama_sekolah);
	if(Auth::check()){
		return redirect('/dashboard');
	}
    return view('login');
})->name('login');
Route::post('/login', 'LoginController@authenticate')->name('authenticateuser');
Route::get('/logout', function() {
	Auth::logout();
	return redirect('/');
});

// Route::group(['prefix' => 'absen', 'as' => 'absen'], function() {
// 	Route::post('/do', 'AbsenController@saveAbsen')->name('saveabsen')->middleware('forGuru');
// });

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function() {
	Route::get('/', 'DashController@index')->name('dashboardindex');

	// Dashboard Admin
	Route::get('/users', 'DashController@indexUsers')->name('dashboardusers')->middleware('forAdmin');
	Route::get('/users/detail/{username}','DashController@detilUser')->middleware('forAdmin');

	Route::get('/siswa', 'DashController@indexSiswa')->name('dashboardsiswas')->middleware('forAdmin');

	Route::get('/rombel', 'DashController@indexRombel')->name('dashboardrombel')->middleware('forAdmin');

	Route::get('/mapel', 'DashController@indexMapel')->name('dashboardmapel')->middleware('forAdmin');

	Route::get('/jadwal', 'DashController@indexJadwal')->name('dashboardjadwal')->middleware('forAdmin');

	Route::get('/sekolah', 'DashController@indexSekolah')->name('indexsekolah')->middleware('forAdmin');

	Route::get('/pengaturan', 'DashController@indexSetting')->name('dashboardsetting')->middleware('forAdmin');

	// Dashboard Guru
	Route::get('/absenku', 'LogabsenController@absenKu')->name('absenku')->middleware('forGuru');
	Route::get('/do-absen/{kode_absen}', 'AbsenController@doAbsen')->name('doabsen')->middleware('forGuru');
	Route::get('/detail-absen/{kode_absen}', 'AbsenController@detilAbsen')->name('detilAbsen')->middleware('forGuru'); 
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
	Route::delete('/delete/mapel/{mapel_id}', 'MapelController@delete')->name('hapusmapel');

	// Jadwal
	Route::get('/jadwals', 'JadwalController@index')->name('indexjadwal');
	Route::post('/add/jadwal', 'JadwalController@create')->name('createjadwal');
	Route::delete('/delete/jadwal/{id}', 'JadwalController@delete')->name('deletejadwal');

	// Jampel
	Route::post('/add/jampel', 'JampelController@create')->name('createjampel');
	Route::get('/jampels', 'JampelController@index')->name('indexjampel');
	Route::delete('/delete/jampel/{id}', 'JampelController@destroy')->name('deletejampel');
	Route::put('/update/jampel/{id}', 'JampelController@update')->name(
		'updatejampel');

	// Data Sekolah
	Route::get('/edit/data-sekolah', 'SekolahController@edit')->name('editsekolah');
	Route::post('/upload/logo', 'SekolahController@updateLogo')->name('updatelogo');
	Route::put('/update/sekolah', 'SekolahController@update')->name('updatesekolah');

	// Logabsen
	Route::post('/aktifkan-jadwal', 'LogabsenController@activate')->name('activatejadwal');
	Route::post('/get-log-absen', 'LogabsenController@index')->name('indexlogabsen');
	Route::post('/tutup/jadwal', 'LogabsenController@deactivate')->name('tutupjadwal');
		// Ijinkan GUru
	Route::put('/ijinkan/guru', 'LogabsenController@ijinkanGuru')->name('ijinkanguru');
	// Pesan Telegram
	Route::post('/cek/pesan', 'PesanController@cek')->name('cekpesan');
	Route::post('/kirim/pesan', 'PesanController@kirimPesan')->name('kirimpesan');

	// Absen
	Route::post('/absen/do', 'AbsenController@saveAbsen')->name('doabsen')->middleware('forGuru');
	Route::put('/absen/update/{nisn}', 'AbsenController@updatePresensi')->name('updatepresensi')->middleware('forGuru');
});


Route::group(['prefix' => 'import', 'as' => 'import.'], function() {
	Route::post('/users', 'UserController@import')->name('importusers');
	Route::post('/siswas', 'SiswaController@import')->name('importsiswas');
	Route::post('/mapels', 'MapelController@import')->name('importmapels');
	Route::post('/rombels', 'RombelController@import')->name('importrombel');
	Route::post('/jadwals', 'JadwalController@import')->name('importjadwals');
});


// Route Guru
// Route::group(['prefix' => 'guru', 'as' => 'guru.'], function() {
// 	Route::get('/dashboard', 'DashController@indexGuru')->name('dashguru');
// 	Route::get('/siswa', 'DashController@guruSiswa')->name('siswa');
// });
