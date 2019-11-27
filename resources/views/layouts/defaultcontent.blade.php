@if(Auth::user()->level == 'admin')
   <div class="row">
       <div class="col-sm-12">
           <div class="card">
               <div class="card-header">
                    @php($tgl = date('d M Y'))
                   <h5 class="card-title">Jadwal Pelajaran Hari {{$hari}}, {{$tgl}}</h5>
                   <button class="btn btn-danger float-right" id="btn-tutup-jadwal">Tutup Jadwal</button>
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
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($jadwals as $jadwal)
                                            <tr>
                                                <td>{{$jadwal->rombels->nama_rombel}}</td>
                                                <td>{{$jadwal->mapels->nama_mapel}}</td>
                                                <td>{{$jadwal->gurus->fullname}}</td>
                                                <td>{{$jadwal->jamke}}</td>
                                                <td>{{$jadwal->jml_siswa}}</td>
                                                <td>{{$jadwal->hadir}}</td>
                                                <td>{{$jadwal->ijin}}</td>
                                                <td>{{$jadwal->sakit}}</td>
                                                <td>{{$jadwal->alpa}}</td>
                                                <td>{{$jadwal->telat}}</td>
                                                <td>{{$jadwal->jurnal}}</td>
                                                <td>
                                                    @if($jadwal->ket == 'jamkos')
                                                        <span style="color:red;font-weight: 600;">
                                                            {{$jadwal->ket}}
                                                        </span>
                                                    @elseif($jadwal->ket == 'mohon_ijin')
                                                        <button class="btn-c btn-danger btn-mohon-ijin">
                                                            Mohon Ijin
                                                        </button>
                                                    @else
                                                        {{$jadwal->ket}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn-c btn-warning ijinkan-guru">Ijinkan Guru</button>
                                                </td>

                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>   
                        </div>
                    {{-- @else --}}
                        {{-- <div class="alert bg-danger center-text alert-logabsen" style="display:none;">
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
                        </div> --}}
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
        
            <div class="d-flex justify-content-around flex-wrap">
                @if($jadwals->count() < 1)
                    <div class="alert bg-danger text-center">
                        <h3>Tidak ada jadwal mengajar :)</h3>
                    </div>
                @else
                    @foreach($jadwals as $jadwal)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{$jadwal->mapels->nama_mapel}}</h5>
                            </div>
                            <div class="card-body">
                                <h4>{{$jadwal->rombels->nama_rombel}}</h4>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@elseif(Auth::user()->level == 'staf')
    <div class="row">
        <h3>Jurnal Staf</h3>
    </div>
@else
    <div class="row">
        <h3>Guru Piket</h3>
    </div>
@endif