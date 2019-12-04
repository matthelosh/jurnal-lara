<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-item-center">
					<h4 class="card-title mr-auto p-3"><i class="fa fa-calendar-o d-md-inline"></i><span class="d-none d-sm-inline">Data jadwal</span></h4>
					
					<div class="btn-group">
						<button class="btn btn-danger btn-sm btn-add-jadwal">
							<span class="d-md-none">
								<i class="fa fa-calendar-plus"></i>
							</span>
							<span class="d-none d-md-block">
								Tambah Jadwal
							</span>
						</button>
						<button class="btn btn-success btn-sm btn-import-jadwals">Import</button>
						<form action="/import/jadwals" method="post" enctype="multipart/form-data">
							@csrf
						<input type="file" id="fileJadwal" name="fileJadwal" style="display:none;">
						<button class="btn btn-primary btn-sm" type="submit" id="btn-import-jadwals" style="display:none"></button>
						</form>

					</div>
				</div>
			</div>
			<div class="card-body">
					@if(session('status') !== null)
						@if(Session::get('status') == 'sukses')
							<div class="row">
								<div class="col-sm-12">
									<div class="alert alert-success">
										{{ session('msg') }}
									</div>
								</div>
							</div>
						@else
							<div class="row">
								<div class="col-sm-12">
									<div class="alert alert-danger">
										{{ session('msg') }}
									</div>
								</div>
							</div>
						@endif
					@endif
				<div class="table-responsive">
					<table class="table table-striped table-sm" role="grid" width="100%" id="table-jadwals">
						<thead>
							<tr>
								<th>No</th>
								<th>Hari</th>
								<th>Guru Pengajar</th>
								<th>Mata Pelajaran</th>
								<th>Kelas / Rombel</th>
								<th>Jam Ke</th>
								<th>Opsi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

