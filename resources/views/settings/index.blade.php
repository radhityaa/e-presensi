@extends('layouts.app')

@section('content')
    <!-- Dark mode switching -->
    <div class="dark-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="dark-mode-text text-center">
                <i class="bi bi-moon"></i>
                <p class="mb-0">Switching to dark mode</p>
            </div>
            <div class="light-mode-text text-center">
                <i class="bi bi-brightness-high"></i>
                <p class="mb-0">Switching to light mode</p>
            </div>
        </div>
    </div>

    <!-- RTL mode switching -->
    <div class="rtl-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="rtl-mode-text text-center">
                <i class="bi bi-text-right"></i>
                <p class="mb-0">Switching to RTL mode</p>
            </div>
            <div class="ltr-mode-text text-center">
                <i class="bi bi-text-left"></i>
                <p class="mb-0">Switching to default mode</p>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper py-3">
        <div class="container">

            <!-- Setting Card-->
            <div class="card mb-3 shadow-sm">
                <div class="card-body direction-rtl">
                    <p class="mb-2">Pengaturan Akun</p>

                    <div class="single-setting-panel">
                        <a href="{{ route('settings.profile.information') }}">
                            <div class="icon-wrapper">
                                <i class="bi bi-person"></i>
                            </div>
                            Update Profile
                        </a>
                    </div>

                    <div class="single-setting-panel">
                        <a href="{{ route('settings.profile.change-picture') }}">
                            <div class="icon-wrapper bg-success">
                                <i class="bi bi-person-bounding-box"></i>
                            </div>
                            Ganti Foto Profil
                        </a>
                    </div>

                    <div class="single-setting-panel">
                        <a href="{{ route('settings.profile.change-password') }}">
                            <div class="icon-wrapper bg-info">
                                <i class="bi bi-lock"></i>
                            </div>
                            Ubah Password
                        </a>
                    </div>

                </div>
            </div>

            <!-- Setting Card-->
            <div class="card shadow-sm">
                <div class="card-body direction-rtl">
                    <p class="mb-2">Lainnya</p>

                    <div class="single-setting-panel">
                        <a href="{{ route('logout') }}">
                            <div class="icon-wrapper bg-danger">
                                <i class="bi bi-box-arrow-right"></i>
                            </div>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('assets/affan/js/dark-rtl.js') }}"></script>
@endpush
