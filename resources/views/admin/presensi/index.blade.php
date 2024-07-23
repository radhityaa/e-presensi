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
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/template/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('title')
    Data Absensi
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <!-- DataTable -->
        <div class="card">
            <div class="row align-items-center justify-content-between mb-3 p-3">
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon11"><i class="fa-regular fa-calendar"></i></span>
                        <input type="text" class="form-control" placeholder="Tanggal Presensi" id="date-presensi"
                            name="date-presensi" value="{{ date('Y-m-d') }}" autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <button class="btn btn-success" id="btn-add-presensi"><i class="fa-regular fa-plus me-2"></i>
                        Tambah Presensi</button>
                </div>
            </div>
            <div class="card-datatable table-responsive pt-0">
                <table class="table table-hover datatables-presensi">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Jam Masuk</th>
                            <th>Foto</th>
                            <th>Jam Pulang</th>
                            <th>Foto</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="table-body-presensi"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal modal-lg fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="" id="form-modal">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="nik" class="form-label">NIK</label>
                                <select name="nik" id="nik" class="form-control select2">
                                    <option value="">Pilih Siswa</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" disabled />
                            </div>
                            <div class="col">
                                <label for="classroom" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="classroom" name="classroom" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="jam_in" class="form-label">Jam Absen Masuk</label>
                                <input type="time" class="form-control" placeholder="Tanggal Absensi" id="jam_in"
                                    name="jam_in" autocomplete="off" required />
                            </div>
                            <div class="col">
                                <label for="picture_in" class="form-label">Foto Absen Masuk</label>
                                <div class="avatar me-2 img-fluid overflow-hidden" style="width: 50px; height: 50px;">
                                    <a href="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" id="href_picture_in"
                                        data-lightbox="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}">
                                        <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}"
                                            class="rounded img-fluid" id="picture_in" name="picture_in">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="jam_out" class="form-label">Jam Absen Pulang</label>
                                <input type="time" class="form-control" placeholder="Tanggal Absensi" id="jam_out"
                                    name="jam_out" autocomplete="off" required />
                            </div>
                            <div class="col">
                                <label for="picture_in" class="form-label">Foto Absen Pulang</label>
                                <div class="avatar me-2 img-fluid overflow-hidden" style="width: 50px; height: 50px;">
                                    <a href="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" id="href_picture_out"
                                        data-lightbox="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}">
                                        <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}"
                                            class="rounded img-fluid" id="picture_out" name="picture_out">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" disabled />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                            <x-button-loading />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('assets/template/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/select2/select2.js') }}"></script>

    <script>
        let url = '';
        let method = '';
        let filter

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getUrl() {
            return url
        }

        function getMethod() {
            return method
        }

        $(document).ready(function() {
            $('#formModal').on('hidden.bs.modal', function() {
                $('.modal-body form')[0].reset();
                $('input[name="_method"]').remove();
                $('.btn-loading').addClass('d-none')
                $('.btn-save').removeClass('d-none')
                $('#nik').val(null).trigger('change'); // Reset select2
                $('#name').val(''); // Reset input name
                $('#classroom').val(''); // Reset input classroom
            })

            $('#nik').select2({
                dropdownParent: $('#formModal'),
                ajax: {
                    url: "{{ route('admin.student.list') }}",
                    type: "GET",
                    dataType: "json",
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(res) {
                        return {
                            results: $.map(res.data, function(item) {
                                return {
                                    text: item.nik,
                                    id: item.id,
                                    name: item.name,
                                    classroom: item.classroom
                                }
                            })
                        };
                    }
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;
                $('#name').val(data.name);
                $('#classroom').val(data.classroom.name);
            });

            $('#form-modal').on('submit', function(e) {
                e.preventDefault()
                $('.btn-loading').removeClass('d-none')
                $('.btn-save').addClass('d-none')

                $.ajax({
                    url: getUrl(),
                    method: getMethod(),
                    data: $(this).serialize(),
                    success: function(res) {
                        $('#formModal').modal('hide')
                        refresh()

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal2-popup'
                            }
                        })

                        $('.btn-loading').addClass('d-none')
                        $('.btn-save').removeClass('d-none')
                    },
                    error: function(err) {
                        console.log(err);
                        $('#formModal').modal('hide')
                        refresh()

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Internal Server Error',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal2-popup'
                            }
                        })

                        $('.btn-loading').addClass('d-none')
                        $('.btn-save').removeClass('d-none')
                    }
                })
            })
        })

        $('#btn-add-presensi').on('click', function() {
            $('#formModal').modal('show')
            url = "{{ route('admin.presensi.store') }}"
            method = "POST"
        })

        var daTables = $('.datatables-presensi').DataTable({
            processing: true,
            serverside: true,
            ajax: {
                url: "{{ route('admin.presensi.index') }}",
                type: "GET",
                data: function(d) {
                    d.filter = filter
                }
            },
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
                    data: 'student.nik',
                    name: 'student.nik'
                },
                {
                    data: 'student.name',
                    name: 'student.name'
                },
                {
                    data: 'student.classroom.name',
                    name: 'student.classroom.name',
                },
                {
                    data: 'jam_in',
                    name: 'jam_in'
                },
                {
                    data: 'picture_in',
                    name: 'picture_in',
                },
                {
                    data: 'jam_out',
                    name: 'jam_out'
                },
                {
                    data: 'picture_out',
                    name: 'picture_out',
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
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
                            return data['student']['name'];
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

        function calculateTimeDifference(jam_in, jam_out) {
            // Parse jam_in
            let [h_in, m_in, s_in] = jam_in.split(':').map(Number);
            let dtEarly = new Date(2000, 0, 1, h_in, m_in, s_in); // Use any arbitrary date

            // Parse jam_out
            let [h_out, m_out, s_out] = jam_out.split(':').map(Number);
            let dtLate = new Date(2000, 0, 1, h_out, m_out, s_out); // Use the same arbitrary date

            // Calculate the difference in milliseconds
            let dtDifference = dtLate - dtEarly;

            // Calculate hours, minutes, and seconds
            let hours = Math.floor(dtDifference / 3600000); // 3600000 ms in an hour
            let minutes = Math.floor((dtDifference % 3600000) / 60000); // 60000 ms in a minute
            let seconds = Math.floor((dtDifference % 60000) / 1000); // 1000 ms in a second

            // Return the formatted time difference
            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        function show(id) {
            $('.modal-body form #nik').prop('disabled', true);
            $('.modal-body form #name').prop('disabled', true);
            $('.modal-body form #classroom').prop('disabled', true);
            $('.modal-body form #keterangan').prop('disabled', true);
            $('.modal-body form').append('<input type="hidden" name="_method" value="PUT">')

            url = "{!! route('admin.presensi.update', ':id') !!}"
            url = url.replace(':id', id)
            method = 'PUT'

            $('#formModalLabel').text('Detail Absensi')
            let time = $('#btn-show').attr('data-time')
            let formattedTime = $('#btn-show').attr('data-formatted-time')

            let showUrl = "{!! route('admin.presensi.show', ':id') !!}"
            showUrl = showUrl.replace(':id', id)
            $.get(showUrl, function(res) {
                $('#formModal').modal('show')
                $('#nik').val(res.student.nik)
                $('#name').val(res.student.name)
                $('#classroom').val(res.student.classroom.name)
                $('#jam_in').val(res.jam_in)
                $('#jam_out').val(res.jam_out)

                if (res.jam_in >= formattedTime) {
                    $('#keterangan').val('Terlambat: ' + calculateTimeDifference(time, res
                        .jam_in))
                } else {
                    $('#keterangan').val("Tepat Waktu")
                }

                // Image
                var imageUrlIn = "{{ url(Storage::url('uploads/absensi/')) }}" + "/" + res.picture_in
                $('#picture_in').attr('src', imageUrlIn)
                $('#href_picture_in').attr('href', imageUrlIn)
                $('#href_picture_in').attr('data-lightbox', imageUrlIn)

                if (res.picture_out != null) {
                    var imageUrlOut = "{{ url(Storage::url('uploads/absensi/')) }}" + "/" + res.picture_out
                    $('#picture_out').attr('src', imageUrlOut)
                    $('#href_picture_out').attr('href', imageUrlOut)
                    $('#href_picture_out').attr('data-lightbox', imageUrlOut)
                }
            })
        }

        function refresh() {
            daTables.ajax.reload(null, false)
        }

        var datePicker = $("#date-presensi").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });

        datePicker.on('change', function() {
            filter = $(this).val()
            refresh()
            return filter
        })
    </script>
@endpush
