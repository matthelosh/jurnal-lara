{{-- Modal Users --}}
<div class="modal fade" id="modal-user" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-white">
                <h5 class="modal-title">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="" class="form" id="form-add-user">
                    	<input type="hidden" class="mode-form">
                        <input type="hidden" id="id_user" name="id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txt-nip" id="txt-nip" placeholder="NIP" autofocus="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txt-username" id="txt-username" placeholder="Username">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txt-email" id="txt-email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txt-password" id="txt-password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txt-fullname" id="txt-fullname" placeholder="Nama Lengkap">
                                </div>
                            </div>
							<div class="col-sm-5">
								<select name="jk" id="jk" class="form-control">
									<option value="0">Jenis Kelamin</option>
									<option value="l">Laki-laki</option>
									<option value="p">Perempuan</option>
								</select>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txt-hp" id="txt-hp" placeholder="no. HP">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {{-- <input type="text" class="form-control" name="txt-level" id="txt-level" placeholder="Level"> --}}
                                    <select name="txt-level" id="txt-level" class="form-control">
                                    	<option value="0">Pilih Level</option>
                                    	<option value="guru">Guru</option>
                                    	<option value="staf">Staf TU</option>
                                    	<option value="katu">Kepala TU</option>
                                    	<option value="ks">Kepala Sekolah</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="col-sm-12">
                                <div class="form-group d-flex align-items-center">
                                    <button class="btn btn-sm btn-danger solid" type="reset">Batal</button>
                                    &nbsp;
                                    <button class="btn btn-sm btn-primary solid btn-submit-user" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Siswa --}}
<div class="modal fade" id="modal-siswa" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Siswa</h5>
				<button class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<div class="card">
					
					<div class="card-body">
						
						<form action="" class="form" id="form-add-siswa" enctype="multipart/form-data">
							<input type="hidden" id="id_siswa">
							<input type="hidden" class="mode-form">
							<div class="row">
								<div class="col-sm-3">
									<img class="img img-thumbnail img-siswa tootltip" id="img-holder" src="/img/avatar-siswa-l.png" alt="Foto Siswa" width="100px" onclick="document.getElementById('img-siswa').click()" style="cursor:pointer;" title="Click untuk mengganti foto.">
									<input type="file" name="img-siswa" id="img-siswa" style="display:none;" onchange="document.getElementById('img-holder').src = window.URL.createObjectURL(this.files[0])">
								</div>
								
								<div class="form-group col-sm-4">
										<label for="nis">NIS</label>
										<input type="text" class="form-control" name="nis" id="nis" placeholder="NIS">
								</div>
								<div class="form-group col-sm-5">
										<label for="nisn">NISN</label>
										<input type="text" class="form-control" name="nisn" id="nisn" placeholder="NISN">
								</div>
								
							</div>
							<div class="row">
									<div class="form-group col-sm-8">
										<label for="nama_siswa">Nama Lengkap</label>
										<div class="input-group">
											<input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-id-card-alt"></i></span>
											</div>
										</div>
									</div>
									<div class="form-group col-sm-4">
										<label for="jk">Jenis Kelamin</label>
										<select name="jk" id="jk_siswa" class="form-control">
											<option value="0">Jenis Kelamin</option>
											<option value="l">Laki-laki</option>
											<option value="p">Perempuan</option>
										</select>
									</div>
							</div>
							<div class="row">
									<div class="form-group col-sm-6">
										<label for="rombel_siswa">Rombel</label>
										<div class="input-group">
											<select name="rombel_id" id="rombel_siswa" class="selRombel" style="width:auto"></select>
											<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-building"></i></span>
											</div>
										</div>
									</div>
									<div class="form-group col-sm-6">
										<label for="hp_ortu">No. HP</label>
										<div class="input-group">
											<input type="text" name="hp_ortu" class="form-control" id="hp_ortu">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-phone"></i></span>
											</div>
										</div>
									</div>
									
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="ortu">Ortu</label>
									<div class="input-group">
										<input type="text" class="form-control" name="ortu_id" id="ortu_id">
										<div class="input-group-append">
											<span class="input-group-text"><i class="fa fa-users"></i></span>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="card-action">
									<div class="form-group col-sm-12 d-flex justify-content-center">
										<div class="btn-group">
											<button class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>&nbsp;
											<button class="btn btn-info btn-sm" type="submit">Simpan</button>
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

