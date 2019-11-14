<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="d-flex align-item-center">
					<h4 class="card-title mr-auto p-3"><i class="fa fa-users d-md-inline"></i><span class="d-none d-sm-inline">Data Rombel</span></h4>
					
					<div class="btn-group">
						<button class="btn btn-danger btn-sm btn-add-rombel">
							<span class="d-md-none">
								<i class="fa fa-plus"></i>
							</span>
							<span class="d-none d-md-block">
								Tambah Rombel
							</span>
						</button>
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
					<table class="table table-striped table-sm" role="grid" width="100%" id="table-rombels">
						<thead>
							<tr>
								<th>No</th>
								{{-- <th>Kode Rombel</th> --}}
								<th>Nama Rombel</th>
								<th>Wali Kelas</th>
								<th>Jml Siswa</th>
								<th>Opsi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

