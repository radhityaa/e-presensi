@extends('layouts.dashboard.app')

@section('content')
    <!-- Sections:Start -->
    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="hero-animation">
            <div id="landingHero" class="section-py landing-hero position-relative">
                <img src="{{ asset('assets/template/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background"
                    class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100"
                    data-speed="1" />
                <div class="container">
                    <div class="hero-text-box text-center">
                        <h1 class="text-primary hero-title display-6 fw-bold">Selamat Datang Di Website SMAN 3
                            Purwakarta</h1>
                        <h2 class="hero-sub-title h6 mb-4 pb-1">
                            Melihat Absensi Siswa dan Melihat Daftar Jadwal Pelajaran<br class="d-none d-lg-block" />
                            Dengan Klik Tombol Dibawah ini.
                        </h2>
                        <div class="landing-hero-btn d-inline-block position-relative">
                            <a href="#cekAbsensi" class="mb-3 me-2 btn btn-primary btn-lg">Cek Absensi</a>
                            <a href="#jadwalPelajaran" class="mb-3 me-2 btn btn-info btn-lg">Jadwal Pelajaran</a>
                            <a href="{{ route('auth.login.index') }}" class="mb-3 me-2 btn btn-success btn-lg">Absen</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero: End -->

        <!-- Jadwal Pelajaran -->
        <section id="jadwalPelajaran" class="section-py bg-body landing-faq">
            <div class="container">
                <div class="text-center mb-3 pb-1">
                    <span class="badge bg-label-primary">Jadwal Pelajaran</span>
                </div>
                <h3 class="text-center mb-1">
                    Daftar Jadwal Pelajaran
                    <span class="position-relative fw-bold z-1">SMAN 2 Purwakarta
                        <img src="{{ asset('assets/template/img/front-pages/icons/section-title-icon.png') }}"
                            alt="laptop charging"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
                    </span>
                </h3>

                <div class="card mt-4 col-md-4 d-flex mx-auto">
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

                <div class="row gy-5" id="schedule-container" style="display: none;">
                    <div class="col-12">
                        <div class="accordion mt-4" id="accordionExample">
                            <div class="row">
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <div class="col-md-6 mb-3">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="{{ $day }}">
                                                <button type="button" class="accordion-button collapsed"
                                                    data-bs-toggle="collapse" data-bs-target="#accordion{{ $day }}"
                                                    aria-expanded="false" aria-controls="accordion{{ $day }}">
                                                    {{ $day }}
                                                </button>
                                            </h2>
                                            <div id="accordion{{ $day }}" class="accordion-collapse collapse"
                                                aria-labelledby="{{ $day }}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row g-3" id="schedule-{{ $day }}">
                                                        <p class="text-center m-3">Silakan pilih kelas terlebih dahulu.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Jadwal Pelajaran -->

        <!-- Cek Absensi -->
        <section id="cekAbsensi" class="section-py bg-body landing-faq">
            <div class="container">
                <div class="text-center mb-3 pb-1">
                    <span class="badge bg-label-primary">Absensi</span>
                </div>
                <h3 class="text-center mb-1">
                    Daftar Siswa Yang Telah Melakukan
                    <span class="position-relative fw-bold z-1">Absen
                        <img src="{{ asset('assets/template/img/front-pages/icons/section-title-icon.png') }}"
                            alt="laptop charging"
                            class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
                    </span>
                </h3>

                <div class="card mt-4 col-md-6 d-flex mx-auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="student" class="form-label">Siswa</label>
                                <select name="student" id="student" class="form-control" required>
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($students as $students)
                                        <option value="{{ $students->nik }}">{{ $students->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="text" class="form-control" placeholder="Tanggal Presensi" id="date-presensi"
                                    name="date-presensi" autocomplete="off" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gy-5" id="student-container" style="display: none;">
                    <div class="col-12">
                        <div class="card mt-4">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Nik</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Pulang</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="name"></td>
                                            <td id="classroom_"></td>
                                            <td id="nik"></td>
                                            <td id="jam_in"></td>
                                            <td id="jam_out"></td>
                                            <td id="desc"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Cek Absensi -->
    </div>
    <!-- / Sections:End -->
@endsection
