$(document).ready(function() {
    var headers =  {
		'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };
    // alert(headers);
    var tjurnalku = $('#table-jurnalku')
        .on('init.dt', function(){
            $('#progress').removeClass('progress d-flex').addClass('d-none');
        })
        .on('draw.dt', function(){
            $('#progress').removeClass('progress d-flex').addClass('d-none');
        })
        .DataTable({
            dom: 'Bftip',
            buttons: [
                {
                    extend: 'copy',
                    text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
                },
                {
                    extend: 'excel',
                    text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
                    messageTop: new Date(),
                    title: 'Jurnal Saya',
                },
                {
                    extend: 'print',
                    text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
                    exportOptions: {
                        stripHtml: false
                    },
                    title: 'Jurnal Saya',
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
                url: '/ajax/jurnalku',
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
                { data: 'kode_jurnal', text: 'kode_jurnal'},
                { data: 'tanggal', text: 'tanggal'},
                { data: 'kegiatan', text: 'kegiatan'},
                { data: 'mulai', text: 'mulai'},
                { data: 'selesai', text: 'selesai'},
                { data: 'status', render: function(data, type, row, meta) {
                    var status = (data == '0') ? '<span class="text-danger" title="Belum divalidasi Ka TU"><i class="fa fa-exclamation-triangle"></i></span>' : '<span class="text-success" title="Sudah divalidasi Ka TU"><i class="fa fa-thumbs-up"></i></span>';
                    return status;
                }},
                { data: 'ket', render: function(data, type, row, meta) {
                    var opts = [
                        { text: 'Proses', val : 'proses' },
                        { text: 'Selesai', val : 'selesai' },
                        { text: 'Batal', val : 'batal' },

                    ];
                    var ops = '';
                    opts.forEach(item => {
                        var selected = (item.val == data) ? 'selected': '';
                        ops += `<option value="${item.val}" ${selected}>${item.text}</option>`;
                    });

                    return `<select name="ket" class="form-control selKet">${ops}</select>`;
                }},
                
            ]
        });

    $('#btn-modal-jurnal-staf').on('click', function(){
        $('#modal-jurnal-staf .modal-title').text('Isi Jurnal Harian');
        $('#modal-jurnal-staf').modal();
    });
    
    $(document).on('submit', '#form-jurnal-staf', function(e){
        e.preventDefault();
        var data = $(this).serialize();
        // console.log(data);
        $.ajax({
            url: '/ajax/jurnal/isi',
            type:'post',
            data: data,
            headers:headers,
            beforeSend: function(){
                $('#progress').addClass('d-flex progress').removeClass('d-none');
            },
            
        }).done(res => {
            console.log(res)
        }).fail(err => {
            Swal.fire(err.status, err.statusText, 'error');
        }).always(function(){
            $('#progress').removeClass('d-flex progress').addClass('d-none');
        })
    });

    
    $(document)
    .on('focus', '.selKet', function() {
        // alert('hi');
        var data = tjurnalku.row($(this).parents('tr')).data();
		if(data == undefined) {
			var selected_row = $(this).parents('tr');
			if(selected_row.hasClass('child')) {
				selected_row = selected_row.prev();
				data = tjurnalku.row(selected_row).data();
			}
        }
        $(this).data('old', $(this).val());
        // alert($(this).val())
    })
    .on('change', '.selKet', function(){
        var data = tjurnalku.row($(this).parents('tr')).data();
		if(data == undefined) {
			var selected_row = $(this).parents('tr');
			if(selected_row.hasClass('child')) {
				selected_row = selected_row.prev();
				data = tjurnalku.row(selected_row).data();
			}
        }
        // alert($(this).data('old'));
        var newKet = $(this).val();
        Swal.fire({
			showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'green',
                confirmButtonText: 'Lanjut',
                cancelButtonText: 'Batal',
                titleText: 'Anda akan mengubah status jurnal'+data.kode_jurnal+'?'             
            }).then(result => {
                if (result.value) {
					$('#progress').addClass('progress d-flex').removeClass('d-none');
                    $.ajax({
                        url: '/ajax/jurnal/update/'+data.kode_jurnal,
                        type: 'put',
                        headers: headers,
						data: { 'newKet' : newKet, 'kode_jurnal' : data.kode_jurnal },
						dataType: 'json',
						
                    }).done(res => {
                        Swal.fire('Info', 'Jurnal Anda: '+data.kode_jurnal+' diperbarui. ;)', 'info');
                        tjurnalku.draw();
						
					}).fail(err => {
						Swal.fire('Error', err.msg, 'error');
					}).always(function() {
						$('#progress').removeClass('progress d-flex').addClass('d-none');
					})
                } else {
                    $(this).val($(this).data('old'));
                    return false;
                }
		});
    });

    var tanggal = ($('#tanggal').val() != '') ? $('#tanggal').val() : 'today';
    var tjurnalStafs = $('#table-jurnal-staf')
    .on('init.dt', function(){
        $('#progress').removeClass('progress d-flex').addClass('d-none');
    })
    .on('draw.dt', function(){
        $('#progress').removeClass('progress d-flex').addClass('d-none');
    })
    .DataTable({
        dom: 'Bftip',
        buttons: [
            {
                extend: 'copy',
                text: '<span style="color: orangered;"><i class="fa fa-copy"></i> Salin</span>'
            },
            {
                extend: 'excel',
                text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
                messageTop: new Date(),
                title: 'Jurnal Saya',
            },
            {
                extend: 'print',
                text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
                exportOptions: {
                    stripHtml: false
                },
                title: 'Jurnal Saya',
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
            url: '/ajax/jurnal/stafs/'+tanggal,
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
            { data: 'staf_id', text: 'staf_id'},
            { data: 'stafs.fullname', text: 'stafs.fullname'},
            { data: 'kode_jurnal', text: 'kode_jurnal'},
            { data: 'tanggal', text: 'tanggal'},
            { data: 'kegiatan', text: 'kegiatan'},
            { data: 'mulai', text: 'mulai'},
            { data: 'selesai', text: 'selesai'},
            { data: 'status', render: function(data, type, row, meta) {
                var checked = (data == '0') ? '' : 'checked';
                var status = (data == '0') ? 'Invalid':'valid';
                var check = `<input type="checkbox" name="status" class="status" ${checked}> <label> ${status}</label>`;
                return check;
            }},
            { data: 'ket', render: function(data, type, row, meta) {
                var opts = [
                    { text: 'Proses', val : 'proses' },
                    { text: 'Selesai', val : 'selesai' },
                    { text: 'Batal', val : 'batal' },

                ];
                var ops = '';
                opts.forEach(item => {
                    var selected = (item.val == data) ? 'selected': '';
                    ops += `<option value="${item.val}" ${selected}>${item.text}</option>`;
                });

                return `<select name="ket" class="form-control selKet">${ops}</select>`;
            }},
            
        ]
    });

    $(document)
    .on('change', '.status', function(){
        var before = !$(this).val();
        var val = $(this).val();
        var data = tjurnalStafs.row($(this).parents('tr')).data();
		if(data == undefined) {
			var selected_row = $(this).parents('tr');
			if(selected_row.hasClass('child')) {
				selected_row = selected_row.prev();
				data = tjurnalStafs.row(selected_row).data();
			}
        }
            // alert(val);

        var text = (val == 'on') ? 'Anda ingin memvalidasi jurnal '+data.kode_jurnal+', milik '+data.stafs.fullname+'?' : 'Anda ingin membatalkan validasi jurnal '+data.kode_jurnal+', milik '+data.stafs.fullname+'?';
        var valid = (val == 'on') ? 'validate' : 'invalidate';

        Swal.fire({
			showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'green',
                confirmButtonText: 'Lanjut',
                cancelButtonText: 'Batal',
                titleText: text+' '+data.kode_jurnal+'?'             
            }).then(result => {
                if (result.value) {
					$('#progress').addClass('progress d-flex').removeClass('d-none');
                    $.ajax({
                        url: '/ajax/jurnal/validasi/'+valid+'/kode/'+data.kode_jurnal,
                        type: 'put',
                        headers: headers,
						// data: { 'newKet' : newKet, 'kode_jurnal' : data.kode_jurnal },
						dataType: 'json',
						
                    }).done(res => {
						Swal.fire('Info', 'Status jurnal '+data.stafs.fullname+' telah diubah.', 'info');
                        // $(this).closest('label').text('valid');
                        tjurnalStafs.draw();
					}).fail(err => {
						Swal.fire('Error', err.msg, 'error');
					}).always(function() {
						$('#progress').removeClass('progress d-flex').addClass('d-none');
					})
                } else {
                    $(this).val(before);
                    return false;
                }
		});
    });

    $(document).on('submit', '#form-cek-jurnal-staf', function(e) {
        e.preventDefault();
        var data = $(this).serialize();

        tjurnalStafs.ajax.url('/ajax/jurnal/stafs/'+$('#tanggal').val()).load();
    })

    var tstafs = $('#table-stafs')
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
                text: '<span style="color: green;"><i class="fa fa-file-excel"></i> Excel</span>',
                messageTop: new Date(),
                title: 'Jurnal Saya',
            },
            {
                extend: 'print',
                text: '<span style="color: teal;"><i class="fa fa-print"></i> Cetak</span>',
                exportOptions: {
                    stripHtml: false
                },
                title: 'Jurnal Saya',
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
            url: '/ajax/stafs',
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
            { data: 'nip', text: 'nip'},
            { data: 'fullname', text: 'fullname'},
            { data: 'hp', text: 'hp' },
            { data: 'email', text: 'email' },
            { data: null, defaultContent: '<button class="btn-c btn-danger btn-send-message"><i class="fa fa-envelope"></i>' }
            
        ]
    });
});