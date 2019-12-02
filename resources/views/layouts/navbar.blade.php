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
                {{-- <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-planet"></i>
                        <span class="notification">5</span>
                        <span class="d-lg-none">Notification</span>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="#">Notification 1</a>
                        <a class="dropdown-item" href="#">Notification 2</a>
                        <a class="dropdown-item" href="#">Notification 3</a>
                        <a class="dropdown-item" href="#">Notification 4</a>
                        <a class="dropdown-item" href="#">Another notification</a>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nc-icon nc-zoom-split"></i>
                        <span class="d-lg-block">&nbsp;Search</span>
                    </a>
                </li> --}}
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        @if(file_exists(public_path('/img/faces/'.Auth::user()->nip.'.jpg')))
                            <img src="{{ asset('/img/faces/'.Auth::user()->nip.'.jpg') }}" alt="Avatar" class="img navbar-face" >
                        @else
                            <img src="{{ asset('/img/avatar-1.png') }}" alt="Avatar" class="img navbar-face" >
                        @endif
                        &nbsp;
                        <span class="no-icon">{{ Auth::user()->fullname }}</span>
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