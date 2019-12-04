<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unauthorized</title>
    <link rel="stylesheet" href="{{asset('css/app.css') }}">
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
        html, body{
            margin:0;
            padding;0;
        }
        .wrapper{
            position: relative;
            width: 100vw;
            height: 100vh;
            background: rgba(200, 50,50,.5) url("{{asset('img/no-trepassing.jpg')}}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center bottom;
            padding: 100px 20px;
            box-sizing: border-box;
        }
        .wrapper .warning {
            width: 100%;
            display: flex;
            justify-content: center;
            color: red;
            font-weight: bolder;
            margin-bottom: 50px;
            
        }
        .rotate {
            animation: rotation 2s infinite linear;
            color: red!important;
            font-size: 5em;
        }

        @keyframes rotation {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(359deg);
            }
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="warning" style="background: rgba(255,255,255,0.6);padding: 20px;box-sizing: border-box;">
            <h1>MAAF! ANDA TIDAK BOLEH BERADA DISINI. BUKAN WILAYAH ANDA. :)</h1>
        </div>
        <div class="warning">
            <div class="rotate" >
                <img src="{{asset('img/loader.png') }}" alt="Danger" class="img-circle" width="150px;">
            </div>
        </div>
        <div class="warning">
            <a href="/dashboard" class="btn btn-danger">KEMBALI</a>
        </div>
    </div>
    <script src="{{asset('js/app.js') }}"></script>
</body>
</html>