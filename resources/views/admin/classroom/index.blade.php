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
                <table class="datatables-classrooms table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>id</th>
                            <th>Nama</th>
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
                if (willDelete) {
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
    <script src="{{ asset('assets/js/core/classroom.js') }}"></script>
@endpush
