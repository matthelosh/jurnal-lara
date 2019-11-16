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
				@case('siswa')
					@include('dash-admin.siswa')
				@break
				@case('rombel')
					@include('dash-admin.rombel')
				@break
				@case('mapel')
					@include('dash-admin.mapel')
				@break
				@case('pengaturan')
					@include('dash-admin.pengaturan')
				@break
			@endswitch

		@else
			
		@endif
	@elseif(Auth::user()->level == 'guru')

	@elseif(Auth::user()->level == 'ops')
	
	@endif
@endsection
