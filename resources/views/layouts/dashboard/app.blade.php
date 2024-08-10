<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/template/') }}" data-template="front-pages-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ env('APP_NAME') }}</title>

    <meta name="description" content="Presensi" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/template/vendor/fonts/tabler-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/css/pages/front-page.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/swiper/swiper.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/css/pages/front-page-landing.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/template/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/leaflet/leaflet.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/template/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/template/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/template/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox/lightbox.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/template/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/template/js/front-config.js') }}"></script>
</head>

<body>
    <script src="{{ asset('assets/template/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/js/mega-dropdown.js') }}"></script>

    <!-- Navbar: Start -->
    <nav class="layout-navbar shadow-none py-0">
        <div class="container">
            <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4">
                <!-- Menu logo wrapper: Start -->
                <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                    <!-- Mobile menu toggle: Start-->
                    <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-menu-2 ti-sm align-middle"></i>
                    </button>
                    <!-- Mobile menu toggle: End-->
                    <a href="/" class="app-brand-link">
                        <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" width="30" height="30">
                        <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{ env('APP_NAME') }}</span>
                    </a>
                </div>
                <!-- Menu logo wrapper: End -->
                <!-- Menu wrapper: Start -->
                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                    <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-x ti-sm"></i>
                    </button>
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-medium" aria-current="page" href="#landingHero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#jadwalPelajaran">Jadwal Pelajaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#cekAbsensi">Cek Absen</a>
                        </li>
                    </ul>
                </div>
                <div class="landing-menu-overlay d-lg-none"></div>
                <!-- Menu wrapper: End -->
                <!-- Toolbar: Start -->
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- navbar button: Start -->
                    <li>
                        <a href="{{ route('auth.login.index') }}" class="btn btn-primary"><span
                                class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span
                                class="d-none d-md-block">Login</span></a>
                    </li>
                    <!-- navbar button: End -->
                </ul>
                <!-- Toolbar: End -->
            </div>
        </div>
    </nav>
    <!-- Navbar: End -->

    @yield('content')

    <!-- Footer: Start -->
    <footer class="landing-footer bg-body footer-text">
        <div class="footer-top position-relative overflow-hidden z-1">
            <img src="{{ asset('assets/template/img/front-pages/backgrounds/footer-bg-light.png') }}" alt="footer bg"
                class="footer-bg banner-bg-img z-n1" />
            <div class="container">
                <div class="row gx-0 gy-4 g-md-5">
                    <div class="col-lg-5">
                        <a href="/" class="app-brand-link mb-4">
                            <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" width="100"
                                height="100">
                        </a>
                        <span class="app-brand-text demo footer-link fw-bold">SMAN 3 Purwakarta</span>
                        <p class="footer-text footer-logo-description mb-4">
                        SMA negeri ini pertama kali berdiri pada tahun 1992. Saat ini SMA Negeri 3 Purwakarta menggunakan kurikulum belajar SMA 2013 IPS. SMAN 3 Purwakarta berada di bawah naungan kepala sekolah dengan nama Asep Mulyana ditangani oleh seorang operator yang bernama Cecep Sopian Akbar.
                        </p>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-4">Pages</h6>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="pricing-page.html" class="footer-link">Cek Absensi</a>
                            </li>
                            <li class="mb-3">
                                <a href="checkout-page.html" class="footer-link">Jadwal Pelajaran</a>
                            </li>
                            <li class="mb-3">
                                <a href="{{ route('auth.login.index') }}" class="footer-link">Absen</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom py-3">
            <div
                class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
                <div class="mb-2 mb-md-0">
                    <span class="footer-text">©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </span>
                    <a href="/" target="_blank" class="fw-medium text-white footer-link">SMAN 2 Purwakarta,</a>
                    <span class="footer-text"> Made with ❤️ for a better web.</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer: End -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/template/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/node-waves/node-waves.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/template/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/swiper/swiper.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/template/js/front-main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/template/js/front-page-landing.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#classroom').select2({
                placeholder: 'Pilih Kelas'
            })

            $('#student').select2({
                placeholder: 'Pilih Siswa'
            })

            var datePicker = $("#date-presensi").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            });

            datePicker.on('change', function() {
                var date = $(this).val()
                var nik = $('#student').val();
                getAbsensi(date, nik)
            })

            function getAbsensi(date, nik) {
                $.ajax({
                    url: "{{ route('getAbsensi') }}",
                    type: 'GET',
                    data: {
                        date: date,
                        nik: nik
                    },
                    success: function(res) {
                        if (res.absence == null) {
                            $('#student-container').hide()
                            $('#name').html('')
                            $('#classroom_').html('')
                            $('#nik').html('')
                            $('#jam_in').html('')
                            $('#jam_out').html('')
                            $('#desc').html('')

                            if (res.cekSubmission) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Tidak Hadir!',
                                    text: 'Siswa pada tanggal ' + date + ' tidak hadir karna ' +
                                        (res.cekSubmission.status == 'i' ? 'Ijin' : 'Sakit') +
                                        ', alasan: ' + res.cekSubmission.description + ', ' + (
                                            res.cekSubmission.approve == 0 ?
                                            'Belum dikonfirmasi' : res.cekSubmission.approve ==
                                            1 ? 'Disetujui' : 'Ditolak'),
                                    customClass: {
                                        confirmButton: 'btn btn-success waves-effect waves-light'
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Tidak Ditemukan!',
                                    text: 'Siswa pada tanggal ' + date + ' tidak hadir',
                                    customClass: {
                                        confirmButton: 'btn btn-success waves-effect waves-light'
                                    }
                                });
                            }
                        } else {
                            $('#student-container').show()
                            $('#name').html(res.absence.student.name)
                            $('#classroom_').html(res.absence.student.classroom.name)
                            $('#nik').html(res.absence.student.nik)
                            $('#jam_in').html(res.absence.jam_in)
                            $('#jam_out').html(res.absence.jam_out)
                            $('#desc').html(res.difference)
                        }
                    },
                    error: function(err) {
                        $('#student-container').hide()
                        console.log(err)
                    }
                })
            }

            $('#classroom').change(function() {
                var classroomId = $(this).val();
                if (classroomId) {
                    $.ajax({
                        url: "{{ route('getSchedules') }}",
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
</body>

</html>
