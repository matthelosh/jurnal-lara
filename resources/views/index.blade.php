@extends('dashboard')

@section('content')
	@if(Auth::user()->level == 'admin')
		@if($page)
			@switch($page)
				@case('dashboard')
					@include('layouts.defaultcontent')
				@break
				@case('users')
					@include('dash-admin.users')
				@break
				@case('detiluser')
				    @include('dash-admin.detiluser')
				@break
				@case('siswa')
					@include('dash-admin.siswa')
				@break
				@case('rombel')
					@include('dash-admin.rombel')
				@break
				@case('mapel')
					@include('dash-admin.mapel')
				@break
				@case('jadwal')
					@include('dash-admin.jadwal')
				@break
				@case('sekolah')
					@include('dash-admin.sekolah')
				@break
				@case('laporan')
					@include('dash-admin.laporan')
				@break
				@case('laporan_presensi')
					@include('dash-admin.laporan_presensi')
				@break
				@case('laporan_jurnal')
					@include('dash-admin.laporan_jurnal')
				@break
				@case('pengaturan')
					@include('dash-admin.pengaturan')
				@break
			@endswitch
		@endif
	@elseif(Auth::user()->level == 'guru')
		@if($page)
			@switch($page)
				@case('dashboard')
					@include('layouts.defaultcontent')
				@break
				@case('profilku')
					@include('dash-guru.profilku')
				@break
				@case('absen')
					@include('dash-guru.absen')
				@break
				@case('absenku')
					@include('dash-guru.absenku')
				@break
				@case('siswaku')
					@include('dash-admin.siswa')
				@break
				@case('rekap_absen')
					@include('dash-guru.rekap_absen')
				@break
				@case('raport')
					@include('dash-guru.raport')
				@break
				@case('sms-ortu')
					@include('dash-guru.sms')
				@break
			@endswitch
		@endif
	@elseif(Auth::user()->level == 'staf')
		@switch($page)
			@case('dashboard')
				@include('layouts.defaultcontent')
			@break
			@case('profilku')
				@include('dash-guru.profilku')
			@break
			
		@endswitch
	@elseif(Auth::user()->level == 'katu')
		@switch($page)
			@case('dashboard')
				@include('layouts.defaultcontent')
			@break
			@case('stafs')
				@include('dash-katu.stafs')
			@break
		@endswitch
	@elseif(Auth::user()->level == 'ks')
		@switch($page)
			@case('dashboard')
				@include('dash-ks.default')
			@break
			@case('stafs')
				@include('dash-katu.stafs')
			@break
		@endswitch
	@endif
@endsection
