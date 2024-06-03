<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Scan QR Code</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/css/demo.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/css/pages/page-misc.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/template/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/template/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <!-- Error -->
    <div class="container-xxl container-p-y">
        <div class="d-flex justify-content-center align-items-center text-center mx-auto">
            <div class="mt-3">
                <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid mb-4" width="200" height="200">
                <h2 class="mb-1 ">Scan QR Code</h2>
                <p class="mb-4">Scan QR Code Untuk Melakukan Absensi</p>
                <div class="card">
                    <div class="card-header">
                        <div>Waktu hingga pembaruan berikutnya: <span id="countdown">3</span> detik</div>
                    </div>
                    <div class="card-body p-1">
                        <div class="mb-4" id="qrcode"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Error -->

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets/template/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/template/vendor/js/bootstrap.js') }}"></script>
    <script>
        let countdown = 3;
        const countdownElement = document.getElementById('countdown');

        function reloadQrCode() {
            $.ajax({
                url: "{{ route('admin.qr.generate') }}",
                method: "GET",
                success: function(res) {
                    $('#qrcode').html(res)
                    countdown = 3
                    countdownElement.textContent = countdown
                }
            })
        }

        function updateCountdown() {
            if (countdown > 0) {
                countdown--;
            } else {
                reloadQrCode();
                countdown = 3;
            }
            countdownElement.textContent = countdown;
        }

        $(document).ready(function() {
            reloadQrCode()
            setInterval(updateCountdown, 1000)

            $.ajax({
                url: "{{ route('admin.qr.generate') }}",
                method: "GET",
                success: function(res) {
                    $('#qrcode').html(res)
                }
            })
        })
    </script>

    <!-- endbuild -->
</body>

</html>
