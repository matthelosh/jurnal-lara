<div class="sidebar" data-image="{{ asset('/img/sidebar-5.jpg') }}" data-color="orange">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="/" class="simple-text" style="margin:0;padding:0">
                        <small>JURNAL</small><br>
                        {{Session::get('sekolah')}}
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
                            <a class="nav-link" href="/dashboard/laporan">
                                <i class="nc-icon nc-layers-3"></i>
                                <p>Laporan</p>
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
                            <a class="nav-link" href="/dashboard">
                                <i class="nc-icon nc-chart-pie-35"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/profil/{{ Auth::user()->username }}">
                                <i class="nc-icon nc-badge"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/absenku">
                                <i class="nc-icon nc-notes"></i>
                                <p>Absenku</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/nilais">
                                <i class="nc-icon nc-notes"></i>
                                <p>Entri Nilai</p>
                            </a>
                        </li>
                        
                        @if(Session::get('wali') == true)
                        <li>
                            <a class="nav-link" href="/dashboard/siswaku">
                                <i class="nc-icon nc-satisfied"></i>
                                <p>Siswa</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/rekap-absen">
                                <i class="nc-icon nc-chart-pie-36"></i>
                                <p>Rekap Absen</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/raport">
                                <i class="nc-icon nc-layers-3"></i>
                                <p>Rapor</p>
                            </a>
                        </li>
                        
                        @endif
                    </ul>
                @elseif(Auth::user()->level == 'staf')
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="/dashboard">
                                <i class="nc-icon nc-chart-pie-35"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/profil/{{ Auth::user()->username }}">
                                <i class="nc-icon nc-badge"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                    </ul>
                @elseif(Auth::user()->level == 'katu')
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="/dashboard">
                                <i class="nc-icon nc-chart-pie-35"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="/dashboard/stafs">
                                <i class="nc-icon nc-circle-09"></i>
                                <p>Data Staf</p>
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