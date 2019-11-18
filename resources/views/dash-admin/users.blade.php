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

