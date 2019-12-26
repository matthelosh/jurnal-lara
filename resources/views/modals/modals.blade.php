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
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txt-fullname" id="txt-fullname" placeholder="Nama Lengkap">
                                </div>
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
                                    <input type="text" class="form-control" name="txt-level" id="txt-level" placeholder="Level">
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
					<form action="" class="form" id="form-add-siswa">
						<input type="hidden" id="id_siswa">
						<input type="hidden" class="mode-form">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control" name="nis" id="nis" placeholder="NIS">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control" name="nisn" id="nisn" placeholder="NISN">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
								<div class="form-group">
									<input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<select name="jk" id="jk" class="form-control">
										<option value="0">Jenis Kelamin</option>
										<option value="l">Laki-laki</option>
										<option value="p">Perempuan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<input type="text" class="form-control" id="rombel_id" name="rombel_id" placeholder="Rombel">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<div class="btn-group float-right">
									<button class="btn btn-danger btn-sm" type="reset">Batal</button>&nbsp;
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

{{-- Modal Tambah Rombel --}}
<div class="modal fade" id="modal-rombel" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Rombel</h4>
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
								<input type="text" class="form-control" id="guru_id" name="guru_id" placeholder="Wali Kelas">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="float-right">
								<button class="btn btn-sm btn-danger" type="reset">batal</button>
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
						
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" id="hari" name="hari" placeholder="Hari" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" id="guru_id" name="guru_id" placeholder="ID/NIP Guru" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<input type="text" class="form-control" name="mapel_id" id="mapel_id" placeholder="Kode Mapel">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-8">
							<div class="form-group">
								<input type="text" class="form-control" name="rombel_id" id="rombel_id" placeholder="Kode Rombel">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<input type="text" class="form-control" name="jamke" id="jampe" placeholder="Jamke">
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
							<input type="time" class="form-control" id="mulai" name="mulai">
						</div>
						<div class="form-group col-sm-6">
							<label for="selesai">Selesai</label>
							<input type="time" class="form-control" id="selesai" name="selesai">
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