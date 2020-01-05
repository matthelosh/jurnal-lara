<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biodata Siswa</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/umum.css') }}">
</head>
<body onload="cetak()" onafterprint="tutup()">
    <div class="container-fluid">
        <div class="row" id="biodata-page">
            <div class="col-sm-12">
                <div class="page data-sekolah d-block mx-auto" >
                    <div class="page-content">
                        <h3 class="text-center">RAPORT</h3>
                        <h3 class="text-center">PESERTA DIDIK</h3>
                        <h3 class="text-center">
                            @switch($sekolah->jenjang)
                                @case('sd')
                                    SEKOLAH DASAR (SD)
                                    @break
                                @case('smp')
                                    SEKOLAH MENENGAN PERTAMA (SMP)
                                    @break
                                @case('sma')
                                    SEKOLAH MENENGAH ATAS (SMA)
                                    @break
                                @case('smk')
                                    SEKOLAH MENENGAH KEJURUAN (SMK)
                                    @break
                            @endswitch
                        </h3>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <table>
                            <tr>
                                <td>Nama Sekolah</td><td>:</td><td>{{ $sekolah->nama_sekolah }}</td>
                            </tr>
                            <tr>
                                <td>NPSN</td><td>:</td><td>{{ $sekolah->npsn }}</td>
                            </tr>
                            <tr>
                                <td>NSS</td><td>:</td><td>{{ $sekolah->nss }}</td>
                            </tr>
                            <tr>
                                <td>Alamat Sekolah</td><td>:</td><td>{{ $sekolah->alamat_sekolah }}</td>
                            </tr>
                            <tr>
                                <td>Kelurahan/Desa</td><td>:</td><td>{{ $sekolah->kelurahan }}</td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td><td>:</td><td>{{ $sekolah->kec }}</td>
                            </tr>
                            <tr>
                                <td>Kabupaten/Kota</td><td>:</td><td>{{ $sekolah->kota }}</td>
                            </tr>
                            <tr>
                                <td>Propinsi</td><td>:</td><td>{{ $sekolah->prov }}</td>
                            </tr>
                            <tr>
                                <td>No. Telepon</td><td>:</td><td>{{ $sekolah->telp }}</td>
                            </tr>
                            <tr>
                                <td>Email</td><td>:</td><td>{{ $sekolah->email }}</td>
                            </tr>
                            <tr>
                                <td>Website</td><td>:</td><td>{{ $sekolah->website }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="page data-siswa">
                    <div class="page-content">
                        <h3 class="text-center">IDENTITAS PESERTA DIDIK</h3>
                        <br>
                        <br>
                        <br>
                        <ol>
                            <li>Nama Peserta Didik</li>
                            <li>NISN / NISN</li>
                            <li>Tempat, Tanggal Lahir</li>
                            <li>Jenis Kelamin</li>
                            <li>Agama</li>
                            <li>Pendidikan Sebelumnya</li>
                            <li>Alamat Peserta Didik</li>
                            <li>Nama Orang Tua
                                <ol type="a">
                                    <li>Ayah</li>
                                    <li>Ibu</li>
                                </ol>
                            </li>
                            <li>Pekerjaan Orang Tua
                                <ol type="a">
                                    <li>Ayah</li>
                                    <li>Ibu</li>
                                </ol>  
                            </li>
                            <li>Alamat Orang Tua
                                <ol type="a">
                                    <li>Jalan</li>
                                    <li>Kelurahan/Desa</li>
                                    <li>Kecamatan</li>
                                    <li>Kabupaten/Kota</li>
                                    <li>Propinsi</li>
                                </ol>
                            </li>
                            <li>
                                Wali Peserta Didik
                                <ol type="a">
                                    <li>Nama</li>
                                    <li>Pekerjaan</li>
                                    <li>Alamat</li>
                                </ol>
                            </li>
                        </ol>

                        <div class="row">
                            <div class="col-sm-6">
                                    @php($foto = (file_exists('/img'.$siswa->foto)) ?  '/img'.$siswa->foto : ($siswa->jk == 'l') ? '/img/avatar-siswa-l.png' : '/img/avatar-siswa-p.png')
                                <div class="img-frame" style="width:3cm; height: 4cm; border: 2px dashed gray; margin:auto; background: #efefef url('{{ asset($foto) }}'); background-size: cover;background-repeat: no-repeat; background-position: center;">
                                </div>
                            </div>
                            <div class="col-sm-6 text-center">
                                    {{ $sekolah->kelurahan }}, <span id="tanggal"></span><br>
                                    Wali Kelas {{ $siswa->rombels->nama_rombel }}
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <u><b>{{ Auth::user()->fullname }}</b></u><br>
                                    NIP. {{ Auth::user()->nip }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        function cetak() {
            window.print();
        }

        function tutup() {
            window.close();
        }
    </script>
</body>
</html>

