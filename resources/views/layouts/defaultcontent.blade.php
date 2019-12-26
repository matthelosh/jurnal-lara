@if(Auth::user()->level == 'admin')
   <div class="row">
       <div class="col-sm-12">
           <div class="card">
               <div class="card-header">
                @php($tgl = date('d M Y'))
                   <h5 class="card-title">Jadwal Pelajaran Hari {{$hari}}, {{$tgl}}</h5>
                   <button class="btn btn-danger float-right" id="btn-tutup-jadwal">Tutup Jadwal</button>
                {{-- {{ $jadwals->count() }} --}}
               </div>
               <div class="card-body">
                   <div class="row">
                       <div class="container">
                            <div class="alert bg-danger center-text alert-logabsen" style="display:none;">
                                    @if($hari != 'Sabtu' || $hari != 'Minggu')
                                        <div class="alert bg-danger text-center">
                                            <h3>Jadwal hari {{$hari}}, belum diaktifkan.</h3>
                                            <button class="btn btn-warning btn-lg" id="btn-aktifkan-jadwal">Aktifkan Jadwal</button>
                                        </div>
                                    @else
                                        <div class="alert bg-warning d-flex">
                                            <h3>Hari ini Libur</h3>    
                                        </div>    
                                    @endif
                                </div>
                       </div>
                   </div>
                   {{-- @if($jadwals->count() > 0 ) --}}
                        <div class="table-responsive">
                                <table class="table table-sm" id="table-log-absen" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kelas</th>
                                            <th>Mapel</th>
                                            <th>Guru</th>
                                            <th>Jam Ke</th>
                                            <th>Jml Siswa</th>
                                            <th>H</th>
                                            <th>I</th>
                                            <th>S</th>
                                            <th>A</th>
                                            <th>T</th>
                                            <th>Jurnal/Materi</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>   
                        </div>
                    {{-- @endif --}}
               </div>
           </div>
       </div>
   </div>
@elseif(Auth::user()->level == 'guru')
    <div class="row">
        <div class="container">
            <h3 class="text-center">
                Jadwal Anda hari ini:
            </h3>
        
            <div class="d-flex justify-content-around flex-md-row flex-wrap">
                @if($jadwals->count() < 1)
                    <div class="alert bg-danger text-center">
                        <h3>Tidak ada jadwal mengajar :)</h3>
                    </div>
                @else
                    <div class="card-deck">
                        @foreach($jadwals ?? '' as $jadwal)
                            <div class="card {{ ($jadwal->ket == 'jamkos') ? 'bg-danger-gradient' : 'bg-success-gradient' }} " >
                                <div class="card-body text-white">
                                    <h5>Kelas: {{$jadwal->rombels->nama_rombel}}</h5>
                                    <h5>Tanggal: {{ $jadwal->tanggal }} <br> Jamke: {{ $jadwal->jamke }}</h5>
                                    <h5>Mapel: {{ $jadwal->mapels->nama_mapel }}</h5>
                                    <a href="/dashboard/{{ ($jadwal->ket == 'jamkos') ? 'do-absen' : 'detail-absen' }}/{{ $jadwal->kode_absen }}" class="card-link stretched-link"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@elseif(Auth::user()->level == 'staf')
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="btn-group float-right">
                        <button class="btn btn-primary" id="btn-modal-jurnal-staf">Isi Jurnal</button>
                    </div>
                    <h5 class="card-title">Jurnal Saya</h5>
                    <br>
                    <hr>
                    <div class="table-responseive">
                        <table class="table" id="table-jurnalku" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Jurnal</th>
                                    <th>Tanggal</th>
                                    <th>Uraian Kegiatan</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>1</td>
                                    <td>12-09-2019</td>
                                    <td>TEs Saja</td>
                                    <td>08:00</td>
                                    <td>08:30</td>
                                    <td>Valid</td>
                                    <td>Selesai</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>12-09-2019</td>
                                    <td>Halo Saja</td>
                                    <td>08:00</td>
                                    <td>08:30</td>
                                    <td>Valid</td>
                                    <td>Selesai</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>12-09-2019</td>
                                    <td>Hi Saja</td>
                                    <td>08:00</td>
                                    <td>08:30</td>
                                    <td>Valid</td>
                                    <td>Selesai</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif(Auth::user()->level == 'katu')
    <div class="row">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h5 class="card-title">Jurnal Harian Staf</h5>
                <div class="card">
                    <div class="card-body">
                        Cek Jurnal Staf
                        <form action="" class="form" id="form-cek-jurnal-staf">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="tanggal">Tangal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                                </div>
                                <div class="form-group col-sm-1">
                                    <button class="btn btn-primary" id="btn-check-jurnal-staf">
                                        <i class="fa fa-search"></i>
                                        Cek
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jurnal Staf Hari: <span id="hari_tanggal">{{$hari}}, {{$tanggal}}</span></h5>
                        <br><hr>
                        <div class="table-responsive">
                                <table class="table" id="table-jurnal-staf" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama Staf</th>
                                            <th>Kode Jurnal</th>
                                            <th>Tanggal</th>
                                            <th>Kegiatan</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Status</th>
                                            <th>Ket</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@else
    <div class="row">
        <h3>Guru Piket</h3>
    </div>
@endif