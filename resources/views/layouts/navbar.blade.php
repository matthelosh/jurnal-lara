<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="text-transform: capitalize;">
            {{ $page }}
        </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar burger-lines"></span>
        <span class="navbar-toggler-bar burger-lines"></span>
        <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        {{-- <i class="nc-icon nc-palette"></i> --}}
                        <span class="d-lg-none">
                            @if($page)
                            {{ $page }}
                            @else
                            Jurnal
                            @endif
                        </span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/profil/{{Auth::user()->username}}">
                        @if(file_exists(public_path('/img/faces/'.Auth::user()->nip.'.jpg')))
                            <img src="{{ asset('/img/faces/'.Auth::user()->nip.'.jpg') }}" alt="Avatar" class="img navbar-face" >
                        @else
                            <img src="{{ asset('/img/avatar-1.png') }}" alt="Avatar" class="img navbar-face" >
                        @endif
                        &nbsp;
                        <span class="no-icon" id="user_fullname">{{ Auth::user()->fullname }}</span>
                        <span class="d-none" id="user_nip">{{Auth::user()->nip}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">
                        <i class="nc-icon nc-button-power"></i>
                        &nbsp;
                        <span class="no-icon">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>