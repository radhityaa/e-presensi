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
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endpush

@section('title')
    Daftar Kelas
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <!-- DataTable -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                @role('admin|staff')
                    <div class="d-flex justify-content-end p-3">
                        <a href="{{ route('admin.classroom.create') }}" class="btn btn-sm btn-success"><i
                                class="ti ti-plus me-sm-1"></i>
                            Tambah Kelas</a>
                    </div>
                @endrole
                <table class="datatables-classrooms table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>#</th>
                            <th>Kelas</th>
                            <th>Wali Kelas</th>
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
    <script src="{{ asset('assets/template/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.item-delete', function() {
            var name = $(this).data('name')
            var id = $(this).data('id')
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data Kelas ' + name + ' akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin, Hapus',
                showLoaderOnConfirm: true,
                customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-label-danger waves-effect waves-light'
                },
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.ajax({
                        url: '/admin/master/classroom/' + id,
                        type: 'DELETE',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Data Kelas Berhasil Dihapus.',
                                customClass: {
                                    confirmButton: 'btn btn-success waves-effect waves-light'
                                }
                            });
                            $('.datatables-classrooms').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Gagal menghapus data kelas.',
                                customClass: {
                                    confirmButton: 'btn btn-success waves-effect waves-light'
                                }
                            });
                            $('.datatables-classrooms').DataTable().ajax.reload();
                        }
                    });
                }
            });
        })
    </script>
    <script>
        var daTables = $('.datatables-classrooms').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.classroom.index') }}",
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
                    targets: 3,
                    responsivePriority: 3
                },
                {
                    targets: 4,
                    responsivePriority: 1,
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return data['name'];
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
            }
        })
    </script>
@endpush
