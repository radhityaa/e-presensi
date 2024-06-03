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
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Kelas</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th></th>
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
            servicerSide: true,
            ajax: {
                url: "{{ route('admin.submission.index') }}",
                type: "GET",
                async: false,
                responsive: true,
            },
            columns: [{
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
            ]
        });

        function refresh() {
            table.ajax.reload(null, false)
        }
    </script>
@endpush
