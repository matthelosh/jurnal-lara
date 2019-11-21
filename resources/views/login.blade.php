<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>LOGIN</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
        <link rel="stylesheet" href="">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/umum.css') }}" rel="stylesheet">
        <body>
            <div class="bg-container">
                <div class="bg">
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center position-ref login-content">
                <div>
                    <div class="content d-flex justify-content-center">
                        <div class="logo-front"><img src="/img/logokab.png" alt="Logo" width="100px"></div>
                    </div>
                    <div class="d-flex justify-content-center">
                        
                        <div class="text-greet hide-sm"><h3 class="text-white">Selamat Datang</h3></div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <form class="form form-login" action="/login" method="post">
                            @csrf()
                            <div class="form-group">
                                <input class="txt_box txt_username" type="text" name="username" id="username" placeholder="Username">
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
                </div>
                
                
            </div>
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('/js/core/popper.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
            <script>
            </script>
        </body>
    </html>