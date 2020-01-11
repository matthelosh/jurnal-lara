<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Presensi Siswa Kelas {{ $rombel->nama_rombel }}</h4>
			</div>
			<div class="card-body">
				@if(Session::get('status') == 'error')
					<div class="alert alert-danger">
						<h3>{{ Session::get('errCode') }} : {{ Session::get('errMsg') }}</h3>
					</div>
				@endif
				<form action="/absen/do" id="form-absen" method="post"> 
					@csrf()
					<input type="hidden" name="kode_absen" value="{{ $kode_absen }}">
					<div class="card-column">
						@foreach($siswas as $siswa)
							<input type="hidden" name="nisn[]" value="{{ $siswa->nisn }}">
							<div class="card card-border-primary">
								<div class="card-body">
									
										<div class="d-flex align-items-end justify-content-between justify-content-md-start" style="border-bottom: 1px dashed #333;">
											<p>
												@if($siswa->foto == '0')
													@if($siswa->jk == 'l')
														<img src="/img/avatar-siswa-l.png" alt="Avatar"  class="img navbar-face">
													@else
														<img src="/img/avatar-siswa-p.png" alt="Avatar"  class="img navbar-face">
													@endif
												@else
													<img src="/img/siswas/{{ $siswa->nisn }}.jpg" alt="Avatar" width="50px" height="50px" class="img rounded-circle">
												@endif
											</p>
											<p class="mr-3 ml-3">{{ $siswa->nisn }}</p>
											<p style="font-size: 10pt;">{{ $siswa->nama_siswa }}</p>
										</div>
										<div class="d-flex justify-content-between justify-content-md-start mt-md-3">
											<p class="ml-md-5 mr-md-5"><label for="ket"><input type="radio" name="ket-{{ $siswa->nisn }}" id="ket-{{ $siswa->nisn }}" value="h" class="form-control" {{ ($siswa->ket == 'h') ? 'checked' : '' }}> H<span >adir</span></label></p>
											<p class="ml-md-5 mr-md-5"><label for="ket"><input type="radio" name="ket-{{ $siswa->nisn }}" id="ket-{{ $siswa->nisn }}" value="i" class="form-control"> I<span>dzin</span></label></p>
											<p class="ml-md-5 mr-md-5"><label for="ket"><input type="radio" name="ket-{{ $siswa->nisn }}" id="ket-{{ $siswa->nisn }}" value="s" class="form-control"> S<span>akit</span></label></p>
											<p class="ml-md-5 mr-md-5"><label for="ket"><input type="radio" name="ket-{{ $siswa->nisn }}" id="ket-{{ $siswa->nisn }}" value="a" class="form-control" {{ ($siswa->ket == 'a') ? 'checked' : '' }}> A<span>lpa</span></label></p>
											<p class="ml-md-5 mr-md-5"><label for="ket"><input type="radio" name="ket-{{ $siswa->nisn }}" id="ket-{{ $siswa->nisn }}" value="t" class="form-control"> T<span>elat</span></label></p>
										</div>

								</div>
							</div>
			
						@endforeach
						<div class="card">
							<div class="card-body">
								<label for="jurnal">Jurnal</label>
								<textarea name="jurnal" class="form-control" id="jurnal" cols="30" rows="10"></textarea>
							</div>
							<div class="card-footer d-flex justify-content-center">
								<button class="btn btn-primary" type="submit" id="btn-simpan-absen">
									<i class="fa fa-save"></i>
									&nbsp;
									Simpan
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