{{-- Modal ortu --}}
<div class="modal fade" id="modal-ortu">
	<div class="modal-dialog modal-full" style="width:100%;max-width:95%!important;bottom:0!important;">
		<div class="modal-content">
			<div class="modal-header bg-secondary" style="padding-top:5px;">
				<h4 style="margin:0!important;">Data Orang Tua</h4>
				<button class="close" data-dismiss="modal" style="padding:5px!important;margin-top:-5px;">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="form" id="form-ortu">
				<input type="hidden" name="mode" value="create">
				<input type="hidden" name="id_ortu" value="">
					<div class="container">
						<div class="row">
							<div class="col-sm-4">
								<label for="nik_aktif">NIK Ortu</label>
								<input type="text" class="form-control" id="nik_aktif" name="nik_aktif" required>
							</div>
							<div class="col-sm-4">
								<label for="email_aktif">Email Ortu</label>
								<input type="text" class="form-control" id="email_aktif" name="email_aktif">
							</div>
							<div class="col-sm-4">
								<label for="hp_aktif">HP Ortu</label>
								<input type="text" class="form-control" id="hp_aktif" name="hp_aktif">
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-4">
								<h5>DATA ORANG TUA</h5>
								<table>
									<tr>
										<td>Nama Ayah</td>
										<td><input type="text" class="form-control" id="nama_ayah" name="nama_ayah"></td>
									</tr>
									<tr>
										<td>Pekerjaan Ayah</td>
										<td><input type="text" class="form-control" id="job_ayah" name="job_ayah"></td>
									</tr>
									<tr>
										<td>Nama Ibu</td>
										<td><input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required></td>
									</tr>
									<tr>
										<td>Pekerjaan ibu</td>
										<td><input type="text" class="form-control" id="job_ibu" name="job_ibu"></td>
									</tr>
								</table>
							</div>
							<div class="col-sm-4">
								<h5>ALAMAT ORANG TUA</h5>
								<table>
									<tr>
										<td>Jl / Dusun</td>
										<td><input type="text" class="form-control" id="jl_ortu" name="jl_ortu" required></td>
									</tr>
									<tr>
										<td>Desa / Kelurahan</td>
										<td><input type="text" class="form-control" id="desa_ortu" name="desa_ortu"></td>
									</tr>
									<tr>
										<td>Kecamatan</td>
										<td><input type="text" class="form-control" id="kec_ortu" name="kec_ortu"></td>
									</tr>
									<tr>
										<td>Kabupaten / Kota</td>
										<td><input type="text" class="form-control" id="kab_ortu" name="kab_ortu"></td>
									</tr>
									<tr>
										<td>Propinsi</td>
										<td><input type="text" class="form-control" id="prov_ortu" name="prov_ortu"></td>
									</tr>
									
								</table>
							</div>
							<div class="col-sm-4">
								<h5>DATA WALI (Jika Ada)</h5>
								<table>
									<tr>
										<td>Nama wali</td>
										<td><input type="text" class="form-control" id="nama_wali" name="nama_wali"></td>
									</tr>
									<tr>
										<td>Pekerjaan wali</td>
										<td><input type="text" class="form-control" id="job_wali" name="job_wali"></td>
									</tr>
									
								</table>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-12">
								<div style="display:flex; justify-content:center;">
									<button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

{{-- Modal Tambah Rombel --}}
<div class="modal fade" id="modal-rombel" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Buat Rombel</h4>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="form" id="form-add-rombel">
					<input type="hidden" name="rombel_id" class="rombel_id">
					<input type="hidden" name="mode-form" class="mode-form">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control" name="kode_rombel" id="kode_rombel" placeholder="Kode Rombel" autofocus>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								<input type="text" class="form-control" id="nama_rombel" name="nama_rombel" placeholder="Nama Rombel">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<select type="text" class="form-control selGuru" id="guru_id" name="guru_id" placeholder="Wali Kelas" style="width:100%">
									<option value="0">-- Pilih Wali Kelas --</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="float-right">
								<button class="btn btn-sm btn-danger" data-dismiss="modal">batal</button>
								<button class="btn btn-sm btn-info btn-submit-rombel" type="submit">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

