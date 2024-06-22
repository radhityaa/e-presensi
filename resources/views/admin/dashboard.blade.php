@extends('layouts.admin.template')

@section('title')
    Dashboard
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/leaflet/leaflet.css') }}" />
@endpush

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">Statistics</h5>
                <small class="text-muted">Update Per Hari Ini</small>
            </div>
            <div class="card-body pt-2">
                <div class="row gy-3">
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                                <i class="ti ti-fingerprint ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">{{ empty($rekapAbsen->total_hadir) ? 0 : $rekapAbsen->total_hadir }}</h5>
                                <small>Hadir</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-file-text ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{ empty($recapSubmmission->total_izin) ? 0 : $recapSubmmission->total_izin }}</h5>
                                <small>Izin</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-warning me-3 p-2">
                                <i class="ti ti-mood-sick ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{ empty($recapSubmmission->total_sakit) ? 0 : $recapSubmmission->total_sakit }}
                                </h5>
                                <small>Sakit</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-clock ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0">
                                    {{ empty($rekapAbsen->total_terlambat) ? 0 : $rekapAbsen->total_terlambat }}
                                </h5>
                                <small>Terlambat</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 me-2">{{ $students }}</h5>
                        <small>Jumlah Murid</small>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-primary rounded-pill p-2">
                            <i class="ti ti-users ti-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5 class="p-3">Monitoring Presensi</h5>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-3">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon11"><i class="fa-regular fa-calendar"></i></span>
                        <input type="text" class="form-control" placeholder="Tanggal Presensi" id="date-presensi"
                            name="date-presensi" value="{{ date('Y-m-d') }}" autocomplete="off" />
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="row">
                <div class="col-12">
                    <div class="card-datatable table-responsive">
                        <table class="table table-hover datatables-monitoring">
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
                                <input type="text" class="form-control" id="nik" name="nik" />
                            </div>
                            <div class="col">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" />
                            </div>
                            <div class="col">
                                <label for="classroom" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="classroom" name="classroom" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="jam_in" class="form-label">Jam Absen Masuk</label>
                                <input type="text" class="form-control" placeholder="Tanggal Absensi" id="jam_in"
                                    name="jam_in" autocomplete="off" />
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
                                <input type="text" class="form-control" placeholder="Tanggal Absensi" id="jam_out"
                                    name="jam_out" autocomplete="off" />
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
                                <input type="text" class="form-control" id="keterangan" name="keterangan" />
                            </div>
                        </div>
                        <div class="row mb-3 p-2">
                            <div class="leaflet-map" id="mapPresensi"></div>
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
    <script src="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <script>
        let url = '';
        let method = '';

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

        var daTables = $('.datatables-monitoring').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{ route('admin.dashboard') }}",
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
            $('.btn-save').addClass('d-none')
            $('.modal-body form').find('input').prop('disabled', true);
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

                // Maps / Location
                var currentLocation = res.location_in
                var location = currentLocation.split(',')
                var latitude = location[0]
                var longitude = location[1]

                const mapPresensi = L.map('mapPresensi').setView([latitude, longitude], 18);
                L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    maxZoom: 19
                }).addTo(mapPresensi);
                var marker = L.marker([latitude, longitude]).addTo(mapPresensi);
                var circle = L.circle([-6.369089, 107.399181], {
                    color: 'green',
                    fillColor: '#4ade80',
                    fillOpacity: 0.5,
                    radius: 20
                }).addTo(mapPresensi);
                var popup = L.popup()
                    .setLatLng([latitude, longitude])
                    .setContent(res.student.name)
                    .openOn(mapPresensi);
            })
        }
    </script>
@endpush
