@if($mode == 'absenkus')
	<div class="row">
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-sm">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode</th>
							<th>Tanggal</th>
							<th>Rombel</th>
							<th>Jamke</th>
							<th>Jml Siswa</th>
							<th>Jml Hadir</th>
							<th>Jml Ijin</th>
							<th>Jml Sakit</th>
							<th>Jml Alpa</th>
							<th>Jml Telat</th>
							<th>Jurnal</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $data)
							<tr class="{{ ($data->ket == 'jamkos') ? 'bg-warning white-text ' : '' }}">
								<td>{{ $loop->index+1 }}</td>
								<td><a href="/dashboard/detail-absen/{{ $data->kode_absen }}">{!! QrCode::size(50)->generate($data->kode_absen) !!}</a></td>
								<td>{{ $data->tanggal }}</td>
								<td>{{ $data->rombels->nama_rombel }}</td>
								<td>{{ $data->jamke }}</td>
								<td>{{ $data->jml_siswa }}</td>
								<td>{{ $data->hadir }}</td>
								<td>{{ $data->ijin }}</td>
								<td>{{ $data->sakit }}</td>
								<td>{{ $data->alpa }}</td>
								<td>{{ $data->telat }}</td>
								<td>{{ substr($data->jurnal, 0, 38) }}..</td>
								<td>{{ $data->ket }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@elseif($mode == 'detil_absen')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="d-flex">
						@php($kode = explode('_', $kode_absen))
						<p>{!! QrCode::size(100)->generate($kode_absen) !!}</p>
						<div>
							<p class="p-0">DETAIL ABSEN<br>
							Kelas: {{ $kode[4] }}<br>
							Tanggal: {{ $kode[1] }}<br>
							Jamke: {{ $kode[5] }}</p>
							<div class="d-none" id="kode_absen">{{ $kode_absen }}</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="container">
						<div class="row">
							<div class="col-sm-8">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>No</th>
												<th>NISN</th>
												<th>Nama</th>
												<th>Presensi</th>
												<th>Opsi</th>
											</tr>
										</thead>
										<tbody>
											@foreach($datas as $data)
												<tr>
													<td>{{ $loop->index+1 }}</td>
													<td>{{ $data->siswa_id }}</td>
													<td>{{ $data->siswas->nama_siswa }}</td>
													<td>{{ $data->ket }}</td>
													<td>
														@php($opts = ["h" => "Hadir", "i" => "Ijin", "s" => "Sakit", "a" => "Alpa", "t" => "Telat"])
														<select name="new_ket" class="new_ket" class="form-control">
															@foreach($opts as $key=>$val)
																<option value="{{ $key }}" {{ ($key === $data->ket)? 'selected' : '' }}>{{ $val }}</option>
															@endforeach
														</select>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="alert alert-info">
									<h5>Jurnal:</h5>
									<p>{{ $jurnal->jurnal }}</p>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
@endif