{{-- Modal Manajemen Anggota Rombel --}}
<div class="modal fade" id="modal-mnj-rombel" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl">
	        <div class="modal-content">
	            {{-- <div class="container"> --}}
	                <div class="card">
	                
	                    <div class="card-header card-header-success">
	                        <button class="close" data-dismiss="modal" >&times;</button>
	                        <h4 class="card-title">Manajemen Rombel <span id="namaRombel"></span></h4>
	                        
	                    </div>
	                    <div class="card-body">
	                        <div class="row">
	                            <div class="col-sm-6" id="member">
	                                <div class="container">
	                                    <div class="row" id="op-member">
	                                        <div class="col-sm-4">
	                                            {{-- <label for="sel2Rombel">Pindah Ke Rombel:</label> --}}
	                                            <select name="sel2Rombel" id="sel2Rombel" class="sel2Rombel form-control">
	                                                    {{-- <option value="0">Pindah Rombel</option> --}}
	                                                </select>
	                                        </div>
	                                        <div class="col-sm-6">
	                                            <button class="btn btn-sm btn-warning" id="pindahkan">Pindah <span data-feather="shuffle"></span></button>
	                                            <button class="btn btn-sm btn-danger" id="keluarkan">Keluar <span data-feather="wind"></span></button>
	                                        </div>
	                                        <div class="col-sm-2">

	                                        </div>

	                                    </div>
	                                    <hr>
	                                    <div class="row" id="data-member">
											<div id="progress-tmembers" class="d-none progress-table justify-content-center align-items-center" >
													<img src="{{ asset('/img/loader.png') }}" alt="" class="loader" style="height:100px;height:100px;">
												</div>
	                                        <div class="table-responsive">
	                                            <table class="table table-sm" width="100%" id="tmembers" >
	                                                {{-- <caption style="caption-side: top;">Anggota Rombel</caption> --}}
	                                                <thead>
	                                                    <tr>
	                                                        <th>No</th>
	                                                        <th>NIS</th>
	                                                        <th>NISN</th>
	                                                        <th>Nama</th>
	                                                    </tr>
	                                                </thead>
	                                                <tbody id="tbody-members">

	                                                </tbody>
	                                            </table>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="col-sm-6" id="non-member">
	                                <div class="container">
	                                    <div class="row" id="op-non-member">
	                                        <div class="col-sm-6">
	                                            <button class="btn btn-sm btn-primary" id="masukkan">Masukkan <span data-feather="chevrons-left"></span></button>

	                                        </div>
	                                    </div>
	                                    <hr>
	                                    <div class="row" id="data-non-member">

	                                            <div class="table-responsive">
	                                                <table class="table table-sm" width="100%" id="tnonmembers">
	                                                    <thead>
	                                                        <tr>
	                                                            <th>No</th>
	                                                            <th>NIS</th>
	                                                            <th>NISN</th>
	                                                            <th>Nama</th>
	                                                        </tr>
	                                                    </thead>
	                                                    <tbody id="tbody-nonmembers">

	                                                    </tbody>
	                                                </table>
	                                            </div>
	                                    {{-- </div> --}}
	                                    </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            {{-- </div> --}}
	        </div>
	    </div>
	</div>
</div>

{{-- Modal Mapel --}}
<div class="modal fade" id="modal-mapel" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Mapel</h4>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="form" id="form-add-mapel">
					<input type="hidden" name="mapel_id" class="mapel_id">
					<input type="hidden" name="mode-form" class="mode-form">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control" name="kode_mapel" id="kode_mapel" placeholder="Kode Mapel" autofocus required>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								<input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Nama Mapel" required>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12">
							<div class="float-right">
								<button class="btn btn-sm btn-danger" type="reset" data-dismiss="modal">batal</button>
								<button class="btn btn-sm btn-info btn-submit-rombel" type="submit">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

