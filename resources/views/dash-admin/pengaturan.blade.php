<div class="row">
	<div class="container">
		<div class="d-flex justify-content-around justify-content-center">
			<div class="card">
				<div class="card-header">
					<button class="close" id="btn-add-jampel">
						<i class="fa fa-plus"></i>
					</button>
					<h5 class="card-title">
						<i class="nc-icon nc-bell-55"></i>
						Jam Pelajaran
					</h5>
					
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm table-condensed" id="table-jampel">
							<thead>
								<tr>
									<th>No</th>
									<th>Jampel</th>
									<th>Mulai</th>
									<th>Selesai</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">Cek Pesan Telegram</div>
				<div class="card-body">
					<button class="btn btn-primary btn-cek-pesan">Cek Pesan</button>
					<div class="msg-box"></div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">Kirim Pesan Telegram</div>
				<div class="card-body">
					<div class="container">
						<form action="" class="form">
							<div class="row">
								<div class="form-group">
										<input type="text" id="chat_id" name="chat_id" class="form-control" placeholder="Isikan chat id, pisahkan dengan koma">
								</div>
							</div>
							<div class="row">
								<div class="form-group">
										<textarea name="text" id="text" cols="30" rows="10" class="form-control" placeholder="Isi Pesan"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
										<button class="btn btn-primary btn-kirim-pesan">Kirim</button>
								</div>
							</div>
						</form>
					</div>
					
					
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="container">
		<div class="d-flex justify-content-around justify-content-center">
			<div class="card">
				<div class="card-header">
					<h4>Cek SMS Masuk</h4>
					<button class="btn btn-sm" id="btn-cek-sms">Cek SMS</button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-sm" id="table-inbox-sms">
							<thead>
								<tr>
									<th>No</th>
									<th>No HP Pengirim</th>
									<th>Pesan</th>
									<th>Waktu</th>
									<th>Diproses?</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h4>Kirim SMS</h4>
				</div>
				<div class="card-body">
					<form action="" id="form-kirim-pesan">
						<div class="form-group">
							<label for="nomor">Nomor</label>
							<input type="text" name="nomor" id="nomor" class="form-control">
						</div>
						<div class="form-group">
							<label for="pesan">Pesan</label>
							<input type="text" name="pesan" id="pesan" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

