@extends('layouts.app')

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Scan QR Code</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-center mx-auto align-items-center">
        <div class="row" style="margin-top: 70px;">
            <div style="height: 100% !important; width: 100%; margin: auto; border-radius: 15px;" class="overflow-hidden">
                <div id="reader"></div>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
    <script src="{{ asset('assets/js/html5-qrcode.min.js') }}" type="text/javascript"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            $.ajax({
                url: "{{ route('qrcode.validation') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    qrcode: decodedText
                },
                cache: false,
                success: function(res) {
                    if (res.success) {
                        window.location.href = res.redirect
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: res.message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    }
                }
            })
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 300,
                    height: 300
                },
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endpush