{{-- Modal Jam Pelajaran --}}
<div class="modal fade" id="modal-jampel" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Jam Pelajaran</h4>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="form" id="form-add-jampel">
					<input type="hidden" name="jampel_id" class="jampel_id">
					<input type="hidden" name="mode-form" class="mode-form">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control" name="label" id="label" placeholder="Label Jampel" autofocus required>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="time" class="form-control" id="mulai" name="mulai" placeholder="Waktu Awal" required>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="time" class="form-control" id="selesai" name="selesai" placeholder="Waktu Akhir" required>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12">
							<div class="float-right">
								<button class="btn btn-sm btn-danger" type="reset" data-dismiss="modal">batal</button>
								<button class="btn btn-sm btn-info btn-submit-jampel" type="submit">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

{{-- Modal Jadwal Pelajaran --}}
<div class="modal fade" id="modal-jadwal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Jadwal Pelajaran</h5>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="form" id="form-add-jadwal">
					<input type="hidden" name="jadwal_id" class="jadwal_id">
					<input type="hidden" name="mode-form" class="mode-form">
					<div class="row">
						
						<div class="col-sm-4">
							<div class="form-group">
								<select class="form-control selHari" id="hari" name="hari" placeholder="Hari" required style="width:100%">
									<option value="0">--Hari--</option>
									<option value="Senin">Senin</option>
									<option value="Selasa">Selasa</option>
									<option value="Rabu">Rabu</option>
									<option value="Kamis">Kamis</option>
									<option value="Jumat">Jumat</option>
									<option value="Sabtu">Sabtu</option>
									<option value="Minggu">Minggu</option>
								</select>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								<select class="form-control selGuru" id="nip_guru" name="nip_guru" placeholder="ID/NIP Guru" required style="width:100%">
									<option value="0">-- Pilih Guru --</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<select class="form-control selMapel" name="mapel_id" id="mapel_id" placeholder="Kode Mapel" style="width:100%">
									<option value="0">-- Pilih Mapel --</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-5">
							<div class="form-group">
								<select  class="form-control selRombel" name="rombel_id" id="rombel_id" placeholder="Kode Rombel" style="width:100%">
									<option value="0">-- Pilih Rombel --</option>
								</select>
							</div>
						</div>
						<div class="col-sm-2">
							Jamke:
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								{{-- <input type="text" class="form-control" name="jamke" id="jamke" placeholder="Jamke"> --}}
								<select class="form-control" name="jamstart" id="jamstart" placeholder="Mulai">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
								</select>
							</div>
						</div>
						<div class="col-sm-1">s/d</div>
						<div class="col-sm-2">
							<div class="form-group">
								{{-- <input type="text" class="form-control" name="jamke" id="jamke" placeholder="Jamke"> --}}
								<select class="form-control" name="jamend" id="jamend" placeholder="Selesai">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option></select>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="float-right">
								<button class="btn btn-sm btn-danger" type="reset" data-dismiss="modal">batal</button>
								<button class="btn btn-sm btn-info btn-submit-jadwal" type="submit">Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

{{-- Modal Data Sekolah --}}
<div class="modal fade" id="modal-sekolah" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data Sekolah</h4>
				<button class="close" data-dismiss="modal">
					&times;
				</button>		
			</div>
			<div class="modal-body">
				<form action="" class="form" id="form-data-sekolah">
					<input type="hidden" name="id" id="id">
					<input type="hidden" name="mode" id="mode">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control" name="npsn" id="npsn" placeholder="NPSN">
							</div>
						</div>
						<div class="col-sm-8">
							<div class="form-group">
								<input type="text" class="form-control" name="nss" id="nss" placeholder="NSS">
							</div>
						</div>
					</div> {{-- End Row --}}
					<div class="row">
						<div class="col-sm-10">
							<div class="form-group">
								<input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" placeholder="Nama Sekolah">
							</div>
						</div>
						
					</div> {{-- End Row --}}
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" name="kepsek" id="kepsek" placeholder="Kepala Sekolah">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" name="nip_kepsek" id="nip_kepsek" placeholder="NIP Kepala Sekolah">
							</div>
						</div>
					</div> {{-- End Row --}}
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" name="lat" id="lat" placeholder="Garis Bujur">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" name="long" id="long" placeholder="Garis Lintang">
							</div>
						</div>
					</div> {{-- End Row --}}
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" name="alamat_sekolah" class="form-control" id="alamat_sekolah" placeholder="Alamat Jl/Dusun">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" name="kelurahan" class="form-control" id="kelurahan" placeholder="Desa/Kelurahan">
							</div>
						</div>
					</div> {{-- End Row --}}
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" name="kec" class="form-control" id="kec" placeholder="Kecamatan">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" name="kota" class="form-control" id="kota" placeholder="Kota/Kabupaten">
							</div>
						</div>
					</div> {{-- End Row --}}
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" name="prov" class="form-control" id="prov" placeholder="Propinsi">
							</div>
						</div>
					</div>
					<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<input type="text" class="form-control" name="telepon" id="telepon" placeholder="No. Telepon">
								</div>
							</div>
							<div class="col-sm-8">
								<div class="form-group">
									<input type="text" class="form-control" name="email" id="email" placeholder="Email">
								</div>
							</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<input type="text" class="form-control" name="website" id="website" placeholder="Website">
							</div>
						</div>
					</div> {{-- End Row --}}
					<div class="row">
						<div class="col-sm-12">
							<button type="reset" class="btn btn-danger block-center">batal</button>
							<button type="submit" class="btn btn-primary block-center">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>		
