$(document).ready(function(){
	var headers =  {
		'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	};
	$('#form-absen').on('submit', function(e) {
		e.preventDefault();
		var data = $(this).serialize();
		$('#progress').addClass('progress d-flex').removeClass('d-none');
		$.ajax({
			headers: headers,
			url: '/ajax/absen/do',
			type: 'post',
			data: data,
		}).done(function(res) {
			Swal.fire('Info', res.msg, 'info');
			window.location.href = '/dashboard';
		}).fail(function(err) {
			console.log(err);
			Swal.fire('Error', err.status+': '+err.statusText, 'error');
		}).always(function(){
			$('#progress').removeClass('progress d-flex').addClass('d-none');
		});
	});

	$('.new_ket').change(function() {
		// alert($(this).val());
		var newKet = $(this).val();
		var kodeAbsen = $('#kode_absen').text();
		var data = [];
		$(this).closest('tr').find('td').each(function() {
			// var textval = $(this).text(); // this will be the text of each <td>
			data.push($(this).text());
	   });
	//    console.log(data);
		Swal.fire({
			showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'green',
                confirmButtonText: 'Lanjut',
                cancelButtonText: 'Batal',
                titleText: 'Yakin Mengubah presensi:  '+data[2]+'?'             
            }).then(result => {
                if (result.value) {
					$('#progress').addClass('progress d-flex').removeClass('d-none');
                    $.ajax({
                        url: '/ajax/absen/update/'+data[1],
                        type: 'put',
                        headers: headers,
						data: { 'newKet' : newKet, 'kode_absen' : kodeAbsen },
						dataType: 'json',
						
                    }).done(res => {
						Swal.fire('Info', 'Presensi '+data[2]+' diperbarui. ;)', 'info');
						
					}).fail(err => {
						Swal.fire('Error', err.msg, 'error');
					}).always(function() {
						$('#progress').removeClass('progress d-flex').addClass('d-none');
					})
                }
		});
	});

	// Table Absenku
	var tabsenkus = $('#table-absenkus')
		.on('init.dt', function(){
			$('#progress').removeClass('progress d-flex').addClass('d-none');
		})
		.on('draw.dt', function(){
			$('#progress').removeClass('progress d-flex').addClass('d-none');
		})
		.DataTable({
		dom: 'Bftlip',
		buttons: [
			{
				extend: 'copy',
				text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
			},
			{
				extend: 'excel',
				text: '<span style="color: green;"><i class="fa fa-file-excel-o"></i> Excel</span>',
				messageTop: new Date(),
				title: 'jadwal Harian',
			},
			{
				extend: 'print',
				text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
				exportOptions: {
					stripHtml: false
				},
			}
		],
		language: {"emptyTable": function(){
				$('.alert-logabsen').css('display', 'block');
				return "data kosong.";
			}
		},
		serverSide: true,
		processing: true,
		responsive: true,
		lengthMenu: [
			[10, 25, 50, 100, -1],
			['10', '25', '50', '100', 'Semua']
		],
		ajax: {
			url: '/ajax/getabsenku',
			type: 'post',
			headers: headers,
			beforeSend: function(){
				$('#progress').addClass('progress d-flex').removeClass('d-none');
			}
		},
		"columnDefs": [ {
			"searchable": false,
			"orderable": false,
			"targets": 0
			} ],
		'order': [[1, 'asc']],
		columns: [
			{ data: 'DT_RowIndex', 'orderable': false},
			{ data: 'kode', render: function( data, type, row, meta ) {
				// return data;
				return '<a href="/dashboard/detail-absen/'+row.kode_absen+'" >'+data+'</a>';
			}},
			{ data: 'tanggal', text: 'tanggal'},
			{ data: 'rombels.nama_rombel', text: 'rombels.nama_rombel'},
			{ data: 'jamke', text: 'jamke'},
			{ data: 'jml_siswa', text: 'jml_siswa'},
			{ data: 'hadir', text: 'hadir'},
			{ data: 'ijin', text: 'ijin'},
			{ data: 'sakit', text: 'sakit' },
			{ data: 'alpa', text: 'alpa' },
			{ data: 'telat', text: 'telat' },
			{ data: 'jurnal', text: 'jurnal' },
			{ data: 'ket', text: 'ket'}
		]
	})
	
	$(document).on('click', '.btn-ganti-foto', function(){
		Swal.fire({
			showConfirmButton: true,
			showCancelButton: true,
			confirmButtonColor: 'teal',
			cancelButtonColor: 'orangered',
			confirmButtonText: 'Lanjut',
			cancelButtonText: 'Batal',
			html: 'Yakin Mengganti Foto Profil? <br> Pastikan formatnya <b>.jpg</b> atau <b>.png</b>.'             
		}).then(result => {
			if (result.value) {
				$('#imgFoto').trigger('click');
			}
		})
		
	});
	$(document).on('change', '#imgFoto', function(e) {
		var file = e.target.files[0];
		console.log(file);
		if (!file.type.match('image.*')) {
			Swal.fire('error', 'File gambar harus bertipe jpg atau png.', 'error');
		} else if(file.size > 2000000) {
			Swal.fire('error', 'File tidak boleh lebih dari 2MB', 'error');
		} else {
			$('.card-img-top').addClass('zoomanimate');
			var fd = new FormData();
			fd.append('img_foto', file);
			$.ajax({
				url: '/ajax/upload/foto',
				type: 'post',
				data: fd,
				headers: headers,
				contentType: false,
				processData: false,
				success: function (res) {
					if ( res.status == 'sukses') {
						$('.card-img-top').removeClass('zoomanimate');
						Swal.fire('info', res.msg, 'info');
						window.location.reload();
					} else {
						Swal.fire('error', res.msg, 'error');
					}
				}
			})
		}
	});

	// Siswaku
	var tabsenkus = $('#table-siswaku')
		.on('init.dt', function(){
			$('#progress').removeClass('progress d-flex').addClass('d-none');
		})
		.on('draw.dt', function(){
			$('#progress').removeClass('progress d-flex').addClass('d-none');
		})
		.DataTable({
		dom: 'Bftlip',
		buttons: [
			{
				extend: 'copy',
				text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
			},
			{
				extend: 'excel',
				text: '<span style="color: green;"><i class="fa fa-file-excel-o"></i> Excel</span>',
				messageTop: new Date(),
				title: 'jadwal Harian',
			},
			{
				extend: 'print',
				text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
				exportOptions: {
					stripHtml: false
				},
			}
		],
		language: {"emptyTable": function(){
				$('.alert-logabsen').css('display', 'block');
				return "data kosong.";
			}
		},
		serverSide: true,
		processing: true,
		responsive: true,
		lengthMenu: [
			[10, 25, 50, 100, -1],
			['10', '25', '50', '100', 'Semua']
		],
		ajax: {
			url: '/ajax/getsiswaku',
			type: 'post',
			headers: headers,
			beforeSend: function(){
				$('#progress').addClass('progress d-flex').removeClass('d-none');
			}
		},
		"columnDefs": [ {
			"searchable": false,
			"orderable": false,
			"targets": 0
			} ],
		'order': [[1, 'asc']],
		columns: [
			{ data: 'DT_RowIndex', 'orderable': false},
			{ data: 'nisn', text: 'nisn'},
			{ data: 'nama_siswa', text: 'nama_siswa'},
			{ data: 'jk', text: 'jk'}
		]
	})
});