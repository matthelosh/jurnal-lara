@if(isset($mod))
    @if($mod == 'default')
        <div class="row">
            <div class="card" style="width:100%;">
                <div class="card-body">
                    <h4 class="card-title">Pilih Bulan dan Tahun</h4>
                    <span class="d-none kode_rombel">{{$rombel->kode_rombel}}</span>
                    <span class="d-none" id="kota">{{$sekolah->kota}}</span>
                    <div class="card">
                        <div class="card-body">
                            <form action="" id="form-rekap-kelas">
                                {{-- <label for="rombel">Pilih Rombel</label> --}}
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
                                            <button class="btn-c btn-primary btn-rekap-presensi" type="submit"><i class="fa fa-search"></i> Lihat</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card" id="card-rekap-wali">
                        <div class="card-body">
                            <h4 class="card-title">Rekap Presensi Siswa Kelas {{ $rombel->nama_rombel }}</h4>
                            <h5>Bulan : <span id="bulan"></span> - <span id="tahun"></span></h5>
                            <div class="table-responsive">
                                <table class="table" id="table-rekap-absen" style="position: relative;" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Hadir</th>
                                            <th>Ijin</th>
                                            <th>Sakit</th>
                                            <th>Alpa</th>
                                            <th>Telat</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">catatan Presensi</h4>
                    <div class="table-responsive">
                        <table class="table" id="table-log-absen">
                            <thead>
                                <tr>
                                    <th>Kode Absen</th>
                                    <th>Tanggal</th>
                                    <th>Mapel</th>
                                    <th>Guru</th>
                                    <th>Hadir</th>
                                    <th>Ijin</th>
                                    <th>Sakit</th>
                                    <th>Alpa</th>
                                    <th>Telat</th>
                                    <th>Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td><a href="/dashboard/detail-absen/{{$log->kode_absen}}" title="Lihat Detail">{!! QrCode::size(40)->generate($log->kode_absen) !!}</a></td>
                                        <td>{{$log->mapels->nama_mapel}}</td>
                                        <td>{{$log->mapels->nama_mapel}}</td>
                                        <td>{{$log->gurus->fullname}}</td>
                                        <td>{{$log->hadir}}</td>
                                        <td>{{$log->ijin}}</td>
                                        <td>{{$log->sakit}}</td>
                                        <td>{{$log->alpa}}</td>
                                        <td>{{$log->telat}}</td>
                                        <td>Ket</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span class="float-right">{{$logs->links()}}</span>
                        {{-- {!! $logs !!} --}}
                    </div>
                </div>
            </div>
        </div>
    @elseif($mod == 'detil_rekap')
        <div class="row">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detil Presensi {{$siswa->nama_siswa}} <br><small>NISN: {{$siswa->nisn}}</small></h4>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jamke</th>
                                        <th>Mapel</th>
                                        <th>Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $data)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$data->tanggal}}</td>
                                            <td>{{$data->logabsens->jamke}}</td>
                                            <td>{{$data->logabsens->mapels->nama_mapel}}</td>
                                            <td>{{$data->ket}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif