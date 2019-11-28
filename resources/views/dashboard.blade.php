
<!-- 
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ucfirst($page)}} | {{Session::get('sekolah')}}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/DataTables/DataTables-1.10.20/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('/DataTables/DataTables-1.10.20/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('/DataTables/Buttons-1.6.1/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('/DataTables/Responsive-2.2.3/css/responsive.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('/DataTables/Responsive-2.2.3/css/responsive.bootstrap4.css') }}">
    <link href="{{ asset('/css/light-bootstrap-dashboard.css?v=2.0.0 ') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('/css/utama.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/umum.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.navbar')
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    <div id="progress" class="d-none justify-content-center align-items-center" >
        <img src="{{ asset('/img/loader.png') }}" alt="" class="loader" style="height:100px;height:100px;">
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{ asset('/js/app.js') }}" type="text/javascript"> </script>
<script src="{{ asset('/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ asset('/js/plugins/bootstrap-switch.js')}}"></script>
 {{-- Google Maps Plugin    --}}
{{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
<!--  Chartist Plugin  -->
<script src="{{ asset('/js/plugins/chartist.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('/js/plugins/bootstrap-notify.js') }}"></script>
<script src="{{ asset('/DataTables/datatables.js') }}"></script>
<script src="{{ asset('/DataTables/Buttons-1.6.1/js/dataTables.buttons.js') }}"></script>
<script src="{{ asset('/DataTables/Buttons-1.6.1/js/buttons.bootstrap4.js') }}"></script>
<script src="{{ asset('/DataTables/Buttons-1.6.1/js/buttons.print.js') }}"></script>
<script src="{{ asset('/DataTables/Buttons-1.6.1/js/buttons.html5.js') }}"></script>
<script src="{{ asset('/DataTables/Buttons-1.6.1/js/buttons.flash.js') }}"></script>
<script src="{{ asset('/DataTables/JSZip-2.5.0/jszip.min.js') }}"></script>
<script src="{{ asset('/DataTables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
<script src="{{ asset('/DataTables/Responsive-2.2.3/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('/DataTables/Responsive-2.2.3/js/responsive.bootstrap4.js') }}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{ asset('/js/light-bootstrap-dashboard.js?v=2.0.0') }} " type="text/javascript"></script>
{{-- <script src="{{ asset('/js/light-bootstrap-dashboard.js') }} " type="text/javascript"></script> --}}
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('/js/sweetalert.js') }}"></script>
<script src="{{ asset('/js/utama.js') }}"></script>
@if(Auth::user()->level == 'admin')
    <script src="{{ asset('/js/admin.js') }}"></script>
@elseif(Auth::user()->level == 'guru')
    <script src="{{ asset('/js/guru.js') }}"></script>
@endif
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        // demo.initDashboardPageCharts();

        // demo.showNotification();

    });
</script>
<script>
    $(document).ready(function(){
        // alert('hi');
    })
</script>
@include('modals.modals')
</html>
