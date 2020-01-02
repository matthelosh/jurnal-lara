<div class="row">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h4 class="card-title"><i class="fa fa-print"></i> CETAK RAPORT PAS</h4>
            <form action="" class="form form-ambil-raport">
                <div class="container">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="siswa_id">Pilih Siswa</label>
                            <select name="siswa_id" id="siswa_id" class="form-control selSiswaKu" style="width:100%">
                                <option value="0">Siswa</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="semester">Semester</label>  
                            <select name="semester" id="semester" class="form-control">
                                <option value="0">Pilih Semester</option>
                                @php
                                    $bulan = date('m');
                                    $sel_ganjil = ($bulan > 6) ? 'selected' : '';
                                    $sel_genap = ($bulan < 7) ? 'selected' : '';
                                @endphp
                                <option value="1" {{ $sel_ganjil }}>I (Ganjil)</option>
                                <option value="2" {{ $sel_genap }}>II (Genap)</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="tapel">Semester</label>  
                            <select name="tapel" id="tapel" class="form-control" style="font-size: 0.9em;">
                                <option value="0">Pilih Tahun Pelajaran</option>
                                @php
                                    $th = date('Y');
                                    $month = date('m');
                                    $tapel = ($month  < 7) ? ($th-1) : $th;
                                    for($tp = ($tapel-5); $tp < ($tapel + 5); $tp++) {
                                        $selected = ($tapel == $tp) ? 'selected' : '';
                                        echo '<option value="'.$tp.'/'.($tp+1).'" '.$selected.'>'.$tp.'/'.($tp+1).'</option>';
                                    }
                                @endphp
                            </select>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for=""><span style="color:rgba(0,0,0,0);">Cek raport</span></label>
                            <button class="btn btn-danger btn-sm" style="border:none; background: red; color: #efefef;height: 34px;"><i class="fa fa-search" aria-hidden="true" ></i></button>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="#btn-cetak"><span style="color:rgba(0,0,0,0);">Cetak</span></label>
                            <button class="btn btn-primary btn-sm btn-print-raport" id="btn-cetak" style="border:none; background: teal; color: #efefef;height: 34px;"><i class="fa fa-print" aria-hidden="true"></i></button>       
                        </div>
                    </div>
                </div>
            </form>
                        
            
            
        </div>
    </div>
</div>