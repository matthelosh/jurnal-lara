<div class="d-flex align-items-top justify-content-around">
	<div class="card card-custom" style="width:500px;">
		<div class="card-header">
			<div class="card-media">
                <img src="/img/bg.jpg" alt="Card-header">
            </div>
            <div class="logo-sekolah" style="background: #fff url('/img/logo.png');background-size: contain; background-position: center; background-repeat:no-repeat;">
                <button class="close btn-edit-logo" style="display:none;">
                    <i class="nc-icon nc-camera-20"></i>
                </button>
                <input type="file" name="imgLogo" id="imgLogo" style="display:none">
            </div>
			<h4 class="card-title">
				<i class="nc-icon nc-bank"></i>
                Data Sekolah
                <button class="close btn-edit-sekolah">
                        <i class="fa fa-edit"></i>
                    </button>
            </h4>
           
		</div>
		<div class="card-body">
        @if($info_sekolah)
			<table width="100%">
                <tr>
                    <td>NPSN</td>
                    <td>: </td>
                    <td>{{$info_sekolah->npsn}}</td>
                </tr>
                <tr>
                    <td>NSS</td>
                    <td>:</td>
                    <td> {{$info_sekolah->nss}}</td>
                </tr>
                <tr>
                    <td>Nama Sekolah</td>
                    <td>:</td>
                    <td> {{$info_sekolah->nama_sekolah}}</td>
                </tr>
                <tr>
                    <td>Kepala Sekolah</td>
                    <td>: </td>
                    <td>{{$info_sekolah->kepsek}}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>: </td>
                    <td> {{$info_sekolah->nip_kepsek}}</td>
                </tr>
                <tr>
                    <td>Garis Bujur</td>
                    <td>: </td>
                    <td> {{$info_sekolah->lat}}</td>
                </tr>
                <tr>
                    <td>Garis Lintang</td>
                    <td>: </td>
                    <td> {{$info_sekolah->long}}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td> {{$info_sekolah->alamat_sekolah}}</td>
                </tr>
                <tr>
                    <td>Desa/Kelurahan</td>
                    <td>:</td>
                    <td> {{$info_sekolah->kelurahan}}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td> {{$info_sekolah->kec}}</td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td>:</td>
                    <td> {{$info_sekolah->kota}}</td>
                </tr>
                <tr>
                    <td>Propinsi</td>
                    <td>:</td>
                    <td> {{$info_sekolah->prov}}</td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td>:</td>
                    <td> {{$info_sekolah->telepon}}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td> {{$info_sekolah->email}}</td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td>:</td>
                    <td> {{$info_sekolah->website}}</td>
                </tr>
                <tr>
                    <td>Mode GPS</td>
                    <td>:</td>
                    <td>
                        <div class="custom-control custom-switch">
                            @php($checked = ($info_sekolah->gps == 'on') ? 'checked' : '')
                            <input type="checkbox" class="custom-control-input" id="gps-switch" {{ $checked }}>
                            <label for="gps-switch" class="custom-control-label">{{ $info_sekolah->gps }}</label>
                        </div>
                    </td>
                </tr>
                {{-- <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="switch1">
                    <label class="custom-control-label" for="switch1">Toggle me</label>
                </div> --}}
            </table>
        @else
            <div class="alert alert-danger">Data Sekolah Belum dibuat. <button class="btn btn-sm" id="btn-create-sekolah"><i class="fa fa-plus"></i> Buat Sekarang</button></div>
        @endif
		</div>
	</div>
	{{-- <div class="card">
        <div class="card-body" style="width:400px">
            <div class="container">
                    <form class="col s12" id="form-lokasi-sekolah">
                        <div class="row">
                            <h4 class="card-title">Lokasi sekarang</h4>
                            <div id="google-maps" style="height: 400px; width:100%"></div>
        
                            <!-- input untuk menampung koordinat -->
                            <input type="hidden" name="longitude" value="" />
                            <input type="hidden" name="latitude" value="" />
        
                            <br>
                            
                        </div>
                        <hr>
                        <div class="row">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save left"></i>Simpan</button>
                        </div>
                    </form>
        
                </div>
        </div>
    </div> --}}
</div>

