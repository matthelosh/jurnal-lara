<div class="d-flex align-items-center justify-content-center">
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
                    <td>Alamat</td>
                    <td>:</td>
                    <td> {{$info_sekolah->alamat_sekolah}}</td>
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
                
            </table>
			
		</div>
	</div>
	
</div>

