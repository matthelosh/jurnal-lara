<div class="row">
    <div class="card" style="width:100%">
        <div class="card-body">
            <h4 class="card-title">Laporan Jurnal Staf TU</h4>
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="" class="form" id="form-cek-jurnal-staf">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <select name="staf" class="form-control selStaf staf" >
                                        <option value="0">Pilih Staf</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    @php
                                        $bulans = ['Pilih Bulan', 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'];
                                    @endphp
                                    <select name="bulan"  class="form-control bulan">
                                        @php
                                            $bulan = date('m');
                                            for($b=0; $b < count($bulans); $b++) {
                                                $selected = ($bulan == $b) ? 'selected' : '';
                                                echo '<option value="'.$b.'"'. $selected.'>'.$bulans[$b].'</option>';
                                            }   
                                        @endphp
                                        {{-- <option value="0">Bulan</option>
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
                                        <option value="12">Desember</option> --}}
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    @php($th = date('Y'))
                                    <select name="tahun"  class="form-control tahun">
                                        <option value="0">Tahun</option>
                                        @for ($i = ($th - 5) ; $i < ($th + 5); $i++)
                                            @php($terpilih = ($i == $th) ? 'selected' : '')
                                            
                                            <option value="{{ $i }}" {{$terpilih}}>{{ $i }}</option>

                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn-c btn-primary btn-laporan-jurnal-staf" type="submit"><i class="fa fa-search"></i> Lihat</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table" id="table-laporan-jurnal" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Jurnal</th>
                                                <th>Tanggal</th>
                                                <th>Kegiatan</th>
                                                <th>Lokasi</th>
                                                <th>Mulai</th>
                                                <th>Selesai</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
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
        </div>
    </div>
</div>