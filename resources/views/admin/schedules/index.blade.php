@extends('layouts.admin.template')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('title')
    Daftar Jadwal Pelajaran
@endsection

@section('content')
    <div class="col-12">
        <h4 class="card-title mb-3">Ubah Jadwal Pelajaran</h4>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="classroom_id" class="form-label">Kelas</label>
                        <select name="classroom_id" id="classroom_id" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col mb-3">
                        <label for="day" class="form-label">Hari</label>
                        <select name="day" id="day" class="form-control" required>
                            <option value="">Pilih Kelas Dulu</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-3" id="table-el" style="display: none;">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <div class="d-flex justify-content-end p-3">
                        <button type="button" id="button-add" class="btn btn-sm btn-success"><i
                                class="ti ti-plus me-sm-1"></i>
                            Tambah Jadwal Pelajaran</button>
                    </div>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="schedules"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalSchedule" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScheduleTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="classroom_add" class="form-label">Kelas</label>
                                <input type="text" id="classroom_add" name="classroom_add" class="form-control"
                                    placeholder="Kelas" disabled />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="day_add" class="form-label">Hari</label>
                                <input type="text" id="day_add" name="day_add" class="form-control" placeholder="Hari"
                                    disabled />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="subject" class="form-label">Mata Pelajaran</label>
                                <select name="subject" id="subject" class="form-control" required></select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="user" class="form-label">Guru</label>
                                <select name="user" id="user" class="form-control" required></select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="start_time" class="form-label">Jam Mulai</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required />
                            </div>
                            <div class="col-6 mb-3">
                                <label for="end_time" class="form-label">Jam Selesai</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" required />
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
    <script src="{{ asset('assets/template/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/select2/select2.js') }}"></script>

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

        function reload() {
            window.location.reload()
        }

        $(document).ready(function() {
            $('#modalSchedule').on('hidden.bs.modal', function() {
                $('.modal-body form')[0].reset();

                $('.btn-save').removeClass('d-none')
                $('.btn-loading').addClass('d-none')
            })

            $('#classroom_id').select2({
                placeholder: 'Pilih Kelas'
            })

            $('#day').select2()

            $('#subject').select2({
                dropdownParent: $('#modalSchedule')
            })

            $('#user').select2({
                dropdownParent: $('#modalSchedule')
            })

            $('#modalSchedule').on('submit', function(e) {
                e.preventDefault()
                $('.btn-save').addClass('d-none')
                $('.btn-loading').removeClass('d-none')

                var classroomId = $('#classroom_id').val()
                var subjectId = $('#subject').val()
                var userId = $('#user').val()
                var day = $('#day').val()
                var startTime = $('#start_time').val()
                var endTime = $('#end_time').val()

                $.ajax({
                    url: getUrl(),
                    method: getMethod(),
                    data: {
                        classroom_id: classroomId,
                        subject_id: subjectId,
                        user_id: userId,
                        day: day,
                        start_time: startTime,
                        end_time: endTime
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
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                reload()
                            }
                        });

                        $('#modalSchedule').modal('hide')
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
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                reload()
                            }
                        });

                        $('#modalSchedule').modal('hide')
                    }
                })
            })
        })

        $('#button-add').on('click', function() {
            $('#modalSchedule').modal('show')
            $('#modalScheduleTitle').html('Tambah Jadwal Pelajaran')

            url = "{{ route('admin.settings.schedules.store') }}"
            method = "POST"

            var classroom = $('#classroom_id').find('option:selected').text()
            var day = $('#day').val()
            $('#classroom_add').val(classroom)
            $('#day_add').val(day)

            $('#subject').empty()
            $('#user').empty()

            $.get('{{ route('admin.settings.schedules.subjects') }}', function(res) {
                var opt = '<option value="" selected Disable>Pilih Mata Pelajaran</option>'
                $.each(res, function(index, subject) {
                    opt += '<option value="' + subject.id + '">' + subject.name + '</option>'
                })
                $('#subject').append(opt)
            })

            $.get('{{ route('admin.settings.schedules.users') }}', function(res) {
                var opt = '<option value="" selected Disable>Pilih Guru</option>'
                $.each(res, function(index, user) {
                    opt += '<option value="' + user.id + '">' + user.name + '</option>'
                })
                $('#user').append(opt)
            })
        })

        $('#classroom_id').change(function() {
            var wrapper = $('#day')
            wrapper.empty()

            var days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']
            opt = '<option value="" selected Disable>Pilih Hari</option>'
            $.each(days, function(index, day) {
                opt += '<option value="' + day + '">' + day + '</option>'
            })
            wrapper.append(opt)
        });

        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id')

            url = "{{ route('admin.settings.schedules.destroy', ':id') }}"
            url = url.replace(':id', id)
            method = 'DELETE'

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Jadwal Pelajaran akan dihapus.',
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
                        url: getUrl(),
                        method: getMethod(),
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                customClass: {
                                    confirmButton: 'btn btn-success waves-effect waves-light'
                                }
                            }).then((result) => {
                                if (result.isConfirmed || result.isDismissed) {
                                    reload()
                                }
                            });
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
                        }
                    });
                }
            });
        })

        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id')

            let Editurl = "{{ route('admin.settings.schedules.edit', ':id') }}"
            Editurl = Editurl.replace(':id', id)

            url = "{{ route('admin.settings.schedules.update', ':id') }}"
            url = url.replace(':id', id)
            method = "PUT"

            $.ajax({
                url: getUrl(),
                method: "GET",
                success: function(res) {
                    console.log(res);
                    var schedule = res
                    $('#modalSchedule').modal('show')
                    $('#modalScheduleTitle').html('Ubah Jadwal Pelajaran')

                    var classroom = $('#classroom_id').find('option:selected').text()
                    var day = $('#day').val()
                    $('#classroom_add').val(classroom)
                    $('#day_add').val(day)

                    $('#subject').empty()
                    $('#user').empty()

                    $.get('{{ route('admin.settings.schedules.subjects') }}', function(res) {
                        let opt
                        $.each(res, function(index, subject) {
                            let selected = schedule.subject_id === subject.id ?
                                'selected' : ''
                            opt += '<option value="' + subject.id + '" ' + selected +
                                '>' + subject
                                .name + '</option>'
                        })
                        $('#subject').append(opt)
                    })

                    $.get('{{ route('admin.settings.schedules.users') }}', function(res) {
                        let opt
                        $.each(res, function(index, user) {
                            let selected = schedule.user_id === user.id ? 'selected' :
                                ''
                            opt += '<option value="' + user.id + '" ' + selected +
                                '>' + user.name + '</option>'
                        })
                        $('#user').append(opt)
                    })

                    $('#start_time').val(schedule.start_time)
                    $('#end_time').val(schedule.end_time)
                },
                error: function(err) {
                    console.log(err);
                }
            })
        })

        $('#day').on('change', function() {
            var classroom_id = $('#classroom_id').val()
            var day = $('#day').val()

            $.ajax({
                url: "{{ route('admin.settings.schedules.list') }}",
                method: "GET",
                data: {
                    classroom_id: classroom_id,
                    day: day
                },
                success: function(res) {
                    $('#table-el').show()

                    var html = ''
                    $.each(res, function(index, schedule) {
                        html += '<tr>'
                        html += '<td>' + schedule.subject.name + '</td>'
                        html += '<td>' + schedule.user.name + '</td>'
                        html += '<td>' + schedule.start_time + '</td>'
                        html += '<td>' + schedule.end_time + '</td>'
                        html += '<td>'
                        html +=
                            '<button class="btn btn-sm btn-primary btn-edit me-2" data-id="' +
                            schedule.id + '">Edit</button>'
                        html += '<button class="btn btn-sm btn-danger btn-delete" data-id="' +
                            schedule.id + '">Hapus</button>'
                        html += '</td>'
                        html += '</tr>'
                    })
                    $('#schedules').html(html)

                },
                error: function(err) {
                    console.log(err);
                }
            })
        })
    </script>
@endpush
