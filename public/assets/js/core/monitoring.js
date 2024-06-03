'use strict';

$(function () {
    let filter;

    var daTable = $('.datatables-monitoring').DataTable({
        processing: true,
        servicerSide: true,
        ajax: {
            url: "/admin/dashboard",
            type: "GET",
            async: false,
            responsive: true,
            data: function (d) {
                d.filter = filter;
            }
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'student.nik',
                name: 'student.nik'
            },
            {
                data: 'student.name',
                name: 'student.name'
            },
            {
                data: 'student.classroom.name',
                name: 'student.classroom.name'
            },
            {
                data: 'jam_in',
                name: 'jam_in'
            },
            {
                data: 'picture_in',
                name: 'picture_in'
            },
            {
                data: 'jam_out',
                name: 'jam_out'
            },
            {
                data: 'picture_out',
                name: 'picture_out'
            },
            {
                data: 'keterangan',
                name: 'keterangan'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    function refresh() {
        daTable.ajax.reload(null, false)
    }

    var datePicker = $("#date-presensi").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });

    var jamIn = $("#jam_in").flatpickr({
        enableTime: true,
        noCalendar: true
    });

    var jamOut = $("#jam_out").flatpickr({
        enableTime: true,
        noCalendar: true
    });

    datePicker.on('change', function () {
        filter = $(this).val()
        refresh()
        return filter
    })

    // $('#date-presensi').on('change', function () {
    //     var date = $(this).val()
    //     $.ajax({
    //         type: 'POST',
    //         url: '/admin/monitoring',
    //         data: {
    //             _token: $('meta[name="csrf-token"]').attr('content'),
    //             date: date
    //         },
    //         cache: false,
    //         success: function (res) {
    //             $('#table-body-presensi').html(res)
    //         }
    //     })
    // })

    // DataTable with buttons
    // --------------------------------------------------------------------

    // if (dt_basic_table.length) {
    //     dt_basic = dt_basic_table.DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: '/admin/monitoring',
    //         columns: [
    //             { data: '' },
    //             { data: 'id' },
    //             { data: 'student' },
    //             { data: 'classroom' },
    //             { data: 'jam_in' },
    //             { data: 'picture_in' },
    //             { data: 'jam_out' },
    //             { data: 'picture_out' },
    //             { data: '' }
    //         ],
    //         columnDefs: [
    //             {
    //                 // For Responsive
    //                 className: 'control',
    //                 orderable: false,
    //                 searchable: false,
    //                 responsivePriority: 2,
    //                 targets: 0,
    //                 render: function (data, type, full, meta) {
    //                     return '';
    //                 }
    //             },
    //             {
    //                 targets: 2,
    //                 render: function (data, type, full, meta) {
    //                     return full['student']['name']
    //                 }
    //             },
    //             {
    //                 targets: 3,
    //                 render: function (data, type, full, meta) {
    //                     return full['student']['classroom']['name']
    //                 }
    //             },
    //             {
    //                 targets: 5,
    //                 render: function (data, type, full, meta) {
    //                     var image = full['picture_in']

    //                     return '<img src="' + '/storage/uploads/absensi/' + image + '" class="img-fluid" width="70" height="70">';
    //                 }
    //             },
    //             {
    //                 targets: 7,
    //                 render: function (data, type, full, meta) {
    //                     var image = full['picture_out']

    //                     return '<img src="' + '/storage/uploads/absensi/' + image + '" class="img-fluid" width="70" height="70">';
    //                 }
    //             },
    //             {
    //                 // Actions
    //                 targets: -1,
    //                 title: 'Actions',
    //                 orderable: false,
    //                 searchable: false,
    //                 render: function (data, type, full, meta) {
    //                     var nik = full['nik']

    //                     return (
    //                         '<a href="/admin/master/student/' + nik + '" class="btn btn-sm btn-icon item-view"><i class="text-info ti ti-eye"></i></a>' +
    //                         '<a href="/admin/master/student/' + nik + '/edit" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>' +
    //                         '<a href="javascript:;" data-nik="' + nik + '" class="btn btn-sm btn-icon item-delete"><i class="text-danger ti ti-trash"></i></a>'
    //                     );
    //                 }
    //             }
    //         ],
    //         order: [[2, 'desc']],
    //         dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    //         displayLength: 7,
    //         lengthMenu: [7, 10, 25, 50, 75, 100],
    //         buttons: [
    //             {
    //                 extend: 'collection',
    //                 className: 'btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light',
    //                 text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
    //                 buttons: [
    //                     {
    //                         extend: 'print',
    //                         text: '<i class="ti ti-printer me-1" ></i>Print',
    //                         className: 'dropdown-item',
    //                         exportOptions: {
    //                             columns: [3, 4, 5, 6, 7],
    //                             // prevent avatar to be display
    //                             format: {
    //                                 body: function (inner, coldex, rowdex) {
    //                                     if (inner.length <= 0) return inner;
    //                                     var el = $.parseHTML(inner);
    //                                     var result = '';
    //                                     $.each(el, function (index, item) {
    //                                         if (item.classList !== undefined && item.classList.contains('user-name')) {
    //                                             result = result + item.lastChild.firstChild.textContent;
    //                                         } else if (item.innerText === undefined) {
    //                                             result = result + item.textContent;
    //                                         } else result = result + item.innerText;
    //                                     });
    //                                     return result;
    //                                 }
    //                             }
    //                         },
    //                         customize: function (win) {
    //                             //customize print view for dark
    //                             $(win.document.body)
    //                                 .css('color', config.colors.headingColor)
    //                                 .css('border-color', config.colors.borderColor)
    //                                 .css('background-color', config.colors.bodyBg);
    //                             $(win.document.body)
    //                                 .find('table')
    //                                 .addClass('compact')
    //                                 .css('color', 'inherit')
    //                                 .css('border-color', 'inherit')
    //                                 .css('background-color', 'inherit');
    //                         }
    //                     },
    //                     {
    //                         extend: 'csv',
    //                         text: '<i class="ti ti-file-text me-1" ></i>Csv',
    //                         className: 'dropdown-item',
    //                         exportOptions: {
    //                             columns: [3, 4, 5, 6, 7],
    //                             // prevent avatar to be display
    //                             format: {
    //                                 body: function (inner, coldex, rowdex) {
    //                                     if (inner.length <= 0) return inner;
    //                                     var el = $.parseHTML(inner);
    //                                     var result = '';
    //                                     $.each(el, function (index, item) {
    //                                         if (item.classList !== undefined && item.classList.contains('user-name')) {
    //                                             result = result + item.lastChild.firstChild.textContent;
    //                                         } else if (item.innerText === undefined) {
    //                                             result = result + item.textContent;
    //                                         } else result = result + item.innerText;
    //                                     });
    //                                     return result;
    //                                 }
    //                             }
    //                         }
    //                     },
    //                     {
    //                         extend: 'excel',
    //                         text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
    //                         className: 'dropdown-item',
    //                         exportOptions: {
    //                             columns: [3, 4, 5, 6, 7],
    //                             // prevent avatar to be display
    //                             format: {
    //                                 body: function (inner, coldex, rowdex) {
    //                                     if (inner.length <= 0) return inner;
    //                                     var el = $.parseHTML(inner);
    //                                     var result = '';
    //                                     $.each(el, function (index, item) {
    //                                         if (item.classList !== undefined && item.classList.contains('user-name')) {
    //                                             result = result + item.lastChild.firstChild.textContent;
    //                                         } else if (item.innerText === undefined) {
    //                                             result = result + item.textContent;
    //                                         } else result = result + item.innerText;
    //                                     });
    //                                     return result;
    //                                 }
    //                             }
    //                         }
    //                     },
    //                     {
    //                         extend: 'pdf',
    //                         text: '<i class="ti ti-file-description me-1"></i>Pdf',
    //                         className: 'dropdown-item',
    //                         exportOptions: {
    //                             columns: [3, 4, 5, 6, 7],
    //                             // prevent avatar to be display
    //                             format: {
    //                                 body: function (inner, coldex, rowdex) {
    //                                     if (inner.length <= 0) return inner;
    //                                     var el = $.parseHTML(inner);
    //                                     var result = '';
    //                                     $.each(el, function (index, item) {
    //                                         if (item.classList !== undefined && item.classList.contains('user-name')) {
    //                                             result = result + item.lastChild.firstChild.textContent;
    //                                         } else if (item.innerText === undefined) {
    //                                             result = result + item.textContent;
    //                                         } else result = result + item.innerText;
    //                                     });
    //                                     return result;
    //                                 }
    //                             }
    //                         }
    //                     },
    //                     {
    //                         extend: 'copy',
    //                         text: '<i class="ti ti-copy me-1" ></i>Copy',
    //                         className: 'dropdown-item',
    //                         exportOptions: {
    //                             columns: [3, 4, 5, 6, 7],
    //                             // prevent avatar to be display
    //                             format: {
    //                                 body: function (inner, coldex, rowdex) {
    //                                     if (inner.length <= 0) return inner;
    //                                     var el = $.parseHTML(inner);
    //                                     var result = '';
    //                                     $.each(el, function (index, item) {
    //                                         if (item.classList !== undefined && item.classList.contains('user-name')) {
    //                                             result = result + item.lastChild.firstChild.textContent;
    //                                         } else if (item.innerText === undefined) {
    //                                             result = result + item.textContent;
    //                                         } else result = result + item.innerText;
    //                                     });
    //                                     return result;
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 ]
    //             },
    //             {
    //                 text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Siswa</span>',
    //                 className: 'create-new btn btn-primary waves-effect waves-light',
    //                 action: function () {
    //                     window.location.href = "/admin/master/student/create"
    //                 }
    //             }
    //         ],
    //         responsive: {
    //             details: {
    //                 display: $.fn.dataTable.Responsive.display.modal({
    //                     header: function (row) {
    //                         var data = row.data();
    //                         return 'Details of ' + data['full_name'];
    //                     }
    //                 }),
    //                 type: 'column',
    //                 renderer: function (api, rowIdx, columns) {
    //                     var data = $.map(columns, function (col, i) {
    //                         return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
    //                             ? '<tr data-dt-row="' +
    //                             col.rowIndex +
    //                             '" data-dt-column="' +
    //                             col.columnIndex +
    //                             '">' +
    //                             '<td>' +
    //                             col.title +
    //                             ':' +
    //                             '</td> ' +
    //                             '<td>' +
    //                             col.data +
    //                             '</td>' +
    //                             '</tr>'
    //                             : '';
    //                     }).join('');

    //                     return data ? $('<table class="table"/><tbody />').append(data) : false;
    //                 }
    //             }
    //         }
    //     });
    //     $('div.head-label').html('<h5 class="card-title mb-0">DataTable with Buttons</h5>');
    // }

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);

    // Select2 Classroom
    // $('.select2').select2({
    //     placeholder: 'Pilih Kelas'
    // })

});
