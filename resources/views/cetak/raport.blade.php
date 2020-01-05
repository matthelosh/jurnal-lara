<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raport {{ $page }} {{ $data->nama_siswa }}</title>
    <link rel="stylesheet" href="http://{{ $_SERVER['HTTP_HOST'] }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="http://{{ $_SERVER['HTTP_HOST'] }}/css/umum.css" type="text/css">
</head>
<body onload="cetak()" onafterprint="tutup()">
    <div class="container-fluid">
        <div class="row" style="border-bottom: 5px double black;">
            <img src="{{ asset('/img/logo.png') }}" alt="Logo" class="logo" style="width: 100px; position: absolute; margin-top: 15px; margin-left: 25px;">
            <div class="text-center col-sm-12" >
                <h4 class="no-margin">PEMERINTAH {{ ($sekolah->jenjang == 'sd' || $sekolah->jenjang == 'smp') ? strtoupper($sekolah->kota) : 'PROPINSI '. strtoupper($sekolah->prov) }}</h4> 
                <h5 class="no-margin">DINAS PENDIDIKAN</h5>
                @if($sekolah->jenjang == 'sd' || $sekolah->jenjang == 'smp')
                    <h5 class="no-margin">KORWILCAM DINAS PENDIDIKAN KECAMATAN {{ strtoupper($sekolah->kec) }}</h5>
                @else
                    <h5 class="no-margin">CABANG DINAS PENDIDIKAN {{ strtoupper($sekolah->kota) }}</h5>
                @endif
                <h3 class="no-margin">{{ $sekolah->nama_sekolah }}</h3>
                <P class="no-margin">{{ $sekolah->alamat_sekolah }} {{ $sekolah->kelurahan }}</P>
                @php($teks = explode(' ', $sekolah->kota))
                <P class="no-margin">{{ $sekolah->kec }} - {{ $teks[1] }}, Email: {{ $sekolah->email }}</P>
            </div>
        </div>
    @if($page == 'pas')
        <div class="row">
            <div class="raport">
                <div class="kop-raport">
                    <h5 class="text-center">RAPOR DAN PROFIL PESERTA DIDIK</h5>
                    <div class="row">
                        <div class="col-sm-8">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Nama Peserta Didik</td>
                                        <td>:</td>
                                        <td>{{ $data->nama_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <td>NISN/NIS</td>
                                        <td>:</td>
                                        <td>{{ $data->nisn }} / {{ $data->nis }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Sekolah</td>
                                        <td>:</td>
                                        <td>{{ $sekolah->nama_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Sekolah</td>
                                        <td>:</td>
                                        <td style="width: 65%; ">{{ $sekolah->alamat_sekolah }} {{ $sekolah->kelurahan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-4 ">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Kelas</td>
                                        <td>:</td>
                                        <td>{{ $data->rombels->nama_rombel }}</td>
                                    </tr>
                                    <tr>
                                        <td>Semester</td>
                                        <td>:</td>
                                        <td>{{ $_GET['semester'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Pelajaran</td>
                                        <td>:</td>
                                        <td>{{ $_GET['tapel'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <h5>A. Kompetensi Sikap</h5>
                <table border="1" width="100%" class="table-sikap">
                    <thead class="thead-inverse">
                        <tr>
                            <th>No</th>
                            <th>Kompetensi Inti</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">1</td>
                            <td>Sikap Spiritual</td>
                            <td>Halo</td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td>Sikap Sosial</td>
                            <td>Hl=a</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <br>
                <h5>B. Kompetensi Pengetahuan dan Keterampilan</h5>
                
                    <table border="1" width="100%" class="table-k3">
                        <thead class="thead-inverse">
                            <tr>
                                <th>No</th>
                                <th >Mupel</th>
                                <th colspan="4">Pengetahuan</th>
                                <th colspan="4">Keterampilan</th>
                            </tr>

                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i < 6; $i++)
                                <tr >
                                    <td rowspan="3">
                                        {{ $i+1 }}
                                    </td>
                                    <td rowspan="3">
                                        Mapel
                                    </td>
                                    <td style="background: #ccc">Nilai</td>
                                    <td style="background: #ccc">75</td>
                                    <td style="background: #ccc">Predikat</td>
                                    <td style="background: #ccc">B</td>
                                    <td style="background: #ccc">Nilai</td>
                                    <td style="background: #ccc">98</td>
                                    <td style="background: #ccc">Predikat</td>
                                    <td style="background: #ccc">A</td>
                                <tr>
                                <tr>
                                    <td colspan="4">
                                        Deskripsi Pengetahuan
                                    </td>
                                    <td colspan="4">
                                        Deskripsi Keterampilan
                                    </td>
                                </tr>
                            @endfor 
                            </tbody>
                    </table>
                    {{-- <hr>  --}}
                
                <br>
                <h5>C. Muatan Lokal</h5>
                <table border="1" width="100%" class="table-mulok">
                    <thead>
                        <tr>
                            <th colspan="2">Muatan Lokal</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                            <th>Klasifikasi</th>
                            <th>Nilai</th>
                            <th>Predikat</th>
                            <th>Klasifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($m = 0; $m < 2; $m++)
                            <tr>
                                <td>9</td>
                                <td>Bahasa Jawa</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <br>
                <h5>D. Ekstrakurikuler</h5>
                <table border="1" class="table-ekskul">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kegiatan</th>
                            <th>Predikat</th>
                            <th>Klasifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($ex = 0; $ex < 4; $ex++)
                            <tr>
                                <td>{{ $ex+1 }}</td>
                                <td>Ekstra</td>
                                <td>Ekstra</td>
                                <td>Ekstra</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <br>
                <h5>E. Saran-saran</h5>
                <div class="box-saran" style="width:100%; border: 1px solid #000; box-sizing:border-box; padding: 20px;">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti unde ad minima, sit quas architecto voluptates nam sunt facilis totam natus, quasi, rerum atque vero nostrum iste tempore iure veritatis?
                </div>
                <br>
                <h5>F. Ketidakhadiran</h5>
                <table border="1" class="table-kehadiran">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Sakit</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Ijin</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Tanpa Keterangan</td>
                            <td>5</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row no-break-before">
                    <div class="col-sm-3 text-center">
                        Mengetahui <br>
                        Orang Tua/Wali Murid
                        <br>
                        <br>
                        <br>
                        <br>
                        <u>............................................</u>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3  text-center">
                        {{ $sekolah->kelurahan }}, <span id="tanggal"></span><br>
                        Wali Kelas {{ $data->rombels->nama_rombel }}
                        <br>
                        <br>
                        <br>
                        <br>
                        <u><b>{{ Auth::user()->fullname }}</b></u><br>
                        NIP. {{ Auth::user()->nip }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4  text-center">
                        Mengetahui, <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <u><b>{{ $sekolah->kepsek}}</b></u><br>
                        NIP. {{ $sekolah->nip_kepsek }}
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </div>
        
    
    @elseif($page == 'pts')
        <div class="row">
            <div class="raport" style="width:100%">
                <div class="kop-raport">
                    <h4 class="text-center">
                        LAPORAN HASIL PENILAIAN TENGAH SEMESTER {{ $_GET['semester'] }} (PTS) {{ ($_GET['semester'] == '1' ? 'GANJIL' : 'GENAP') }}
                    </h4>
                    <h5 class="text-center">Tahun Pelajaran {{ $_GET['tapel'] }}</h5>
                    <h5 class="text-center">Kelas {{ $data->rombels->nama_rombel }}</h5>

                    <table>
                        <tr>
                            <td>NAMA PESERTA DIDIK</td>
                            <td>:</td>
                            <td>{{ $data->nama_siswa }}</td>
                        </tr>
                        <tr>
                            <td>NOMOR INDUK SISWA</td>
                            <td>:</td>
                            <td>{{ $data->nis }}</td>
                        </tr>
                        <tr>
                            <td>NISN</td>
                            <td>:</td>
                            <td>{{ $data->nisn }}</td>
                        </tr>
                    </table>
                </div>
                <hr>
                    <table border="1" style="width:100%" class="table-pts">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KOMPONEN</th>
                                <th>N.P.H.</th>
                                <th>PTS</th>
                                <th>RERATA</th>
                                <th>PREDIKAT</th>
                                <th>KLASIFIKASI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($n=0;$n <10; $n++)
                                <tr>
                                    <td class="text-center">{{ $n+1 }}</td>
                                    <td>Mapel</td>
                                    <td class="text-center">92</td>
                                    <td class="text-center">90</td>
                                    <td class="text-center">91</td>
                                    <td class="text-center">A</td>
                                    <td class="text-center">Sangat baik</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    <hr>
                    <h5>Ekstrakurikuler</h5>
                    <table border="1" class="table-ekskul">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kegiatan</th>
                                <th>Predikat</th>
                                <th>Klasifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($ex = 0; $ex < 4; $ex++)
                                <tr>
                                    <td>{{ $ex+1 }}</td>
                                    <td>Ekstra</td>
                                    <td>Ekstra</td>
                                    <td>Ekstra</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    <hr>
                    <h5>Ketidakhadiran</h5>
                    <table border="1" class="table-kehadiran">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sakit</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Ijin</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Tanpa Keterangan</td>
                                <td>5</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                <div class="row">
                    <div class="col-sm-3 text-center">
                        Mengetahui <br>
                        Orang Tua/Wali Murid
                        <br>
                        <br>
                        <br>
                        <br>
                        <u>............................................</u>
                    </div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3  text-center">
                        {{ $sekolah->kelurahan }}, <span id="tanggal"></span><br>
                        Wali Kelas {{ $data->rombels->nama_rombel }}
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
    @endif
    </div>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script>
        function cetak() {
            var date = new Date();
            var bulans = ['Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
            var tanggal = date.getDate()+' '+ bulans[date.getMonth()] + ' ' +date.getFullYear();
            tgl = document.getElementById('tanggal');
            tgl.innerHTML = tanggal;
            window.print();
        }
        function tutup() {
            // window.close();
        }
    </script>
</body>
</html>