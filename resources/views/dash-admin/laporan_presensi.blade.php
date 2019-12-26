<div class="row">
    <div class="container">
        <div class="card-deck">
            <div class="card" style="width:350px">
                <div class="card-body">
                    <div class="card-title">Laporan Presensi Kelas</div>
                    <div class="container">
                        <form action="" id="form-rekap-kelas">
                            {{-- <label for="rombel">Pilih Rombel</label> --}}
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <select name="rombel" class="form-control selRombel rombel" >
                                        <option value="0">Pilih Rombel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-7">
                                    <select name="bulan"  class="form-control bulan">
                                        <option value="0">Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Pebruari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">Nopember</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-5">
                                    @php($th = date('Y'))
                                    <select name="tahun"  class="form-control tahun">
                                        <option value="0">Tahun</option>
                                        @for ($i = ($th - 5) ; $i < ($th + 5); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>

                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn-c btn-primary btn-rekap-presensi-kelas" type="submit"><i class="fa fa-search"></i> Lihat</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card" style="width:350px">
                <div class="card-body">
                    <div class="card-title">Laporan Presensi Guru</div>
                    <div class="container">
                        <form action="" id="form-rekap-jurnal">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <select name="guru" class="form-control selGuru guru" >
                                        <option value="0">Pilih Guru</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-7">
                                    <select name="bulan" class="form-control bulan">
                                        <option value="0">Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Pebruari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">Nopember</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-5">
                                    @php($th = date('Y'))
                                    <select name="tahun" class="form-control tahun">
                                        <option value="0">Tahun</option>
                                        @for ($i = ($th - 5) ; $i < ($th + 5); $i++)
                                            <option value="{{ $i }} ">{{ $i }}</option>

                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn-c btn-primary btn-rekap-presensi-guru" type="submit"><i class="fa fa-search"></i> Lihat</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="container">
        <div class="col-sm-12">
            <div class="card">
                <div id="progress-trekaplog" class="d-none progress-table justify-content-center align-items-center" >
                        <img src="{{ asset('/img/loader.png') }}" alt="" class="loader" style="height:100px;height:100px;">
                    </div>
                <div class="card-body">
                    <div class="h4 card-title">Log Absen</div>
                    <div class="table-responsive">
                        <table class="table" id="table-rekap-log-absen" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Absen</th>
                                    <th>Tanggal</th>
                                    <th>Mapel</th>
                                    <th>Rombel</th>
                                    <th>Guru</th>
                                    <th>Siswa</th>
                                    <th>Hadir</th>
                                    <th>Ijin</th>
                                    <th>Sakit</th>
                                    <th>Alpa</th>
                                    <th>Telat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>