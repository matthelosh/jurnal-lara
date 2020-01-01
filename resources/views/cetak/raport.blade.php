<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raport {{ $page }}</title>
    <link rel="stylesheet" href="http://{{ $_SERVER['HTTP_HOST'] }}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="http://{{ $_SERVER['HTTP_HOST'] }}/css/umum.css" type="text/css">
</head>
<body>
    <div class="container-fluid">
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
                                        <td>Bejo Kumayangan</td>
                                    </tr>
                                    <tr>
                                        <td>NISN/NIS</td>
                                        <td>:</td>
                                        <td>987978968 / 1025</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Sekolah</td>
                                        <td>:</td>
                                        <td>SD NEgeri 1 Bedalisodo</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Sekolah</td>
                                        <td>:</td>
                                        <td style="width: 65%; ">Jl. Raya Sengon No. 293 Dalisodo Kec. Wagir <br>Kab. Malang 65168</td>
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
                                        <td>VI (Enam)</td>
                                    </tr>
                                    <tr>
                                        <td>Semester</td>
                                        <td>:</td>
                                        <td>11 (Ganjil)</td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Pelajaran</td>
                                        <td>:</td>
                                        <td>2019/2020</td>
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
                @for ($i = 0; $i < 6; $i++)
                    <table border="1" width="100%" class="table-k3">
                        <thead class="thead-inverse">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Mupel</th>
                                <th colspan="4">Pengetahuan</th>
                                <th colspan="4">Keterampilan</th>
                            </tr>
                                <th>Nilai</th>
                                <th>75</th>
                                <th>Predikat</th>
                                <th>B</th>
                                <th>Nilai</th>
                                <th>98</th>
                                <th>Predikat</th>
                                <th>A</th>
                            <tr>

                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">
                                        {{ $i+1 }}
                                    </td>
                                    <td>
                                        Mapel
                                    </td>
                                    <td colspan="4">
                                        Deskripsi Pengetahuan
                                    </td>
                                    <td colspan="4">
                                        Deskripsi Keterampilan
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                    {{-- <hr>  --}}
                @endfor 
                <br>
                <h5>C. Muatan Lokal</h5>
                <table border="1" width="100%">
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
                <table border="1">
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
                <h5>Ketidakhadiran</h5>
                <table border="1">
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
            </div>
        </div>
    </div>
    
</body>
</html>