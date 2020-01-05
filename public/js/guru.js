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
	var tabsenkus = $('#table-absenku')
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
	var tsiswas = $('#table-siswas')
	.on('init.dt', function(){
		$('#progress').removeClass('progress d-flex').addClass('d-none');
	})
	.on('draw.dt', function(){
		$('#progress').removeClass('progress d-flex').addClass('d-none');
	})
	.DataTable({
    		dom: 'Bftlp',
    		processing: true,
    		serverSide: true,
    		// select: true,
    		responsive: true,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'Semua']
            ],
    		ajax: {
    			url: '/ajax/getsiswaku',
    			type: 'post',
    			headers: {
    				'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
				},
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
	            { data: 'nis', 'name': 'nis'},
	            { data: 'nisn', name: 'nisn'},
	            { data: 'nama_siswa', name: 'nama_siswa'},
	            { data: 'jk', name: 'jk'},
	            { data: 'rombel_id', name: 'rombel_id', 'defaultContent': '<span style="color:red">Belum masuk rombel</span>'},
	            { data: null, name: 'opsi', 'defaultContent': '<button class="btn-c btn-sm btn-warning btn-edit-siswa"><i class="fa fa-edit"></i></button> &nbsp;<button class="btn-c btn-sm btn-danger btn-delete-siswa"><i class="fa fa-trash"></i></button> ', 'targets': -1},
	        ],
	        buttons:[
	        	 {
                    extend: 'copy',
                    text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
                },
                {
                    extend: 'excel',
                    text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
                    messageTop: new Date(),
                    title: 'Data Siswa',
                    exportOptions: {
                        
                    }
                },
                {
                    extend: 'print',
                    text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
                    messageTop: 'Data Siswa'
                }
	        ]
    	})
	$(document).on('click', '.btn-add-siswa', function(){

		$('#modal-siswa').modal();
		$('.modal-title').html('Tambah Siswa Baru');
    	$('#form-add-siswa .mode-form').val('post');
    	// alert($('.mode-form').val()); 
    });

    $(document).on('submit', '#form-add-siswa', function(e) {
    	e.preventDefault();
    	// alert('hi');
		var data = $(this).serialize();
		var form = $('#form-add-siswa')[0];

		var formdata = new FormData(form);
		// if (window.FormData) {
		// 	formdata = new FormData(form[0]);
		// }
		var url = ($('#form-add-siswa .mode-form').val() == 'post') ? 'add' : 'update';
		if ( url == 'update') {
			formdata.append('_method', 'PUT');
		}
		// console.log(formdata);
    	
		$.ajax({
			enctype: 'multipart/form-data',
			type: 'post', 
			url: '/ajax/'+url+'/siswa/'+$('#id_siswa').val(),
			data: formdata ? formdata : form.serialize(),
			cache: false,
			contentType: false,
			processData: false,
			headers: headers,
			dataType: 'json',
			success: function(res){
				if(res.status == 'sukses') {
    				Swal.fire(res.status, res.msg, 'info');
    				$('#modal-user').modal('hide');
    				$('#form-add-user').trigger('reset');
    				
    				$('#modal-siswa').modal('hide');
					tsiswas.draw();
					$('#progress').removeClass('progress d-flex').addClass('d-none');
    			}else{
					Swal.fire(res.status, res.msg, 'error');
					$('#progress').removeClass('progress d-flex').addClass('d-none');
    			}
			}
		});
    });


    // Btn Import Siswa clicked
    $(document).on('click', '.btn-import-siswas', function(){
		// alert('import users');
		$('#fileSiswa').trigger('click');
	});

    // File SIswa Picked
	$(document).on('change', '#fileSiswa', function(e){
		var files = e.target.files;
		console.log(files);
		$('#btn-import-siswas').css('display', 'block').text('Import File'+files[0].name);
	});

	// Upload File Siswa

	// Edit Siswa
	// Perbarui data Siswa
    	$(document).on('click', '.btn-edit-siswa', function() {
    		var data = tsiswas.row($(this).parents('tr')).data();
    		if(data == undefined) {
    			var selected_row = $(this).parents('tr');
    			if(selected_row.hasClass('child')) {
    				selected_row = selected_row.prev();
    				data = tsiswas.row(selected_row).data();
    			}
    		}
			// console.log(data);
			var foto = (data.foto != '0') ? data.foto : (data.jk == 'l') ? '/avatar-siswa-l.png':'/avatar-siswa-p.png';
			var ortu = (data.ortu_id != '') ? data.ortu_id : 'Tidak ada data';
    		$('#id_siswa').val(data.id);
    		$('#form-add-siswa .mode-form').val('put');
    		$('#nis').val(data.nis);
    		$('#nisn').val(data.nisn);
    		$('#nama_siswa').val(data.nama_siswa);
    		$('#form-add-siswa #jk_siswa').val(data.jk);
			$('#rombel_siswa').val(data.rombel_id).append('<option value="'+data.rombels.kode_rombel+'" selected>'+data.rombels.nama_rombel+'</option>').prop('disabled', 'disabled');
			$('#form-add-siswa #img-holder').prop('src', '/img'+foto);
			$('#form-add-siswa #ortu_id').val(ortu);
    		$('.modal-title').html('Perbarui Data <b>['+data.nama_siswa+']</b>');
    		$('.btn-submit-siswa').text('Perbarui');
    		$('#modal-siswa').modal();
    	});

		$(document).on('click', '#ortu_id', function(){
			
			// alert($(this).val());
			if($(this).val() == "TIdak ada data" || $(this).val() == "" || $(this).val() == null){
				$('#form_ortu input[name="mode"]').val('create');
				$('#form-ortu').trigger('reset');
			} else {
				$('#form_ortu input[name="mode"]').val('update');
				$.ajax({
					url: '/ajax/ortu/get-one/'+$(this).val(),
					type: 'get',
					headers: headers,
					beforeSend: function() {
						$('#progress').addClass('d-flex progress').removeClass('d-none');
					}
				})
				.done(res => {
					$('#form-ortu input[name="id_ortu"]').val(res.data.id);
					$('#form-ortu input[name="mode"]').val('update');
					$('#form-ortu #nik_aktif').val(res.data.nik_aktif);
					$('#form-ortu #email_aktif').val(res.data.email_aktif);
					$('#form-ortu #nama_ayah').val(res.data.nama_ayah);
					$('#form-ortu #job_ayah').val(res.data.job_ayah);
					$('#form-ortu #alamat_ayah').val(res.data.alamat_ayah);
					$('#form-ortu #hp_ayah').val(res.data.hp_ayah);
					$('#form-ortu #nama_ibu').val(res.data.nama_ibu);
					$('#form-ortu #job_ibu').val(res.data.job_ibu);
					$('#form-ortu #alamat_ibu').val(res.data.alamat_ibu);
					$('#form-ortu #hp_ibu').val(res.data.hp_ibu);
					$('#form-ortu #nama_wali').val(res.data.nama_wali);
					$('#form-ortu #job_wali').val(res.data.job_wali);
					$('#form-ortu #alamat_wali').val(res.data.alamat_wali);
					$('#form-ortu #hp_wali').val(res.data.hp_wali);
					
				})
				.fail(err => {
					Swal.fire('Error', err.msg, 'error');
				})
				.always(function() {
					$('#progress').removeClass('d-flex progress').addClass('d-none');
				})
			}
			$('#modal-ortu').modal();
		});

		$(document).on('blur', '#nik_aktif', function() {
			$.ajax({
				url: '/ajax/ortu/get-one/'+$(this).val(),
				type: 'get',
				headers: headers,
				dataType: 'json',
				beforeSend: function() {
					$('#progress').addClass('d-flex progress').removeClass('d-none');
				}
			}).done(res => {
				Swal.fire('info', res.msg, 'info');
				if (res.data == null) {
					return false;
				}
				$('#form-ortu input[name="id_ortu"]').val(res.data.id);
				$('#form-ortu input[name="mode"]').val('update');
				$('#form-ortu #email_aktif').val(res.data.email_aktif);
				$('#form-ortu #nama_ayah').val(res.data.nama_ayah);
				$('#form-ortu #job_ayah').val(res.data.job_ayah);
				$('#form-ortu #alamat_ayah').val(res.data.alamat_ayah);
				$('#form-ortu #hp_ayah').val(res.data.hp_ayah);
				$('#form-ortu #nama_ibu').val(res.data.nama_ibu);
				$('#form-ortu #job_ibu').val(res.data.job_ibu);
				$('#form-ortu #alamat_ibu').val(res.data.alamat_ibu);
				$('#form-ortu #hp_ibu').val(res.data.hp_ibu);
				$('#form-ortu #nama_wali').val(res.data.nama_wali);
				$('#form-ortu #job_wali').val(res.data.job_wali);
				$('#form-ortu #alamat_wali').val(res.data.alamat_wali);
				$('#form-ortu #hp_wali').val(res.data.hp_wali);
			}).fail(err => {
				Swal.fire('Error', err.msg, 'error');
			}).always(function(){
				$('#progress').removeClass('d-flex progress').addClass('d-none');
			})
			
		})

		$(document).on('submit', '#form-ortu', function(e) {
			e.preventDefault();
			alert($('#form-ortu input[name="mode"').val());
			var data = $(this).serialize();
			var tipe = ($('#form-ortu input[name="mode"]').val() == 'create') ? 'post' : 'put'
			$.ajax({
				url: '/ajax/ortu/'+$(this).children('input[name="mode"]').val(),
				type: tipe, 
				data: data,
				headers: headers,
				beforeSend: function() {
					$('#progress').addClass('d-flex progress').removeClass('d-none');
				}
			})
			.done(res => {
				// console.log(res);
				$('#form-add-siswa #ortu_id').val($('#form-ortu #nik_aktif').val());
				Swal.fire('Info', res.msg, 'info');
				
				$('#modal-ortu').modal('hide');

			})
			.fail(err => {
				// console.log(err);
				Swal.fire('Error', err.msg, 'error');
			})
			.always(function() {
				$('#progress').removeClass('d-flex progress').addClass('d-none');
			})
		});
    	// Hapus siswa
    	$(document).on('click', '.btn-delete-siswa', function(){
    		var data = tsiswas.row($(this).parents('tr')).data();
    		// alert(data.nip);
    		if(data == undefined) {
    			var selected_row = $(this).parents('tr');
    			if(selected_row.hasClass('child')) {
    				selected_row = selected_row.prev();
    				data = tsiswas.row(selected_row).data();
    				// console.log(data);

    			}
    		}
    		Swal.fire({
    			showConfirmButton: true,
    			showCancelButton: true,
    			confirmButtonColor: 'red',
    			cancelButtonColor: 'green',
				confirmButtonText: 'Lanjut',
				cancelButtonText: 'Batal',
				titleText: 'Yakin Menghapus Siswa '+data.nama_siswa+'?'    			
    		}).then(result => {
    			if (result.value) {
    				$.ajax({
    					url: '/ajax/delete/siswa/'+data.nisn,
    					type: 'delete',
    					headers: headers,
    					dataType: 'json',
    					success: function(res) {
    						if(res.status == 'sukses'){
    							Swal.fire('Info', 'Siswa '+data.nama_siswa+' telah dihapus', 'info');
    							tsiswas.draw();
    						} else {
    							Swal.fire('Error', res.msg, 'error');
    						}
    					}
    				});
    			}
    		});

    	});

	// Rekap Absen
	$(document).on('click', '.btn-rekap-presensi', function(e){
		e.preventDefault();
		var bulan = $('.bulan').val();
		var nama_bulan = $('.bulan option:selected').text();
		var tahun = $('.tahun').val();

		if ( bulan == '0' || tahun =='0' ) {
			Swal.fire('error', 'Pilih Bulan atau Tahun', 'error');
		} else {
			var date = new Date();
			var tanggal = moment().format('DD MMM YYYY');
			$('#bulan').text($('.bulan').val());
			$('#tahun').text($('.tahun').val());
			$('#table-rekap-absen')
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
						title: $('#card-rekap-wali .card-title').text(),
						messageTop: 'Bulan: '+$('#bulan').text()+' - '+$('#tahun').text(),
						messageBottom: `<p style="text-align:center;margin:50px 20px 20px 70%;">${$('#kota').text()}, ${tanggal}, <br>Wali Kelas <br><br><br><b><u>${$('#user_fullname').text()}</u></b><br>Nip. ${$('#user_nip').text()}</p>`
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
					// /rekap/kelas/bulan/{bulan}/tahun/{tahun}/rombel/{rombel}'
					url: '/ajax/rekap/kelas/bulan/'+$('.bulan').val()+'/tahun/'+$('.tahun').val()+'/rombel/'+$('.kode_rombel').text(),
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
					{ data: 'h', text: 'h'},
					{ data: 'i', text: 'i'},
					{ data: 's', text: 's'},
					{ data: 'a', text: 'a'},
					{ data: 't', text: 't'},
					{ data: null, render: function(data, type, row, meta) {
						return `<a class="btn-c btn-danger" href="/dashboard/rekap-absen?mod=detil&nisn=${row.nisn}&bulan=${$('#form-rekap-kelas .bulan').val()}&tahun=${$('#form-rekap-kelas .tahun').val()}"><i class="fa fa-search"></i>Detil</a>`;
					}}
				]
			});
		}
	});


	// GPS MODE
	var sekolah;
	$.ajax({
		url: '/ajax/getsekolah',
		type: 'post',
		headers: headers,
		dataType: 'json',
		success: function(res) {
			// console.log(res);
			sekolah = res.data;
			sessionStorage.setItem('gps', sekolah.gps);
			
			// setTimeout(function() {
				if(sessionStorage.getItem('gps') == 'on') {
					getLocation(res.data);
				} else {
					$('#demo').html('Mode GPS tidak aktif. Silahkan langsung masuk.')
				}
			// }, 500);
			// getLocation(res.data)
			// initialize(res.data);
		}
	})

	var x = document.getElementById("info-gps");

		var x = document.getElementById("info-gps");
		function getLocation(sekolah) {
			// alert('hi');
			if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(pos){
				// alert(pos.coords.latitude+', '+pos.coords.longitude);
				var distance = distanceBetween(sekolah.lat, sekolah.long, pos.coords.latitude, pos.coords.longitude, "K");
				// console.log("geo dis: " + distance);
				// $("#demo").html("<h4>" + Math.round(distance) + "Km</h4>");
				// alert(distance);
				if ( distance > 0.5){
					$('.card-jadwal .card a').prop('href', 'javascript:void(0)');
					$('#info-gps').html('Pastikan Anda berada di area sekolah. Saat ini Anda berjarak kurang lebih '+Math.round(distance)+' Km dari sekolah. ;)'+pos.coords.latitude+', '+pos.coords.longitude+' Posisi Sekolah: '+sekolah.lat+', '+sekolah.long);
				} else {
					$('#info-gps').html('Silahkan masuk. Anda sudah berada di area sekolah.');
				}
			}, showError);
			} else {
			var status = document.getElementById("demo");
			status.innerHTML = "Geolocation is not supported by this browser.";
			}
		}
		function distanceBetween(lat1, lon1, lat2, lon2, unit) {

			var rlat1 = Math.PI * lat1 / 180
			var rlat2 = Math.PI * lat2 / 180
			var rlon1 = Math.PI * lon1 / 180
			var rlon2 = Math.PI * lon2 / 180
			var theta = lon1 - lon2
			var rtheta = Math.PI * theta / 180
			var dist = Math.sin(rlat1) * Math.sin(rlat2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.cos(rtheta);
			dist = Math.acos(dist)
			dist = dist * 180 / Math.PI
			dist = dist * 60 * 1.1515
			if (unit == "K") {
			dist = dist * 1.609344
			}
			if (unit == "N") {
			dist = dist * 0.8684
			}
			return dist
			
		}
		// show our errors for debuging
		function showError(error) {
			var x = document.getElementById("info-gps");
			switch (error.code) {
			case error.PERMISSION_DENIED:
				x.innerHTML = "Mohon aktifkan lokasi untuk browser. :)"
				break;
			case error.POSITION_UNAVAILABLE:
				x.innerHTML = "Location information is unavailable.";
				break;
			case error.TIMEOUT:
				x.innerHTML = "The request to get location timed out.";
				break;
			case error.UNKNOWN_ERROR:
				x.innerHTML = "An unknown error occurred :(";
				break;
			}
		}
		
		

		// Raport

		$(document).on('click', '.btn-print-raport-pas', function() {
			var nisn = $('.form-ambil-raport #siswa_id').val(), semester = $('.form-ambil-raport #semester').val(), tapel = $('.form-ambil-raport #tapel').val();
			if( nisn == '0' || semester == "0") {
				Swal.fire('Error', 'Pastikan Nama Siswa dan Semester sudah terpilih', 'error');
				return false;
			} else {
				var win = window.open(window.location.origin+`/dashboard/cetak/raport/pas?nisn=${nisn}&semester=${semester}&tapel=${tapel}`,'', '', '');
			}
		});
		$(document).on('click', '.btn-print-raport-pts', function() {
			var nisn = $('.form-ambil-raport #siswa_id').val(), semester = $('.form-ambil-raport #semester').val(), tapel = $('.form-ambil-raport #tapel').val();
			if( nisn == '0' || semester == "0") {
				Swal.fire('Error', 'Pastikan Nama Siswa dan Semester sudah terpilih', 'error');
				return false;
			} else {
				var win = window.open(window.location.origin+`/dashboard/cetak/raport/pts?nisn=${nisn}&semester=${semester}&tapel=${tapel}`,'', '', '');
			}
		});
		$(document).on('click', '.btn-print-raport-biodata', function() {
			var nisn = $('.form-ambil-raport #siswa_id').val(), semester = $('.form-ambil-raport #semester').val(), tapel = $('.form-ambil-raport #tapel').val();
			if( nisn == '0' || semester == "0") {
				Swal.fire('Error', 'Pastikan Nama Siswa dan Semester sudah terpilih', 'error');
				return false;
			} else {
				var win = window.open(window.location.origin+`/dashboard/cetak/siswa/biodata?nisn=${nisn}&semester=${semester}&tapel=${tapel}`,'', '', '');
			}
		});
});