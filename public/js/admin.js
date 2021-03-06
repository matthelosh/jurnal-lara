$(document).ready(function(){
	var path = window.location.pathname; 

    // Menentukan url yang targetnya sama dengan pathname
    // var hashTarget = $('.sidebar .nav a[href="#"]');
    var target = $('.sidebar .nav a[href="'+path+'"]');

    // Menambahkan class active pada li parent dari url yang sesuai dengan pathname
    target.parent('li').addClass('active');
    


    var headers =  {
		'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	};

    $('.modal').on('hide.bs.modal', function(){
    	$(this).find('form').trigger('reset');
    	$(this).find('table').DataTable().destroy();
    });

    
    // Users
    	// Get Users Datatables
        $(document).on('mouseenter', '.user-detail-link', function(){
            var data = tusers.row($(this).parents('tr')).data();
            $(this).tooltip({
                title: `<img class="img img-circle img-avatar" src="/img/faces/${data.nip}.jpg" with="50px" height="50px" onerror="this.src='/img/avatar-1.png'">`,
                html: true,
                placement: 'right'
            });
        });

		var tusers = $('#table-users')
		.on('init.dt', function(){
			
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
    			url: '/ajax/users',
    			type: 'get',
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
	            { data: 'nip', 'name': 'nip'},
	            { data: 'username', 
                    "render": function(data, type, row, meta) {
                        return "<a href='/dashboard/users/detail/"+row.username+"' class='user-detail-link'>"+row.username+"</a>"
                    }
                },
	            { data: 'fullname', name: 'fullname'},
	            { data: 'hp', name: 'hp'},
	            { data: 'email', name: 'email'},
	            { data: 'level', name: 'level'},
	            { data: null, name: 'opsi', 'defaultContent': '<button class="btn-c btn-sm btn-warning btn-edit-user"><i class="fa fa-edit"></i></button> &nbsp;<button class="btn-c btn-sm btn-danger btn-delete-user"><i class="fa fa-trash"></i></button> ', 'targets': -1},
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
                    title: 'Data Pengguna',
                    exportOptions: {
                        
                    }
                },
                {
                    extend: 'print',
                    text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
                    messageTop: 'Data Pengguna'
                }
	        ]
    	})

    	// New User
    	$(document).on('click', '.btn-add-user', function(){
    		$('#form-add-user .mode-form').val('post');
    		$('#modal-user').modal();
    	});

    	$(document).on('submit', '#form-add-user', function(e) {
    		e.preventDefault();
    		var data = $(this).serialize();
    		console.log(data);
    		var url = ($('#form-add-user .mode-form').val() == 'post') ? '/ajax/add/user' : '/ajax/update/user/'+$('#form-add-user #id_user').val();
    		$.ajax({
    			type: $('#form-add-user .mode-form').val(), 
    			url: url,
    			data: data,
    			headers: {
    				'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    			},
    			dataType: 'json',
    			success: function(res){
    				if(res.status == 'sukses') {
	    				Swal.fire(res.status, res.msg, 'info');
	    				$('#modal-user').modal('hide');
	    				$('#form-add-user').trigger('reset');
	    				tusers.draw();
	    			}else{
	    				Swal(res.status, res.msg, 'error');
	    			}
    			}
    		});
    	});

    	$(document).on('click', '.btn-import-users', function(){
    		// alert('import users');
    		$('#fileUser').trigger('click');
    	});

    	$(document).on('change', '#fileUser', function(e){
    		var files = e.target.files;
    		console.log(files);
    		$('#btn-import-users').css('display', 'block').text('Import File'+files[0].name);
    	});

    	// Perbarui data user
    	$(document).on('click', '.btn-edit-user', function() {
    		// alert('hi');
    		// console.log(data);
    		var data = tusers.row($(this).parents('tr')).data();
    		if(data == undefined) {
    			var selected_row = $(this).parents('tr');
    			if(selected_row.hasClass('child')) {
    				selected_row = selected_row.prev();
    				data = tusers.row(selected_row).data();
    				// console.log(data);

    			}
    		}
    		console.log(data);
    		$('#id_user').val(data.id);
    		$('#form-add-user .mode-form').val('put');
    		$('#txt-nip').val(data.nip);
    		$('#txt-username').val(data.username);
    		$('#txt-password').val(data.password);
    		$('#txt-fullname').val(data.fullname);
    		$('#txt-email').val(data.email);
    		$('#txt-hp').val(data.hp);
    		$('#txt-level').val(data.level);
    		$('.modal-title').html('Perbarui Data <b>['+data.fullname+']</b>');
    		$('.btn-submit-user').text('Perbarui');
    		$('#modal-user').modal();
    	});



    	// Hapus user
    	$(document).on('click', '.btn-delete-user', function(){
    		var data = tusers.row($(this).parents('tr')).data();
    		// alert(data.nip);
    		if(data == undefined) {
    			var selected_row = $(this).parents('tr');
    			if(selected_row.hasClass('child')) {
    				selected_row = selected_row.prev();
    				data = tusers.row(selected_row).data();
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
				titleText: 'Yakin Menghapus Pengguna '+data.fullname+'?'    			
    		}).then(result => {
    			if (result.value) {
    				$.ajax({
    					url: '/ajax/delete/user/'+data.nip,
    					type: 'delete',
    					headers: headers,
    					dataType: 'json',
    					success: function(res) {
    						if(res.status == 'sukses'){
    							Swal.fire('Info', 'Pengguna '+data.fullname+' telah dihapus', 'info');
    							tusers.draw();
    						} else {
    							Swal.fire('Error', res.msg, 'error');
    						}
    					}
    				});
    			}
    		});

    	});


    // Siswas
    var tsiswas = $('#table-siswas').on('init.dt', function(){
		$('#progress').removeClass('progress d-flex').addClass('d-none');
	}).DataTable({
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
    			url: '/ajax/siswas',
    			type: 'get',
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

    // New Siswa
    $(document).on('click', '.btn-add-siswa', function(){

    	$('#modal-siswa').modal();
    	$('#form-add-siswa .mode-form').val('post');
    	// alert($('.mode-form').val()); 
    });

    $(document).on('submit', '#form-add-siswa', function(e) {
    	e.preventDefault();
    	// alert('hi');
    	var data = $(this).serialize();

    	var url = ($('#form-add-siswa .mode-form').val() == 'post') ? 'add' : 'update';
		$.ajax({
			type: $('#form-add-siswa .mode-form').val(), 
			url: '/ajax/'+url+'/siswa/'+$('#id_siswa').val(),
			data: data,
			headers: {
				'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
			},
			dataType: 'json',
			success: function(res){
				if(res.status == 'sukses') {
    				Swal.fire(res.status, res.msg, 'info');
    				$('#modal-user').modal('hide');
    				$('#form-add-user').trigger('reset');
    				
    				$('#modal-siswa').modal('hide');
    				tsiswas.draw();
    			}else{
    				Swal.fire(res.status, res.msg, 'error');
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
    		// alert('hi');
    		// console.log(data);
    		var data = tsiswas.row($(this).parents('tr')).data();
    		if(data == undefined) {
    			var selected_row = $(this).parents('tr');
    			if(selected_row.hasClass('child')) {
    				selected_row = selected_row.prev();
    				data = tsiswas.row(selected_row).data();
    				// console.log(data);

    			}
    		}
    		// console.log(data);
    		$('#id_siswa').val(data.id);
    		$('#form-add-siswa .mode-form').val('put');
    		$('#nis').val(data.nis);
    		$('#nisn').val(data.nisn);
    		$('#nama_siswa').val(data.nama_siswa);
    		$('#jk').val(data.jk);
    		$('#rombel_id').val(data.rombel_id);
    		$('.modal-title').html('Perbarui Data <b>['+data.nama_siswa+']</b>');
    		$('.btn-submit-siswa').text('Perbarui');
    		$('#modal-siswa').modal();
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


    // Rombel
    var trombels = $('#table-rombels').on('init.dt', function(){
		$('#progress').removeClass('progress d-flex').addClass('d-none');
	}).DataTable({
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
    			url: '/ajax/rombels',
    			type: 'get',
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
	            // { data: 'kode_rombel', 'name': 'kode_rombel'},
	            { data: 'nama_rombel', name: 'nama_rombel'},
	            { data: 'gurus.fullname', name: 'gurus.fullname', 'defaultContent': 'Belum Ada'},
	            { data: 'jml_siswa', name: 'jml_siswa'},
	            { data: null, name: 'opsi', 'defaultContent': '<button class="btn-c btn-sm btn-info btn-mng-rombel"><i class="fa fa-cogs"></i></button> &nbsp;<button class="btn-c btn-sm btn-warning btn-edit-rombel"><i class="fa fa-edit"></i></button> &nbsp;<button class="btn-c btn-sm btn-danger btn-delete-rombel"><i class="fa fa-trash"></i></button> ', 'targets': -1},
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
                    title: 'Data Rombel',
                    exportOptions: {
                        
                    }
                },
                {
                    extend: 'print',
                    text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
                    messageTop: 'Data Rombel'
                }
	        ]

		});
		
	// Import Rombel
	$(document).on('click', '.btn-import-rombels', function() {
		$('#fileRombel').trigger('click');
	})

	$(document).on('change', '#fileRombel', function(e) {
		var files = e.target.files;
		// console.log(files);
		$('#btn-import-rombels').css('display', 'block').text('Upload File'+files[0].name);
	});

    // Add new Rombel
    $(document).on('click', '.btn-add-rombel', function(){

    	$('#modal-rombel').modal();
    	$('#modal-rombel .mode-form').val('post');
    });

    // Submit new Rombel
    $(document).on('submit', '#form-add-rombel', function(e) {
    	e.preventDefault();
    	var data = $(this).serialize();

    	var url = $('#modal-rombel .mode-form').val() == 'post' ? '/ajax/add/rombel' : '/ajax/update/rombel/'+$('#form-add-rombel .rombel_id').val();
    	$.ajax({
    		headers: headers,
    		type: $(this).find('.mode-form').val(),
    		url: url,
    		data: data,
    		dataType: 'json', 
    		success: function(res) {
    			if (res.status == 'sukses') {
    				Swal.fire('Info', res.msg, 'info');
    				trombels.draw();
    				$('.modal').modal('hide');
    			} else {
    				Swal.fire('Error', res.msg, 'error');
    				trombels.draw();
    			}
    		}
    	});
    });

    // Edit Rombel
    $(document).on('click', '.btn-edit-rombel', function(){
    	var data = trombels.row($(this).parents('tr')).data();
		// alert(data.nip);
		if(data == undefined) {
			var selected_row = $(this).parents('tr');
			if(selected_row.hasClass('child')) {
				selected_row = selected_row.prev();
				data = trombels.row(selected_row).data();
				// console.log(data);

			}
		}

		$('#modal-rombel').modal();
		$('#form-add-rombel .mode-form').val('put');
		$('#form-add-rombel .rombel_id').val(data.id);
		$('#form-add-rombel #kode_rombel').val(data.kode_rombel);
		$('#form-add-rombel #nama_rombel').val(data.nama_rombel);
		$('#form-add-rombel #guru_id').val(data.guru_id);
		$('#form-add-rombel button[type="submit"]').text('Perbarui');


    });

    // Delete Rombel
    $(document).on('click', '.btn-delete-rombel', function() {
    	var data = trombels.row($(this).parents('tr')).data();
		// alert(data.nip);
		if(data == undefined) {
			var selected_row = $(this).parents('tr');
			if(selected_row.hasClass('child')) {
				selected_row = selected_row.prev();
				data = trombels.row(selected_row).data();
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
				titleText: 'Yakin Menghapus rombel '+data.nama_rombel+'?'    			
    		}).then(result => {
    			if (result.value) {
    				$.ajax({
    					url: '/ajax/delete/rombel/'+data.id,
    					type: 'delete',
    					headers: headers,
    					dataType: 'json',
    					success: function(res) {
    						if(res.status == 'sukses'){
    							Swal.fire('Info', 'Rombel '+data.nama_rombel+' telah dihapus', 'info');
    							trombels.draw();
    						} else {
    							Swal.fire('Error', res.msg, 'error');
    						}
    					}
    				});
    			}
    		});


    })
    // Manage Rombel's Member

    $(document).on('click', '.btn-mng-rombel', function() {
    	var data = trombels.row($(this).parents('tr')).data();
		// alert(data.nip);
		if(data == undefined) {
			var selected_row = $(this).parents('tr');
			if(selected_row.hasClass('child')) {
				selected_row = selected_row.prev();
				data = trombels.row(selected_row).data();
				// console.log(data);

			}
		}
    	// get Rombels
    	$.ajax({
    		type: 'get',
    		url: '/ajax/rombels?mode=select',
    		dataType: 'json',
    		success: function(res) {
    			var options= '';
    			res.forEach(item => {
    				if(item.kode_rombel == data.kode_rombel) {
    					options += `<option value=${item.kode_rombel} selected>${item.nama_rombel}</option>`;
    				} else {
	    				options += `<option value=${item.kode_rombel}>${item.nama_rombel}</option>`;
	    			}
    			});

    			$('#modal-mnj-rombel #sel2Rombel').html(options);
    		}
    	});


    	// Get Members
    	var tmembers = $('#tmembers').on('init.dt', function(){
			$('#progress-tmembers').removeClass('progress-sm d-flex').addClass('d-none')
		}).DataTable({
    		dom: 'ftlp',
    		processing: true,
    		serverSide: true,
    		select: true,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'Semua']
            ],
    		// responsive: true,
    		ajax: {
    			url: '/ajax/members/rombel/'+data.kode_rombel,
    			type: 'get',
    			headers: {
    				'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend:function(){
					$('progress-tmembers').addClass('d-flex progress-sm').removeClass('d-none');
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
	            { data: 'nis', name: 'nis'},
	            { data: 'nisn', name: 'nisn'},
	            { data: 'nama_siswa', name: 'nama_siswa'},
	        ]
	        
    	});

    	// Get Non Members
    	var tnonmembers = $('#tnonmembers').DataTable({
    		dom: 'ftlp',
    		processing: true,
    		serverSide: true,
    		select: true,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'Semua']
            ],
    		// responsive: true,
    		ajax: {
    			url: '/ajax/nonmembers',
    			type: 'get',
    			headers: {
    				'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
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
	            { data: 'nis', name: 'nis'},
	            { data: 'nisn', name: 'nisn'},
	            { data: 'nama_siswa', name: 'nama_siswa'},
	        ]
	        
    	});

    	//  PIndahkan Siswa
    	$(document).on('click', '#pindahkan', function() {
	    	var newRombel = $('#sel2Rombel').val();
	    	if(newRombel == data.kode_rombel) {
	    		Swal.fire('Error', 'Rombel tujuan tidak boleh sama dengan rombel asal.', 'error');
	    	} else {
	    		var rawDataSelMembers = tmembers.rows($('#tmembers tr.selected')).data().to$();
	    		// console.log(rawDataSelMembers);
                var selMembers = rawDataSelMembers.toArray();
                if( selMembers.length < 1 ) {
                    Swal.fire('Peringatan', '<kbd>Ctrl</kbd> + <kbd>Klik</kbd> baris untuk memilih satu atau lebih siswa.', 'warning');
                } else {
                    var r = '';
                    nisns = [];
                    selMembers.forEach(function(m) {
                        r += m.nama_siswa+',';
                        nisns.push(m.nisn);
                    });
                    Swal.fire({
                        title: 'Pindah Rombel',
                        text: 'Anda akan memindahkan siswa: '+r,
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                        cancelButtonColor: 'red',
                        confirmButtonColor: 'green',
                        confirmButtonText: 'Siap', 
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function() {
                            return new Promise(function(resolve) {
                                $.ajax({
                                	headers: headers,
                                    type: 'put',
                                    url: '/ajax/pindahrombel',
                                    data: {nisns: nisns, tujuan: newRombel},
                                    dataType: 'json'
                               }).done(function(res) {
                                   Swal.fire('Berhasil!', res.msg, 'info');
                                   tmembers.draw();
                                   trombels.draw();
                               }).fail(function(res) {
                                    // console.log(res.data);
                                    Swal.fire('Maaf!', res.msg, 'warning');
                               });
                            });
                        }
                    });
                }
	    	}
	    });

    	// keluarkan siswa dari rombel
	    $(document).on('click','#keluarkan', function() {
            var rawDataSelMembers = tmembers.rows($('#tmembers tr.selected')).data().to$();
            var selMembers = rawDataSelMembers.toArray();
            if( selMembers.length < 1 ) {
                Swal.fire('Peringatan', 'Ctrl + Klik baris untuk memilih satu atau lebih siswa.', 'warning');
            } else {
                var r = '';
                nisns = [];
                selMembers.forEach(function(m) {
                    r += m.nama_siswa+',';
                    nisns.push(m.nisn);
                });
                Swal.fire({
                    title: 'Keluarkan Siswa',
                    text: 'Anda akan mengeluarkan siswa: '+r+' dari rombel '+data.nama_rombel,
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    cancelButtonColor: 'red',
                    confirmButtonColor: 'green',
                    confirmButtonText: 'Siap', 
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false,
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            $.ajax({
                            	headers:headers,
                                type: 'put',
                                url: '/ajax/keluarkansiswa',
                                data: {nisns: nisns},
                                dataType: 'json', 
                                success: function(res) {
                                    if (res.status == 'sukses'){
                                        Swal.fire('Berhasil!', res.msg, 'info');
                                        tmembers.draw();
                                        tnonmembers.draw();
                                        trombels.draw();
                                    } else {
                                        Swal.fire('Maaf, gagal!', res.msg, 'error');
                                    }
                                }
                           });
                        });
                    }
                });
            }
            // }
        });

        // Masukkan siswa ke rombel
        $(document).on('click','#masukkan', function() {
            var newRombel = data.kode_rombel;
                var rawDataSelNonMembers = tnonmembers.rows($('#tnonmembers tr.selected')).data().to$();
                var selNonMembers = rawDataSelNonMembers.toArray();
                if( selNonMembers.length < 1 ) {
                    Swal.fire('Peringatan', 'Ctrl + Klik baris untuk memilih satu atau lebih siswa.', 'warning');
                } else {
                    var r = '';
                    nisns = [];
                    selNonMembers.forEach(function(m) {
                        r += m.nama_siswa+',';
                        nisns.push(m.nisn);
                    });
                    Swal.fire({
                        title: 'Masukkan Siswa',
                        text: 'Anda akan memasukkan siswa: '+r+' ke rombel '+data.nama_rombel,
                        showCancelButton: true,
                        cancelButtonText: 'Batal',
                        cancelButtonColor: 'red',
                        confirmButtonColor: 'green',
                        confirmButtonText: 'Siap', 
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function() {
                            return new Promise(function(resolve) {
                                $.ajax({
                                	headers: headers,
                                    type: 'put',
                                    url: '/ajax/masukkansiswa',
                                    data: {nisns: nisns, tujuan: newRombel},
                                    dataType: 'json', 
                                    success: function(res) {
                                        if (res.status == 'sukses'){
                                            Swal.fire('Berhasil!', res.msg, 'info');
                                            tmembers.draw();
                                            tnonmembers.draw();
                                            trombels.draw();
                                        } else {
                                            Swal.fire('Maaf, gagal!', res.msg, 'error');
                                        }
                                    }
                               });
                            });
                        }
                    });
                }
            // }
        });

    	$('#modal-mnj-rombel').modal();
    });

	// Mapel
	// Button add Mapel
	$(document).on('click', '.btn-add-mapel', function(){
		$('#form-add-mapel .mode-form').val('add');
		// $('#form-add-mapel #mapel_id').val();
		$('#modal-mapel .modal-title').html('Tambah Mapel');
		$('#modal-mapel').modal();
	});

	// Submit mapel
	$(document).on('submit', '#form-add-mapel', function(e) {
		e.preventDefault();
		// alert($('#form-add-mapel .mode-form').val());

		var data = $(this).serialize();
		console.log(data);
		var url = ($('#form-add-mapel .mode-form').val() == 'add') ? '/ajax/add/mapel': '/ajax/update/mapel?id='+$('#form-add-mapel .mapel_id').val();
		var tipe = ($('#form-add-mapel .mode-form').val() == 'add') ? 'post': 'put';
		$.ajax({
			headers	: headers,
			url		: url,
			type	: tipe,
			data 	: data,
			dataType: 'json',
			success	: function(res) {
				if (res.status == 'sukses') {
					Swal.fire('info', res.msg, 'info');
					tmapels.draw();
				} else {
					var patt = /23000/gi;
					if(patt.test(res.msg)){ 
						Swal.fire('error', 'Mapel ini sudah ada di database.', 'error');
						tmapels.draw();
					}
				}
			}
		})
	})
	// Import Mapel
	$(document).on('click', '.btn-import-mapels', function() {
		$('#fileMapel').trigger('click');
	});

	$(document).on('change', '#fileMapel', function(e){
    		var files = e.target.files;
    		// console.log(files);
    		$('#btn-import-mapels').css('display', 'block').text('Import File'+files[0].name);
    	});

	var tmapels = $('#table-mapels').on('init.dt', function() {
		$('#progress').removeClass('d-flex progress').addClass('d-none');
	}).DataTable({
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
    			url: '/ajax/mapels',
    			type: 'get',
    			headers: {
    				'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function(){
					$('#progress').addClass('d-flex progress').removeClass('d-none');
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
	            { data: 'kode_mapel', name: 'kode_mapel'},
	            { data: 'nama_mapel', name: 'nama_mapel'},
	            { data: null, name: 'opsi', 'defaultContent': '<button class="btn-c btn-sm btn-warning btn-edit-mapel"><i class="fa fa-edit"></i></button> &nbsp;<button class="btn-c btn-sm btn-danger btn-delete-mapel"><i class="fa fa-trash"></i></button> ', 'targets': -1 }
	        ],
	        buttons: [
	        	 {
                    extend: 'copy',
                    text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
                },
                {
                    extend: 'excel',
                    text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
                    messageTop: new Date(),
                    title: 'Mata Pelajaran',
                    exportOptions: {
                        
                    }
                },
                {
                    extend: 'print',
                    text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
                    messageTop: 'Mata Pelajaran'
                }
	        ]
	});

	// Update Mapel
	$(document).on('click', '.btn-edit-mapel', function() {
		var data = tmapels.row($(this).parents('tr')).data();
		// alert(data.nip);
		if(data == undefined) {
			var selected_row = $(this).parents('tr');
			if(selected_row.hasClass('child')) {
				selected_row = selected_row.prev();
				data = tmapels.row(selected_row).data();
			}
		}
		$('#form-add-mapel .mode-form').val('put');
		$('#form-add-mapel .mapel_id').val(data.id);

		$('#form-add-mapel #kode_mapel').val(data.kode_mapel);
		$('#form-add-mapel #nama_mapel').val(data.nama_mapel);
		$('#modal-mapel .modal-title').html('Perbarui Data Mapel');
		$('#modal-mapel').modal();
	});

	// Hapus Mapel
	$(document).on('click', '.btn-delete-mapel', function(){
		// alert(data.nip);
		var data = tmapels.row($(this).parents('tr')).data();
		if(data == undefined) {
			var selected_row = $(this).parents('tr');
			if(selected_row.hasClass('child')) {
				selected_row = selected_row.prev();
				data = tmapels.row(selected_row).data();
			}
		}

		Swal.fire({
    			showConfirmButton: true,
    			showCancelButton: true,
    			confirmButtonColor: 'red',
    			cancelButtonColor: 'green',
				confirmButtonText: 'Lanjut',
				cancelButtonText: 'Batal',
				titleText: 'Yakin Menghapus mapel '+data.nama_mapel+'?'    			
    		}).then(result => {
    			if (result.value) {
    				$.ajax({
    					url: '/ajax/delete/mapel/'+data.id,
    					type: 'delete',
    					headers: headers,
    					dataType: 'json',
    					success: function(res) {
    						if(res.status == 'sukses'){
    							Swal.fire('Info', 'Mapel '+data.nama_mapel+' telah dihapus', 'info');
    							tmapels.draw();
    						} else {
    							Swal.fire('Error', res.msg, 'error');
    						}
    					}
    				});
    			}
    		});

	})
	// Jadwal


    // Jampel
    var tjampels = $('#table-jampel').DataTable({
        dom: 'ti',
        serverSide: true,
        processing: true,
        pageLength: -1,
        ajax: {
            url: '/ajax/jampels',
            type: 'get',
            headers: headers
        },
        "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
                } ],
            'order': [[3, 'asc']],
            columns: [
                { data: 'DT_RowIndex', 'orderable': false},
                { data: 'label', name: 'label'},
                { data: 'mulai', name: 'mulai'},
                { data: 'selesai', name: 'selesai'},
                { data: null, name: 'opsi', 'defaultContent': '<button class="btn-c btn-sm btn-warning btn-edit-jampel"><i class="fa fa-edit"></i></button> &nbsp;<button class="btn-c btn-sm btn-danger btn-delete-jampel"><i class="fa fa-trash"></i></button> ', 'targets': -1 }
            ]
    });

    $('#btn-add-jampel').on('click', function() {
        $('#form-add-jampel .mode-form').val('post');
        $('#modal-jampel').modal();
    });

    $(document).on('click', '.btn-edit-jampel', function(){
        var data = tjampels.row($(this).parents('tr')).data();
        
        $('#form-add-jampel .mode-form').val('put');

        $('#modal-jampel .modal-title').html('Perbarui data jam pelajaran.');

        $('#form-add-jampel .jampel_id').val(data.id);
        $('#form-add-jampel #label').val(data.label);
        $('#form-add-jampel #mulai').val(data.mulai);
        $('#form-add-jampel #selesai').val(data.selesai);

        $('#modal-jampel').modal();
    });

    $(document).on('submit', '#form-add-jampel', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var tipe = $('#form-add-jampel .mode-form').val();
        var url = ($('#form-add-jampel .mode-form').val() == 'post') ? '/ajax/add/jampel' : '/ajax/update/jampel/'+$('#form-add-jampel .jampel_id').val();
        $.ajax({
            headers: headers,
            url: url,
            type: tipe,
            data: data,
            success: function(res) {
                if(res.status == 'sukses') {
                    Swal.fire('Sukses', res.msg, 'info');
                    tjampels.draw();
                    $('.modal form').trigger('reset');
                } else {
                    Swal.fire('Error', res.msg, 'error')
                }
            }
        });
    });

    $(document).on('click', '.btn-delete-jampel', function(){
        var data = tjampels.row($(this).parents('tr')).data();
        Swal.fire({
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'green',
                confirmButtonText: 'Lanjut',
                cancelButtonText: 'Batal',
                titleText: 'Yakin Menghapus Jampel:  '+data.label+'?'             
            }).then(result => {
                if (result.value) {
                    $.ajax({
                        url: '/ajax/delete/jampel/'+data.id,
                        type: 'delete',
                        headers: headers,
                        dataType: 'json',
                        success: function(res) {
                            if(res.status == 'sukses'){
                                Swal.fire('Info', 'Mapel '+data.label+' telah dihapus', 'info');
                                tjampels.draw();
                            } else {
                                Swal.fire('Error', res.msg, 'error');
                            }
                        }
                    });
                }
            });
    });


    // Jadwals
    var tjadwals = $('#table-jadwals').on('init.dt', function(){
		$('#progress').removeClass('d-flex progress').addClass('d-none');
	}).DataTable({
        dom: 'Bftlip',
        buttons: [
             {
                extend: 'copy',
                text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
            },
            {
                extend: 'excel',
                text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
                messageTop: new Date(),
                title: 'Jadwal Pelajaran',
                exportOptions: {
                    
                }
            },
            {
                extend: 'print',
                text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
                messageTop: 'Jadwal Pelajaran'
            }
        ],
        serverSide: true,
        processing: true,
        responsive: true,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            ['10', '25', '50', '100', 'Semua']
        ],
        ajax: {
            url: '/ajax/jadwals',
            type: 'get',
			headers: headers,
			beforeSend: function(){
				$('#progress').addClass('d-flex progress').removeClass('d-none');
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
                { data: 'hari', name: 'hari'},
                { data: 'gurus.fullname', name: 'gurus.fullname','defaultContent': 'Belum ada guru.', 'defaultContent': '<span bg-danger>Tidak ada guru</span>'},
                { data: 'mapels.nama_mapel', name: 'mapels.nama_mapel','defaultContent': 'Belum ada mapel.'},
                { data: 'rombels.nama_rombel', name: 'rombels.nama_rombel','defaultContent': 'Belum ada rombel.'},
                { data: 'jamke', name: 'jamke'},
                { data: null, name: 'opsi', 'defaultContent': '<button class="btn-c btn-sm btn-warning btn-edit-jadwal"><i class="fa fa-edit"></i></button> &nbsp;<button class="btn-c btn-sm btn-danger btn-delete-jadwal"><i class="fa fa-trash"></i></button> ', 'targets': -1 }
            ]
    });

    // Submi Jadwal
    $(document).on('submit', '#form-add-jadwal', function(e) {
        e.preventDefault();

        var data = $(this).serialize();
        var url = ($('#form-add-jadwal .mode-form').val() == 'post') ? '/ajax/add/jadwal' : '/ajax/update/jadwal/'+$('#form-add-jadwal .jadwal_id').val();
        var tipe = $('#form-add-jadwal .mode-form').val();

        $.ajax({
            headers: headers,
            url: url,
            type: tipe,
            data: data,
            dataType: 'json',
            success: function(res) {
                if ( res.status == 'sukses') {
                    Swal.fire('info', res.msg, 'info');
                    $('#form-add-jadwal').trigger('reset');
                    tjadwals.draw();
                } else {
                    Swal.fire('Error', res.msg, 'error');
                }
            }
        })
    });

    // New Jadwal
    $(document).on('click', '.btn-add-jadwal', function() {
        $('#modal-jadwal').modal();
        $('#form-add-jadwal .mode-form').val('post');
    });

	$(document).on('click','.btn-import-jadwals', function() {
		$('#fileJadwal').trigger('click');
	});

	$(document).on('change', '#fileJadwal', function(e) {
		var file = e.target.files[0];
		$('#btn-import-jadwals').css('display', 'block').text('Upload '+file.name);
	});
    // delete jadwal
    $(document).on('click', '.btn-delete-jadwal', function() {
        var data = tjadwals.row($(this).parents('tr')).data();
        if(data == undefined) {
            var selected_row = $(this).parents('tr');
            if(selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
                data = tmapels.row(selected_row).data();
            }
        }
        Swal.fire({
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'green',
                confirmButtonText: 'Lanjut',
                cancelButtonText: 'Batal',
                titleText: 'Yakin Menghapus Jadwal:  '+data.kode_jadwal+'?'             
            }).then(result => {
                if (result.value) {
                    $.ajax({
                        url: '/ajax/delete/jadwal/'+data.id,
                        type: 'delete',
                        headers: headers,
                        dataType: 'json',
                        success: function(res) {
                            if(res.status == 'sukses'){
                                Swal.fire('Info', 'Mapel '+data.kode_jadwal+' telah dihapus', 'info');
                                tjadwals.draw();
                            } else {
                                Swal.fire('Error', res.msg, 'error');
                            }
                        }
                    });
                }
        })
    });

    // Update Jadwal
    $(document).on('click', '.btn-edit-jadwal', function() {
        var data = tjadwals.row($(this).parents('tr')).data();
        if(data == undefined) {
            var selected_row = $(this).parents('tr');
            if(selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
                data = tjadwals.row(selected_row).data();
            }
        }

        $('#form-add-jadwal .mode-form').val('put');
        $('#form-add-jadwal .jadwal_id').val(data.id);
        $('#form-add-jadwal #hari').val(data.hari);
        $('#form-add-jadwal #guru_id').val(data.guru_id);
        $('#form-add-jadwal #mapel_id').val(data.mapel_id);
        $('#form-add-jadwal #rombel_id').val(data.rombel_id);
        $('#form-add-jadwal #jamke').val(data.mapels.jamke);
        $('#form-add-jadwal button[type="submit"]').text('perbarui');

        $('#modal-jadwal').modal();



    });

	$(document).on('click', '.btn-edit-logo', function(){
		Swal.fire({
			showConfirmButton: true,
			showCancelButton: true,
			confirmButtonColor: 'teal',
			cancelButtonColor: 'orangered',
			confirmButtonText: 'Lanjut',
			cancelButtonText: 'Batal',
			html: 'Yakin Mengganti Logo Sekolah? <br> Pastikan formatnya <b>.jpg</b> atau <b>.png</b>.'             
		}).then(result => {
			if (result.value) {
				$('#imgLogo').trigger('click');
			}
		})
		
	});

	

	$(document).on('change', '#imgLogo', function(e) {
		var file = e.target.files[0];
		console.log(file);
		if (!file.type.match('image.*')) {
			Swal.fire('error', 'File gambar harus bertipe jpg atau png.', 'error');
		} else if(file.size > 2000000) {
			Swal.fire('error', 'File tidak boleh lebih dari 2MB', 'error');
		} else {
			$('.logo-sekolah').addClass('zoomanimate');
			var fd = new FormData();
			fd.append('img_logo', file);
			$.ajax({
				url: '/ajax/upload/logo',
				type: 'post',
				data: fd,
				headers: headers,
				contentType: false,
				processData: false,
				success: function (res) {
					if ( res.status == 'sukses') {
						$('.logo-sekolah').removeClass('zoomanimate');
						Swal.fire('info', res.msg, 'info');
						window.location.reload();
					} else {
						Swal.fire('error', res.msg, 'error');
					}
				}
			})
		}
	});

	$('.btn-edit-sekolah').on('click', function() {
		$.ajax({
			headers: headers,
			url: '/ajax/edit/data-sekolah',
			type: 'get',
			success: function(res) {
				if (res.status == 'sukses') {
					$('#form-data-sekolah #id').val(res.data.id);
					$('#form-data-sekolah #mode').val('update');
					$('#npsn').val(res.data.npsn);
					$('#nss').val(res.data.nss);
					$('#nama_sekolah').val(res.data.nama_sekolah);
					$('#kepsek').val(res.data.kepsek);
					$('#nip_kepsek').val(res.data.nip_kepsek);
					$('#lat').val(res.data.lat);
					$('#long').val(res.data.long);
					$('#alamat_sekolah').val(res.data.alamat_sekolah);
					$('#kelurahan').val(res.data.kelurahan);
					$('#kec').val(res.data.kec);
					$('#kota').val(res.data.kota);
					$('#prov').val(res.data.prov);
					$('#telepon').val(res.data.telepon);
					$('#email').val(res.data.email);
					$('#website').val(res.data.website);
					$('#modal-sekolah').modal();
				} else {
					Swal.fire('Error', res.msg, 'error');
				}
			}
		})
	});

	$('#btn-create-sekolah').on('click', function() {
		$('#form-data-sekolah #mode').val('create');
		$('#modal-sekolah').modal();
	});

	$(document).on('submit', '#form-data-sekolah', function(e) {
		e.preventDefault();
		var data = $(this).serialize();
		var mode = ($('#form-data-sekolah #mode').val() == 'update') ? 'put': 'post';
		// alert()
		$.ajax({
			url: '/ajax/'+ $('#form-data-sekolah #mode').val() +'/sekolah',
			type:mode,
			data: data,
			headers: headers,
			beforeSend: function() {
				$('#progress').addClass('d-flex progree').removeClass('d-none');
			},
			success: function(res) {
				if ( res.status == 'sukses' ) {
					$('#progress').removeClass('d-flex progree').addClass('d-none');
					Swal.fire('info', res.msg, 'info');
					window.location.reload();
				} else {
					Swal.fire('error', res.msg, 'error');
				}
			}
		})
	})

	

	// Cek PEsan Telegram
	$(document).on('click', '.btn-cek-pesan', function() {
		$.ajax({
			headers: headers,
			url: '/ajax/cek/pesan',
			type: 'post',
			dataType: 'json',
			success: function(res) {
				var updates = res.data;
				if(res.status == 'sukses') {
					var msgs = '';
					updates.forEach(update => {
						msgs += `<div class="card">
								<div class="card-header"><h4>${update.message.from.username}<small>${update.message.chat.id}</small></h4></div>
								<div class="card-body">${update.message.text}</div>
								</div>`;
					});

					$('.msg-box').html(msgs);
				}
			}
		})
	});

	$(document).on('click', '.btn-kirim-pesan', function(e) {
		e.preventDefault();
		var fd = new FormData();
		var cid = $('#chat_id').val();
		var cids = cid.split(',');
		var text = $('#text').val();
		var data = {
			chatIds: cids,
			text: text
		}
		$.ajax({
			headers: headers,
			type: 'post',
			url: '/ajax/kirim/pesan',
			data: data,
			success: function(res) {
				Swal.fire('info', res.msg, 'info');
			}
		})
	});

	// Aktifkan Jadwal
	$(document).on('click', '#btn-aktifkan-jadwal', function() {
        $('#progress').addClass('progress d-flex').removeClass('d-none');
		$.ajax({
			headers: headers,
			url: '/ajax/aktifkan-jadwal',
			type: 'post',
			// dataType: 'json',
		}).done(function(res) {
			if (res.status == 'sukses') {
                Swal.fire('info', res.msg, 'info');
            } else {
                if(res.errCode == '400') {
                    Swal.fire('warning', 'Jadwal hari ini aktif. Tapi ada chat id pemangku kepentingan yang sudah tidak aktif. Mohon untuk verifikasi ulang chat DI telegram pemangku kepentingan.', 'warning');
                    $('.alert-logbasen').css('display', 'none');
                    tlogabsen.draw();
                } else {
                    Swal.fire('error', res.msg, 'error');
                }
            }
		}).fail(function(err){
			if(err.responseJSON.message == "Bad Request: chat not found") {
				Swal.fire('warning', 'Jadwal hari ini aktif. Tapi ada chat id pemangku kepentingan yang sudah tidak aktif. Mohon untuk verifikasi ulang chat DI telegram pemangku kepentingan.', 'warning');
				$('.alert-logbasen').css('display', 'none');
				tlogabsen.draw();
			}
		}).always(function(){
			$('.alert-logabsen').css('display', 'none');
			$('#btn-tutup-jadwal').css('display', 'block');
            tlogabsen.draw();
            $('#progress').removeClass('progress d-flex').addClass('d-none');
		});
		
	});

	var tlogabsen = $('#table-log-absen')
	.on('draw.dt', function(){
		$('#progress').removeClass('d-flex progress').addClass('d-none');
	})
	.on('init.dt', function(){
		$('#progress').removeClass('d-flex progress').addClass('d-none');
	}).DataTable({
		dom: 'Bftlip',
        buttons: [
            {
                extend: 'copy',
                text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
            },
            {
                extend: 'excel',
                text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
                messageTop: new Date(),
                title: 'jadwal Harian',
                exportOptions: {
                    
                }
            },
            {
                extend: 'print',
                text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
            }
        ],
		language: {"emptyTable": function(){
				$('.alert-logabsen').css('display', 'block');
				$('#btn-tutup-jadwal').hide();
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
            url: '/ajax/get-log-absen',
            type: 'post',
			headers: headers,
			beforeSend: function(){
				$('#progress').addClass('d-flex progress').removeClass('d-none');
			}
        },
        "columnDefs": [ {
			"searchable": false,
			"orderable": false,
			"targets": 13
			} ],
		'order': [[1, 'asc']],
		columns: [
			{ data: 'tanggal', name: 'tanggal'},
			{ data: 'rombels.nama_rombel', name: 'rombels.nama_rombel'},
			{ data: 'mapels.nama_mapel', name: 'mapels.nama_mapel'},
			{ data: 'gurus.fullname', name: 'gurus.fullname'},
			{ data: 'jamke', name: 'jamke'},
			{ data: 'jml_siswa', name: 'jml_siswa', 'defaultContent': '0'},
			{ data: 'hadir', name: 'hadir', 'defaultContent': '0'},
			{ data: 'ijin', name: 'ijin', 'defaultContent': '0'},
			{ data: 'sakit', name: 'sakit', 'defaultContent': '0'},
			{ data: 'alpa', name: 'alpa', 'defaultContent': '0'},
			{ data: 'telat', name: 'telat', 'defaultContent': '0'},
			{ data: 'jurnal', name: 'jurnal', 'defaultContent': '0'},
			{ data: 'ket', name: 'ket', 'defaultContent': 'Jamkos'},
			// { data: 'ijin', name: 'ijin'},
			{data: 'isActive', 'render': function(data, type, row) {
					if(row.isActive === 0) {
						return 'Tutup';
					} else {
						return 'Aktif';
					}
				}
			},
			{ data: null, name: 'opsi', 'defaultContent': '<button class="btn-c btn-sm btn-warning btn-ijinkan-guru"><i class="fa fa-edit"></i> Ijinkan guru</button>', 'targets': -1 }
		]
	});

	$(document).on('click', '.btn-ijinkan-guru', function() {
		var data = tlogabsen.row($(this).parents('tr')).data();
		// alert(data.gurus.fullname);
		if(data == undefined) {
            var selected_row = $(this).parents('tr');
            if(selected_row.hasClass('child')) {
                selected_row = selected_row.prev();
                data = tlogabsen.row(selected_row).data();
            }
		}
		$('#kode_absen').val(data.kode_absen);
		$('#nama-guru-ijin').text(data.gurus.fullname);
		$('#nip').val(data.gurus.nip);
		$('#modal-ijinkan-guru').modal();
	});

	$(document).on('click', '#ada_tugas', function(){
		if($(this).prop('checked')) {
			$('#tugas').prop('disabled', '');
		} else {
			$('#tugas').prop('disabled', 'disabled');
		}
	});

	$('#modal-ijinkan-guru').on('bs.hide.modal', function(){
		$('#form-ijinkan-guru').trigger('reset');
	});

	// Form Submit Ijinkan Guru
	$(document).on('submit', '#form-ijinkan-guru', function(e) {
		e.preventDefault();
		if($('#keperluan').val() == "0" ) {
			$('#keperluan').append('<span style="color:red">Mohon memilih keperluan</span>').focus();
			return false;
		} else {
			var data = $(this).serialize();
            $('#progress').addClass('progress d-flex').removeClass('d-none');
			$.ajax({
				headers: headers,
				url: '/ajax/ijinkan/guru',
				type: 'put',
				data: data
			}).done(function(res) {
				Swal.fire('info', 'Guru: '+$('#nama-guru-ijin').text()+' telah diijinkan', 'info');
			}).fail(function(err) {
				Swal.fire('error', err, 'error');
			}).always(function(){
				$('#modal-ijinkan-guru').modal('hide');
                $('#progress').removeClass('progress d-flex').addClass('d-none');
				tlogabsen.draw();
			});
		}
	});

	$(document).on('click', '#btn-tutup-jadwal', function() {
		Swal.fire({
			showConfirmButton: true,
			showCancelButton: true,
			confirmButtonColor: 'red',
			cancelButtonColor: 'green',
			confirmButtonText: 'Lanjut',
			cancelButtonText: 'Batal',
			titleText: 'Yakin Menutup Jadwal hari ini?'             
		}).then(result => {
			if (result.value) {
                $('#progress').addClass('progress d-flex').removeClass('d-none');
				$.ajax({
					url: '/ajax/tutup/jadwal',
					type: 'post',
					headers: headers,
					dataType: 'json',
					success: function(res) {
						if(res.status == 'sukses'){
                            if(res.errCode){
                                Swal.fire('Info', 'Jadwal sudah ditutup, tapi ada chat id pemangku kepentingan yang sudah tidak aktif. Mohon verifikasi ulang chat ID.', 'info');
                            } else {
                                Swal.fire('Info', 'Jadwal hari ini telah ditutup', 'info');
                            }
							
							tlogabsen.draw();
						} else {
							Swal.fire('Error', res.msg, 'error');
						}
					}
				}).always(function(){
                    $('#progress').removeClass('progress d-flex').addClass('d-none');
                });
			}
		});
	});

	// Laporan
		// Presensi
	$(document).on('submit', '#form-rekap-kelas', function(e){
		e.preventDefault();
		var data = $(this).serialize();
		// $.ajax({
		// 	url: '/ajax/rekap/kelas/bulan/'+$('.bulan').val()+'/tahun/'+$('.tahun').val()+'/rombel/'+$('.rombel').val(),
		// 	type: 'post',
		// 	headers: headers,
		// }).done(res => {
		// 	console.log(res);
		// }).faile(err => {
		// 	console.log(err);
		// })
		$('#progress').addClass('progress d-flex').removeClass('d-none');
		$.ajax({
			headers: headers,
			url: '/ajax/rekap/kelas',
			type: 'get',
			data: data,
		}).done(res => {
			$('#modal-rekap-kelas').modal();
		}).fail(err => {

		}).always(function() {
			$('#progress').removeClass('progress d-flex').addClass('d-none');
		});
		
		var trekapbulans = $('#table-rekap-bulan')
		.on('draw.dt', function(){
			$('#progress').removeClass('d-flex progress').addClass('d-none');
		})
		.on('init.dt', function(){
			$('#progress').removeClass('d-flex progress').addClass('d-none');
		}).DataTable({
			dom: 'Bftlip',
			buttons: [
				{
					extend: 'copy',
					text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
				},
				{
					extend: 'excel',
					text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
					messageTop: new Date(),
					title: 'jadwal Harian',
					stripHtml: false,
					exportOptions: {
						
					}
				},
				{
					extend: 'print',
					text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
					stripHtml: false,
					messageTop: `Kelas: ${$('#form-rekap-kelas .rombel option:selected').text()} <br> Bulan : ${$('#form-rekap-kelas .bulan option:selected').text()} <br> Tahun: ${$('#form-rekap-kelas .tahun option:selected').text()}`,
					title: 'Rekapitulasi Presensi Siswa'
				}
			],
			language: {"emptyTable": function(){
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
				url: '/ajax/rekap/kelas/bulan/'+$('.bulan').val()+'/tahun/'+$('.tahun').val()+'/rombel/'+$('.rombel').val(),
				type: 'post',
				headers: headers,
				beforeSend: function(){
					$('#progress').addClass('d-flex progress').removeClass('d-none');
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
					{ data: 'nisn', text: 'nisn' },
					{ data: 'nama_siswa', text: 'nama_siswa'},
					{ data: 'h', text: 'h'},
					{ data: 'i', text: 'i'},
					{ data: 's', text: 's'},
					{ data: 'a', text: 'a'},
					{ data: 't', text: 't'}
				]
		});
		
		$('#modal-rekap-kelas #nama_kelas').text($('.rombel option:selected').text());
		$('#modal-rekap-kelas #bulan').text($('#form-rekap-kelas .bulan option:selected').text());
		$('#modal-rekap-kelas #tahun').text($('#form-rekap-kelas .tahun option:selected').text());
		$('#modal-rekap-kelas').modal();
		$('#modal-rekap-kelas').on('bs.hide.bs.modal', function(){
			trekapbulans.destroy();
		});
	});

	var trekaplogabsens = $('#table-rekap-log-absen')
		
		.on('init.dt', function(){
			$('#progress-trekaplog').removeClass('progress-sm d-flex').addClass('d-none');
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
					text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
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
			
			serverSide: true,
			processing: true,
			responsive: true,
			lengthMenu: [
				[10, 25, 50, 100, -1],
				['10', '25', '50', '100', 'Semua']
			],
			ajax: {
				url: '/ajax/rekap/logabsen',
				type: 'post',
				headers: headers,
				beforeSend: function(){
					$('#progress-trekaplog').addClass('progress-sm d-flex').removeClass('d-none');
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
					return '<a href="'+row.kode_absen+'" class="detil-absen-link" data-kode="'+row.kode_absen+'">'+data+'</a>';
				}},
				{ data: 'tanggal', text: 'tanggal'},
				{ data: 'mapels.nama_mapel', text: 'mapels.nama_mapel'},
				{ data: 'rombels.nama_rombel', text: 'rombels.nama_rombel'},
				{ data: 'gurus.fullname', text: 'gurus.fullname'},
				{ data: 'jml_siswa', text: 'jml_siswa'},
				{ data: 'hadir', text: 'hadir'},
				{ data: 'ijin', text: 'ijin'},
				{ data: 'sakit', text: 'sakit' },
				{ data: 'alpa', text: 'alpa' },
				{ data: 'telat', text: 'telat' },
				{ data: 'ket', text: 'ket'}
			],
		// "deferLoading": 57
	})
	$(document).on('draw.dt',trekaplogabsens, function(){
		$('#progress-trekaplog').removeClass('progress-table progress-sm d-flex').addClass('d-none');
		// alert('hi');
	})

	// Show Detail absen for laporan admin
	$(document).on('click', '.detil-absen-link', function(e) {
		e.preventDefault();
		var kode = $(this).data('kode');
		var text = kode.split('_');
		$('#modal-detil-absen').modal();

		var tdetilabsen = $('#table-detil-absen').on('init.dt', function(){
			$('#progress').removeClass('progress d-flex').addClass('d-none');
		}).DataTable({
			dom: 'Bftlip',
			buttons: [
				{
					extend: 'copy',
					text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
				},
				{
					extend: 'excel',
					text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
					messageTop: new Date(),
					title: 'jadwal Harian',
				},
				{
					extend: 'print',
					text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
					exportOptions: {
						stripHtml: false
					},
					title: 'Detil Absen '+text[4],
					messageBottom: `<div style="position:relative;display:block;width: 100%;">
										<div style="position:relative;margin-right:20px!important;">
											Malang, 12-09-2019<br>
											Guru Pengajar
											<br>
											<br>
											<br>
											<b><u>Joko Susilo</u></b><br>
											NIP. 19871209 201909 1 003
										</div>
									</div>`
				}
			],
			
			serverSide: true,
			processing: true,
			responsive: true,
			lengthMenu: [
				[10, 25, 50, 100, -1],
				['10', '25', '50', '100', 'Semua']
			],
			ajax: {
				url: '/ajax/detil/absen/'+kode,
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
				{ data: 'siswa_id', text: 'siswa_id'},
				{ data: 'siswas.nama_siswa', text: 'siswas.nama_siswa'},
				{ data: 'ket', render: function(data, type, row, meta) {
					var status = (data == 'h')? 'Hadir': (data == 'i')? 'Ijin' : (data == 's')? 'Sakit' : (data == 'a')? 'Alpa': 'Telat';
					return status;
				} }
			],
		}).on('draw.dt', function(){
			$('#progress').removeClass('progress d-flex').addClass('d-none');
		})
	});


	// Laporan Jurnal Pegawai
	$(document).on('submit', '#form-cek-jurnal-staf', function(e) {
		e.preventDefault();

		var data = $(this).serialize();

		var tlaporanjurnal = $('#table-laporan-jurnal')
			.on('draw.dt', function(){
				$('#progress').removeClass('d-flex progress').addClass('d-none');
			})
			.on('init.dt', function(){
				$('#progress').removeClass('d-flex progress').addClass('d-none');
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
						text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
						messageTop: new Date(),
						title: 'jadwal Harian',
					},
					{
						extend: 'print',
						text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
						exportOptions: {
							stripHtml: false
						},
						title: 'Laporan Jurnal Staf '+$('select[name="staf"] option:selected').text(),
						messageTop: '<h4>Bulan '+$('select[name="bulan"] option:selected').text() +' '+$('select[name="tahun"] option:selected').text()+'</h4>'
						// messageBottom: `<div style="position:relative;display:block;width: 100%;">
						// 					<div style="position:relative;margin-right:20px!important;">
						// 						Malang, 12-09-2019<br>
						// 						Guru Pengajar
						// 						<br>
						// 						<br>
						// 						<br>
						// 						<b><u>Joko Susilo</u></b><br>
						// 						NIP. 19871209 201909 1 003
						// 					</div>
						// 				</div>`
					}
				],
				
				serverSide: true,
				processing: true,
				responsive: true,
				lengthMenu: [
					[10, 25, 50, 100, -1],
					['10', '25', '50', '100', 'Semua']
				],
				ajax: {
					url: '/ajax/jurnal/laporan?staf='+$('select[name="staf"]').val()+'&bulan='+$('select[name="bulan"]').val()+'&tahun='+$('select[name="tahun"]').val(),
					// data: data,
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
					{ data: 'kode_jurnal', text: 'kode_jurnal'},
					{ data: 'tanggal', text: 'tanggal'},
					{ data: 'kegiatan', text: 'kegiatan'},
					{ data: 'lokasi', text: 'lokasi'},
					{ data: 'mulai', text: 'mulai'},
					{ data: 'selesai', text: 'selesai'},
					{ data: 'status', text: 'status'},
					{ data: 'ket', text: 'ket'},
				],
			})

	});
});