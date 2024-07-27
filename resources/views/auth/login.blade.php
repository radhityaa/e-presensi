@extends('layouts.auth.app')

@section('content')
    <div class="login-wrapper d-flex align-items-center justify-content-center">
        <div class="custom-container">
            <div class="text-center px-4">
                <img class="login-intro-img" src="{{ asset('assets/img/logo.png') }}" alt="">
            </div>

            <!-- Register Form -->
            <div class="register-form mt-4">
                <h6 class="mb-3 text-center">Silahkan Login Terlebih Dahulu</h6>

                <form action="{{ route('auth.login.index') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <input class="form-control @error('nik') is-invalid @enderror" type="text" id="nik"
                            name="nik" placeholder="NIK/NIP" value="{{ old('nik') }}" required>
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group position-relative">
                        <input class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                            type="password" placeholder="Password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="position-absolute" id="password-visibility">
                            <i class="bi bi-eye"></i>
                            <i class="bi bi-eye-slash"></i>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Masuk</button>
                </form>
            </div>

            <!-- Login Meta -->
            <div class="login-meta-data text-center mt-2">
                <p class="mb-0">Belum Punya Akun? <a class="stretched-link"
                        href="{{ route('auth.register.index') }}">Daftar Baru</a></p>
            </div>
        </div>
    </div>
@endsection
