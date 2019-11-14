<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-item-center">
					<h4 class="card-title mr-auto p-3"><i class="fa fa-users d-md-inline"></i><span class="d-none d-sm-inline">Data Pengguna</span></h4>
					
					<div class="btn-group">
						<button class="btn btn-danger btn-sm btn-add-user">
							<span class="d-md-none">
								<i class="fa fa-user-plus"></i>
							</span>
							<span class="d-none d-md-block">
								Tambah Pengguna
							</span>
						</button>
						<button class="btn btn-success btn-sm btn-import-users">Import</button>
						<form action="/import/users" method="post" enctype="multipart/form-data">
							@csrf
						<input type="file" id="fileUser" name="fileUser" style="display:none;">
						<button class="btn btn-primary btn-sm" type="submit" id="btn-import-users" style="display:none"></button>
						</form>

					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-sm" role="grid" width="100%" id="table-users">
						<thead>
							<tr>
								<th>No</th>
								<th>NIP</th>
								<th>Username</th>
								<th>Nama Lengkap</th>
								<th>HP</th>
								<th>Email</th>
								<th>Level</th>
								<th>Opsi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- <div class="modal fade" id="modal-user" role="dialog">
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
						<div class="row">
							<div class="col">
								<div class="form-group">
									<input type="text" class="form-control" name="txt-nip" id="txt-nip" placeholder="NIP" autofocus="">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<input type="text" class="form-control" name="txt-username" id="txt-username" placeholder="Username">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<input type="text" class="form-control" name="txt-email" id="txt-email" placeholder="Email">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<input type="text" class="form-control" name="txt-password" id="txt-password" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<input type="text" class="form-control" name="txt-fullname" id="txt-fullname" placeholder="Nama Lengkap">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-8">
								<div class="form-group">
									<input type="text" class="form-control" name="txt-hp" id="txt-hp" placeholder="no. HP">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<input type="text" class="form-control" name="txt-level" id="txt-level" placeholder="Level">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
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
</div> --}}