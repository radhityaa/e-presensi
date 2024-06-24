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
    Daftar Mata Pelajaran
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <!-- DataTable -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <div class="d-flex justify-content-end p-3">
                    <button type="button" id="button-add" class="btn btn-sm btn-success"><i class="ti ti-plus me-sm-1"></i>
                        Tambah Mata Pelajaran</button>
                </div>
                <table class="datatables-subjects table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalSubject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSubjectTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Nama Mata Pelajaran</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Nama Pelajaran" required />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                    <x-button-loading />
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('assets/template/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script>
        let method
        let url

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getMethod() {
            return method
        }

        function getUrl() {
            return url
        }

        function refresh() {
            $('.datatables-subjects').DataTable().ajax.reload(null, false)
        }

        $('#button-add').on('click', function() {
            $('#modalSubject').modal('show')
            $('#modalSubjectTitle').html('Tambah Mata Pelajaran')
            $('#name').val('')
            method = 'POST'
            url = "{{ route('admin.settings.subjects.store') }}"
        })

        $(document).on('click', '.item-delete', function() {
            var name = $(this).data('name')
            var id = $(this).data('id')
            url = "{{ route('admin.settings.subjects.destroy', ':id') }}"
            url = url.replace(':id', id)

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Mata Pelajaran ' + name + ' akan dihapus.',
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
                        url: url,
                        type: 'DELETE',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Mata pelajaran Berhasil Dihapus.',
                                customClass: {
                                    confirmButton: 'btn btn-success waves-effect waves-light'
                                }
                            });

                            refresh()
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Gagal menghapus mata pelajaran.',
                                customClass: {
                                    confirmButton: 'btn btn-success waves-effect waves-light'
                                }
                            });

                            refresh()
                        }
                    });
                }
            });
        })

        $(document).on('click', '.item-edit', function() {
            var name = $(this).data('name')
            var id = $(this).data('id')
            url = "{{ route('admin.settings.subjects.update', ':id') }}"
            url = url.replace(':id', id)
            method = 'PUT'

            let editUrl = "{{ route('admin.settings.subjects.edit', ':id') }}"
            editUrl = editUrl.replace(':id', id)


            $.get(editUrl, function(res) {
                $('#modalSubject').modal('show')
                $('#modalSubjectTitle').html('Edit Mata Pelajaran')
                $('#name').val(res.name)
            })
        })

        var daTables = $('.datatables-subjects').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.settings.subjects.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        })

        $(document).ready(function() {
            $('#modalSubject').on('hidden.bs.modal', function() {
                $('#name').val('')

                $('.btn-save').removeClass('d-none')
                $('.btn-loading').addClass('d-none')
            })

            $('#modalSubject').on('submit', function(e) {
                e.preventDefault()

                $('.btn-save').addClass('d-none')
                $('.btn-loading').removeClass('d-none')
                var name = $('#name').val()

                $.ajax({
                    url: getUrl(),
                    method: getMethod(),
                    data: {
                        name
                    },
                    success: function(res) {
                        $('.btn-save').removeClass('d-none')
                        $('.btn-loading').addClass('d-none')

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            customClass: {
                                confirmButton: 'btn btn-success waves-effect waves-light'
                            }
                        });

                        $('#modalSubject').modal('hide')
                        refresh()
                    },
                    error: function(err) {
                        $('.btn-save').removeClass('d-none')
                        $('.btn-loading').addClass('d-none')

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: err.responseJSON.message,
                            customClass: {
                                confirmButton: 'btn btn-success waves-effect waves-light'
                            }
                        });

                        $('#modalSubject').modal('hide')
                        refresh()
                    }
                })
            })
        })
    </script>
@endpush
