<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>404 {{Session::get('sekolah')}}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <style>
    	#wrapper {
    		position: fixed;
    		height: 100vh;
    		width: 100vw;
    		background: url("{{ asset('/img/404.png') }}");
    		color: #333;
    	}
    </style>
</head>
<body>
	<div class="d-flex justify-content-center align-items-center" id="wrapper">
		<h1 class="text-center">Maaf! Halaman yang Anda Tuju Tidak Ditemukan<br><small><a href="/dashboard" class="btn btn-danger"><i class="fa fa-home"></i> Kembali</a></small></h1>
	</div>


	<script src="{{ asset('/js/app.js') }}" type="text/javascript"> </script>
	<script src="{{ asset('/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/core/popper.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
	<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
	<script src="{{ asset('/js/plugins/bootstrap-switch.js')}}"></script>
</body>
</html>