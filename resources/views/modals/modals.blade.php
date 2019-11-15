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

