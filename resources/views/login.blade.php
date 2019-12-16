<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>LOGIN | {{Session::get('sekolah')}}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
        <link rel="stylesheet" href="">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/select2/css/select2.min.css') }}">
        <link href="{{ asset('css/umum.css') }}" rel="stylesheet">
        <body>
            <div class="bg-container">
                <div class="bg">
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center position-ref login-content">
                <div>
                    <div class="content d-flex justify-content-center">
                        <div class="logo-front"><img src="/img/logo.png" alt="Logo" width="100px"></div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="text-greet d-none d-md-block">
                            <h3 class="text-white text-center">Selamat Datang <br> di Jurnal Presensi {{Session::get('sekolah')}}</h3>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form class="form form-login" action="/login" method="post">
                            @csrf()
                            <div class="form-group">
                                <input class="txt_box txt_username" type="text" name="username" id="username" placeholder="Username" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="txt_box txt_password" type="password" name="password" id="password" placeholder="*******">
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <button class="btn btn-danger flat" type="submit">LOGIN</button>
                            </div>
                        </form>
                    </div>
                    @if(Session::get('error'))
                        <div class="alert bg-danger text-white">{{ Session::get('error') }}</div>
                    @endif
                    <div class="alert bg-info text-white" id="demo"></div>
                </div>
                
            </div>
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('/js/core/popper.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('/js/geo.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('/js/sweetalert.js') }}"></script>
            <script src="{{ asset('/select2/js/select2.min.js') }}"></script>
            <script src="{{ asset('/js/umum.js') }}"></script>
            {{-- <script>
                var headers =  {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                };
               

                var x = document.getElementById("demo");
                var long = 112.646883;
                var lat = -8.034246;
                    function getLocation(sekolah) {
                        if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(pos){
                            // alert(pos.coords.latitude+', '+pos.coords.longitude);
                            var distance = distanceBetween(Number(sekolah.lat), Number(sekolah.long), pos.coords.latitude, pos.coords.longitude, "K");
                            // console.log("geo dis: " + distance);
                            // $("#demo").html("<h4>" + Math.round(distance) + "Km</h4>");
                            if ( distance > 0.5){
                                $('#demo').html('Pastikan Anda berada di area sekolah. Saat ini Anda berjarak kurang lebih '+Math.round(distance)+' Km dari sekolah. ;)');
                            } else {
                                $('#demo').html('Silahkan masuk. Anda sudah berada di area sekolah.');
                            }
                        }, showError);
                        } else {
                        var status = document.getElementById("demo");
                        status.innerHTML = "Geolocation is not supported by this browser.";
                        }
                    }
                    function distanceBetween(lat1, lon1, lat2, lon2, unit) {

                        var rlat1 = Math.PI * lat1 / 180
                        var rlat2 = Math.PI * lat2 / 180
                        var rlon1 = Math.PI * lon1 / 180
                        var rlon2 = Math.PI * lon2 / 180
                        var theta = lon1 - lon2
                        var rtheta = Math.PI * theta / 180
                        var dist = Math.sin(rlat1) * Math.sin(rlat2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.cos(rtheta);
                        dist = Math.acos(dist)
                        dist = dist * 180 / Math.PI
                        dist = dist * 60 * 1.1515
                        if (unit == "K") {
                        dist = dist * 1.609344
                        }
                        if (unit == "N") {
                        dist = dist * 0.8684
                        }
                        return dist
                        
                    }
                    // show our errors for debuging
                    function showError(error) {
                        var x = document.getElementById("demo");
                        switch (error.code) {
                        case error.PERMISSION_DENIED:
                            x.innerHTML = "Mohon aktifkan lokasi untuk browser. :)"
                            break;
                        case error.POSITION_UNAVAILABLE:
                            x.innerHTML = "Location information is unavailable.";
                            break;
                        case error.TIMEOUT:
                            x.innerHTML = "The request to get location timed out.";
                            break;
                        case error.UNKNOWN_ERROR:
                            x.innerHTML = "An unknown error occurred :(";
                            break;
                        }
                    }

                    $(document).ready(function(){
                        var sekolah;
                        $.ajax({
                            url: '/ajax/getsekolah',
                            type: 'post',
                            headers: headers,
                            dataType: 'json',
                            success: function(res) {
                                console.log(res);
                                sekolah = res.data;  
                                getLocation(res.data);
                            }
                        })
                        
                    })
                // });
            </script> --}}
        </body>
    </html>