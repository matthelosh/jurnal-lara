<div class="sidebar" data-image="{{ asset('/img/sidebar-5.jpg') }}">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="http://www.creative-tim.com" class="simple-text">
                        Creative Tim
                    </a>
                </div>
                @if(Auth::user()->level == 'admin')
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="/dashboard">
                                <i class="nc-icon nc-chart-pie-35"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/users">
                                <i class="nc-icon nc-single-02"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/siswa">
                                <i class="nc-icon nc-satisfied"></i>
                                <p>Siswa</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/rombel">
                                <i class="nc-icon nc-vector"></i>
                                <p>Rombel</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/mapel">
                                <i class="nc-icon nc-ruler-pencil"></i>
                                <p>Mapel</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/jadwal">
                                <i class="nc-icon nc-notes"></i>
                                <p>Jadwal</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/sekolah">
                                <i class="nc-icon nc-bank"></i>
                                <p>Data Sekolah</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/pengaturan">
                                <i class="nc-icon nc-preferences-circle-rotate"></i>
                                <p>Pengaturan</p>
                            </a>
                        </li>
                        
                    </ul>
                @elseif(Auth::user()->level == 'guru')
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="dashboard.html">
                                <i class="nc-icon nc-chart-pie-35"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="./user.html">
                                <i class="nc-icon nc-circle-09"></i>
                                <p>User Profile</p>
                            </a>
                        </li>
                    </ul>
                @elseif(Auth::user()->level == 'ops')
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="dashboard.html">
                                <i class="nc-icon nc-chart-pie-35"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="./user.html">
                                <i class="nc-icon nc-circle-09"></i>
                                <p>User Profile</p>
                            </a>
                        </li>
                    </ul>
                @endif
                {{-- <ul class="nav">
                    <li class="nav-item  -pro">
                        <a class="nav-link " href="upgrade.html">
                            <i class="nc-icon nc-alien-33"></i>
                            <p>Upgrade to PRO</p>
                        </a>
                    </li>
                </ul> --}}
            </div>
        </div>