<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuruMiddleware;
// use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
	$sekolah = \App\Sekolah::first();
	if(!$sekolah) {
		$nama_sekolah = 'Belum Ada Sekolah';
	} else {
		$nama_sekolah = $sekolah->nama_sekolah;
	}
	$request->session()->put('sekolah', $nama_sekolah);
	$request->session()->put('gps', $sekolah->gps);
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

	Route::get('/laporan', 'DashController@indexLaporan')->name('indexlaporan')->middleware('forAdmin');
	Route::get('/laporan/presensi', 'DashController@indexPresensi')->name('indexlaporan')->middleware('forAdmin');
	Route::get('/laporan/jurnal', 'DashController@indexJurnal')->name('indexlaporan')->middleware('forAdmin');

	Route::get('/pengaturan', 'DashController@indexSetting')->name('dashboardsetting')->middleware('forAdmin');

	// Dashboard Guru
	Route::get('/absenku', 'LogabsenController@absenKu')->name('absenku')->middleware('forGuru');
	
	Route::get('/do-absen/{kode_absen}', 'AbsenController@doAbsen')->name('doabsen')->middleware('forGuru');
	Route::get('/detail-absen/{kode_absen}', 'AbsenController@detilAbsen')->name('detilAbsen')->middleware('forGuru');
	Route::get('/profil/{username}', 'DashController@profil')->name('profiluser');
	Route::get('/siswaku', 'DashController@siswaku')->name('indexsiswaku')->middleware('forGuru');
	Route::get('/rekap-absen', 'DashController@rekapAbsen')->name('indexrekapwali')->middleware('forGuru');
	// Route::get('/rekap-absen/siswa/{nisn}/bulan/{bulan}/tahun/{tahun}','DashController@rekapAbsen')->name('detilrekapwali')->middleware('forGuru');
	Route::get('/raport', 'DashController@indexRaport')->name('indexraportwali')->middleware('forGuru');
	Route::get('/cetak/raport/{periode}', 'RaportController@cetak')->name('cetakraport');
	Route::get('/cetak/siswa/biodata', 'SiswaController@cetakBiodata')->name('cetakbiodata');
	

	// Ka TU
	Route::get('/stafs', 'DashController@indexStafs')->name('indexstafs');
	
	Route::get('/get-finger', 'LogabsenController@getFinger')->name('getfinger');
});


Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function() {
	// Umum
	Route::post('/getsekolah', 'SekolahController@show')->name('datasekolah');
	Route::put('/update-lokasi-sekolah', 'SekolahController@updateLokasi')->name('updatelokasi');


	Route::get('/users', 'UserController@index')->name('indexusers');
	Route::post('/add/user', 'UserController@create')->name('adduser');
	Route::delete('/delete/user/{nip}', 'UserController@destroy')->name('destroyuser');
	Route::put('/update/user/{id}', 'UserController@update')->name('updateuser');

	// Siswa
	Route::get('/siswas', 'SiswaController@index')->name('indexsiswas');
	Route::post('/add/siswa', 'SiswaController@create')->name('createsiswa');
	Route::put('/update/siswa/{id}', 'SiswaController@update')->name('updatesiswa');
	Route::delete('/delete/siswa/{nisn}', 'SiswaController@delete')->name('deletesiswa');
	Route::post('/siswa/sel-siswaku', 'SiswaController@selSiswaKu')->name('selsiswaku')->middleware('forGuru');

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
	Route::post('/jadwal/create', 'JadwalController@create')->name('createjadwal');
	Route::delete('/delete/jadwal/{id}', 'JadwalController@delete')->name('deletejadwal');
	Route::put('/jadwal/update/{id}', 'JadwalController@update')->name('updatejadwal');

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
	Route::post('/create/sekolah', 'SekolahController@create')->name('createsekolah');
	Route::put('/gps/{mode}', 'SekolahController@toggleGps')->name('togglegps')->middleware('forAdmin');

	// Logabsen
	Route::post('/aktifkan-jadwal', 'LogabsenController@activate')->name('activatejadwal');
	Route::post('/get-log-absen', 'LogabsenController@index')->name('indexlogabsen');
	Route::post('/tutup/jadwal', 'LogabsenController@deactivate')->name('tutupjadwal');
	Route::post('/rekap/logabsen', 'LogabsenController@rekap')->name('rekaplogabsen')->middleware('forAdmin');
	Route::post('/getabsenku', 'LogabsenController@getAbsenKu')->name('getabsenku')->middleware('forGuru');
		// Ijinkan GUru
	Route::put('/ijinkan/guru', 'LogabsenController@ijinkanGuru')->name('ijinkanguru');
	// Pesan Telegram
	Route::post('/cek/pesan', 'PesanController@cek')->name('cekpesan');
	Route::post('/kirim/pesan', 'PesanController@kirimPesan')->name('kirimpesan');

	// Absen
	Route::post('/absen/do', 'AbsenController@saveAbsen')->name('doabsen')->middleware('forGuru');
	Route::put('/absen/update/{nisn}', 'AbsenController@updatePresensi')->name('updatepresensi')->middleware('forGuru');
	Route::post('/rekap/kelas/bulan/{bulan}/tahun/{tahun}/rombel/{rombel}', 'AbsenController@rekapKelas')->name('rekapkelas');
	Route::post('/detil/absen/{kode}', 'AbsenController@getDetil')->name('detilabsen');

	// Select2
	Route::post('/select/rombel', 'RombelController@select')->name('selectrombel');
	Route::post('/select/guru', 'UserController@select')->name('selectguru');
	Route::post('/select/stafs', 'UserController@selectStafs')->name('selectstafs');
	Route::post('/select/mapels', 'MapelController@select')->name('selectmapels');


	Route::post('/upload/foto', 'UserController@updateFoto')->name('gantifoto');
	Route::post('/getsiswaku', 'SiswaController@getSiswaku')->name('getsiswaku')->middleware('forGuru');

	// Staf
	Route::get('/jurnalku', 'JurnalController@jurnalKu')->name('jurnalku');
	Route::post('/jurnal/isi', 'JurnalController@create')->name('createjurnal');
	Route::put('/jurnal/update/{kode_jurnal}', 'JurnalController@update')->name('jurnal');
	Route::post('/jurnal/stafs/{tanggal}', 'JurnalController@jurnalStaf')->name('jurnalstaf');
	Route::put('/jurnal/validasi/{valid}/kode/{kode_jurnal}', 'JurnalController@validasi')->name('validasijurnal');
	Route::post('/stafs', 'UserController@getStafs')->name('getstafs');
	Route::post('/jurnal/laporan', 'JurnalController@laporan')->name('laporanjurnalstaf');

	// Ortu
	Route::get('/ortu/get-one/{nik}', 'OrtuController@getOne')->name('getoneortu');
	Route::post('/ortu/create', 'OrtuController@create')->name('createoneortu');
	Route::put('/ortu/update', 'OrtuController@update')->name('updateortu');

	// SMS
	Route::post('/sms/kirim', 'PesanController@sendSMS')->name('sendsms');
	Route::post('/sms/cek','PesanController@cekSMS')->name('ceksms');
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
URL::forceScheme('https');