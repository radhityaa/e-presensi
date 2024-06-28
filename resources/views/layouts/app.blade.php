<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Title -->
    <title>{{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/affan/img/icons/icon-96x96.png') }}">
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ asset('assets/affan/img/icons/icon-152x152.pngassets/affan/img/icons/icon-96x96.png') }}">
    <link rel="apple-touch-icon" sizes="167x167"
        href="{{ asset('assets/affan/img/icons/icon-167x167.pngassets/affan/img/icons/icon-96x96.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/affan/img/icons/icon-180x180.pngassets/affan/img/icons/icon-96x96.png') }}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/affan/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox/lightbox.css') }}">

    @stack('page-css')

    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('assets/affan/manifest.json') }}">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Internet Connection Status -->
    <div class="internet-connection-status" id="internetStatus"></div>

    <!-- Header Area -->
    @include('layouts.header')

    <!-- # Sidenav Left -->
    @include('layouts.sidenav')

    <div class="page-content-wrapper">
        @yield('content')
    </div>

    <!-- Footer Nav -->
    @include('layouts.footer')

    <!-- All JavaScript Files -->
    <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/affan/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/affan/js/slideToggle.min.js') }}"></script>
    <script src="{{ asset('assets/affan/js/internet-status.js') }}"></script>
    <script src="{{ asset('assets/affan/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/affan/js/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/affan/js/countdown.js') }}"></script>
    <script src="{{ asset('assets/affan/js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('assets/affan/js/vanilla-dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/affan/js/index.js') }}"></script>
    <script src="{{ asset('assets/affan/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/affan/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/affan/js/pswmeter.js') }}"></script>
    <script src="{{ asset('assets/affan/js/active.js') }}"></script>
    <script src="{{ asset('assets/affan/js/pwa.js') }}"></script>
    <script src="{{ asset('assets/js/lightbox/lightbox.js') }}"></script>

    @stack('page-js')

</body>

</html>
