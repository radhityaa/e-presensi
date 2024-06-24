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
                <div>
                    <label for="classroom" class="form-label">Kelas</label>
                    <select name="classroom" id="classroom" class="form-control select2" required>
                        <option value="">Pilih Kelas</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="nav-align-top nav-tabs-shadow mt-4">
            <ul class="nav nav-tabs" role="tablist">
                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                    <li class="nav-item">
                        <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}" role="tab"
                            data-bs-toggle="tab" data-bs-target="#{{ $day }}" aria-controls="{{ $day }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $day }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $day }}"
                        role="tabpanel">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($classroom->schedules->where('day', $day) as $schedule)
                                    <tr>
                                        <td>{{ $schedule->subject->name }}</td>
                                        <td>{{ $schedule->user->name }}</td>
                                        <td>{{ $schedule->start_time }}</td>
                                        <td>{{ $schedule->end_time }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Tidak ada jadwal</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- @foreach ($classrooms as $classroom)
            <h4 class="card-title mb-3">{{ $classroom->name }}</h4>
            <div class="nav-align-top nav-tabs-shadow mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}" role="tab"
                                data-bs-toggle="tab" data-bs-target="#{{ $day }}"
                                aria-controls="{{ $day }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                {{ $day }}
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $day }}"
                            role="tabpanel">
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($classroom->schedules->where('day', $day) as $schedule)
                                        <tr>
                                            <td>{{ $schedule->subject->name }}</td>
                                            <td>{{ $schedule->user->name }}</td>
                                            <td>{{ $schedule->start_time }}</td>
                                            <td>{{ $schedule->end_time }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Tidak ada jadwal</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach --}}
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('assets/template/vendor/libs/select2/select2.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Pilih Kelas'
            })
        })
    </script>
@endpush
