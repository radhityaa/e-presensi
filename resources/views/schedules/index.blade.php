@extends('layouts.admin.template')

@section('title')
    Daftar Jadwal Pelajaran
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('content')
    <div class="col-12">
        <h4 class="card-title mb-3">Jadwal Pelajaran</h4>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="classroom" class="form-label">Kelas</label>
                        <select name="classroom" id="classroom" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row mt-3" id="schedule-container" style="display: none;">
            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                <div class="col-md-6 mb-3">
                    <div class="accordion" id="collapsibleSection">
                        <div class="card accordion-item overflow-hidden">
                            <h2 class="accordion-header" id="headingCollaps">
                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                    data-bs-target="#{{ $day }}" aria-expanded="true"
                                    aria-controls="{{ $day }}">
                                    {{ $day }}
                                </button>
                            </h2>
                            <div id="{{ $day }}" class="accordion-collapse collapse"
                                data-bs-parent="#collapsibleSection">
                                <div class="accordion-body" style="padding: 0px;">
                                    <div class="row g-3" id="schedule-{{ $day }}">
                                        <p class="text-center m-3">Silakan pilih kelas terlebih dahulu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('assets/template/vendor/libs/select2/select2.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#classroom').select2({
                placeholder: 'Pilih Kelas'
            })

            $('#classroom').change(function() {
                var classroomId = $(this).val();
                if (classroomId) {
                    $.ajax({
                        url: "{{ route('admin.schedules.getSchedules') }}",
                        type: 'GET',
                        data: {
                            classroom_id: classroomId
                        },
                        success: function(response) {
                            $('#schedule-container').show();
                            var days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu',
                                'Minggu'
                            ];
                            days.forEach(function(day) {
                                var scheduleHtml = '';
                                if (response[day] && response[day].length > 0) {
                                    scheduleHtml +=
                                        '<div class="table-responsive text-nowrap">';
                                    scheduleHtml +=
                                        '<table class="table table-borderless">';
                                    scheduleHtml +=
                                        '<thead><tr><th>Mapel</th><th>Guru</th><th>Jam Mulai</th><th>Jam Selesai</th></tr></thead><tbody>';
                                    response[day].forEach(function(item) {
                                        scheduleHtml += '<tr>';
                                        scheduleHtml += '<td>' + item.subject
                                            .name + '</td>';
                                        scheduleHtml += '<td>' + item.user
                                            .name + '</td>';
                                        scheduleHtml += '<td>' + item
                                            .start_time + '</td>';
                                        scheduleHtml += '<td>' + item.end_time +
                                            '</td>';
                                        scheduleHtml += '</tr>';
                                    });
                                    scheduleHtml += '</tbody></table></div>';
                                } else {
                                    scheduleHtml +=
                                        '<p class="text-center m-3">Tidak Ada Jadwal Untuk Hari ' +
                                        day + '</p>';
                                }
                                $('#schedule-' + day).html(scheduleHtml);
                            });
                        },
                        error: function() {
                            alert('Gagal mengambil data jadwal. Silakan coba lagi.');
                        }
                    });
                } else {
                    $('#schedule-container').hide();
                }
            });
        })
    </script>
@endpush