</div>

{{-- Modal Ijinkan Guru --}}
<div class="modal fade" id="modal-ijinkan-guru" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Ijinkan Guru: <span id="nama-guru-ijin"></span></h4>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<form action="" class="form" id="form-ijinkan-guru">
						<input type="hidden" name="kode_absen" id="kode_absen">
								<input type="hidden" name="nip" id="nip">
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="keperluan">Keperluan</label>
								<select name="keperluan" id="keperluan" class="form-control">
									<option value="0">Keperluan</option>
									<option value="dinas">Tugas Dinas</option>
									<option value="keluarga">Keluarga</option>
									<option value="sakit">Sakit</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<label for="ada_tugas">
									<input type="checkbox" name="ada_tugas" id="ada_tugas">
									Ada Tugas?
								</label>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<textarea name="tugas" id="tugas" cols="30" rows="4" placeholder="Tugas" class="form-control" disabled></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<textarea name="ket" id="ket" cols="30" rows="4" placeholder="Keterangan Tambahan" class="form-control"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-12">
								<div class="d-flex justify-content-center">
									<button class="btn btn-danger" type="reset" data-dismiss="modal">Batal</button>
									&nbsp;
									<button class="btn btn-primary" type="submit" >Kirim</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Modal Admin Rekap Kelas --}}
<div class="modal fade" id="modal-rekap-kelas" role="dialog">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				{{-- <h4>{{Session::get('wali_kelas')}}</h4> --}}
				<h4 class="modal-title">Rekap Absensi Kelas <br>
					<small>
						Kelas 
						<span id="nama_kelas"></span><br>
						Bulan 
						<span id="bulan"></span> 
						&nbsp;
						<span id="tahun"></span>
					</small>
				</h4>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm" width="100%" id="table-rekap-bulan">
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
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>	
</div>

{{-- Modal detil Absen ADmin --}}
<div class="modal fade" id="modal-detil-absen" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-header">Detail Absen Kelas <span id="nama_kelas"></span></h5>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table" width="100%" id="table-detil-absen">
						<thead>
							<tr>
								<th>No</th>
								<th>NISN</th>
								<th>Nama</th>
								<th>Presensi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Jurnal Staf --}}
<div class="modal fade" id="modal-jurnal-staf" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<h5 class="modal-title">Isi Jurnal </h5>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" class="form" id="form-jurnal-staf">
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="tanggal">Tanggal</label>
							<input type="date" name="tanggal" class="form-control" id="tanggal">
						</div>
						<div class="form-group col-sm-6">
							<label for="lokasi">Tempat</label>
							<input type="text" name="lokasi" class="form-control" id="lokasi">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12">
							<label for="kegiatan">Uraian Kegiatan</label>
							<textarea name="kegiatan" id="kegiatan" class="form-control" rows="3"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="mulai">Mulai</label>
							<input type="time" class="form-control" id="mulai-jurnal" name="mulai">
						</div>
						<div class="form-group col-sm-6">
							<label for="selesai">Selesai</label>
							<input type="time" class="form-control" id="selesai-jurnal" name="selesai">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-12 d-flex justify-contents-center">
							<button class="btn btn-primary block-center" id="btn-submit-jurnal-staf"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>