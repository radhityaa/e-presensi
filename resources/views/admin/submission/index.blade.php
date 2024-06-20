@extends('layouts.admin.template')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/template/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/template/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/template/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
@endpush

@section('title')
    Data Pengajuan
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <!-- DataTable -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-submission table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('assets/template/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

    <script>
        let url = ''
        let method = ''

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.datatables-submission').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.submission.index') }}",
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    searchable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function(data, type, full, meta) {
                        return '';
                    },
                },
                {
                    target: 1,
                    visible: false
                },
                {
                    targets: 5,
                    responsivePriority: 3
                },
                {
                    targets: 7,
                    responsivePriority: 1,
                },
                {
                    targets: 8,
                    responsivePriority: 4,
                },
            ],
            columns: [{
                    data: '',
                    name: ''
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'approve',
                    name: 'approve'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return data['student'].name;
                        }
                    }),
                    type: 'column',
                    renderer: function(api, rowIdx, columns) {
                        var data = $.map(columns, function(col, i) {
                            return col.title !==
                                '' // ? Do not show row in modal popup if title is blank (for check box)
                                ?
                                '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>' :
                                '';
                        }).join('');

                        return data ? $('<table class="table"/><tbody />').append(data) : false;
                    }
                }
            },
        });

        function refresh() {
            table.ajax.reload(null, false)
        }
    </script>
@endpush
