@extends('layouts.auth.app')

<div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">
        <div class="text-center px-4">
            <img class="login-intro-img" src="{{ asset('assets/img/logo.png') }}" alt="">
        </div>

        <!-- Register Form -->
        <div class="register-form mt-4">
            <h6 class="mb-3 text-center">Daftar Akun Baru</h6>

            <form action="{{ route('auth.register.store') }}" method="POST">
                @csrf

                <div class="form-group text-start mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input class="form-control @error('nik') is-invalid @enderror" type="text" id="nik"
                        name="nik" value="{{ old('nik') }}" placeholder="Nik" required>
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group text-start mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        id="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group
                        text-start mb-3">
                    <label for="classroom_id" class="form-label">Kelas</label>
                    <select name="classroom_id" id="classroom_id"
                        class="form-control select2 @error('classroom_id') is-invalid @enderror">
                        <option value="">Pilih Kelas</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group
                        text-start mb-3">
                    <label for="phone" class="form-label">Nomor HP</label>
                    <input class="form-control @error('phone') is-invalid @enderror" type="number" name="phone"
                        id="phone" value="{{ old('phone') }}" placeholder="Nomor HP" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group
                        text-start mb-3">
                    <label for="address" class="form-label">Alamat Lengkap</label>
                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                        placeholder="Alamat Lengkap" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group
                        text-start mb-3 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                        type="password" placeholder="Password Baru" required>
                    <div class="position-absolute" style="margin-top: 10px;" id="password-visibility">
                        <i class="bi bi-eye"></i>
                        <i class="bi bi-eye-slash"></i>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" id="pswmeter"></div>

                <div class="form-group
                        text-start mb-3 position-relative">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password"
                        placeholder="Konfirmasi Password Baru" required>
                </div>

                <button class="btn btn-primary w-100" type="submit">Daftar</button>
            </form>
        </div>

        <!-- Login Meta -->
        <div class="login-meta-data text-center">
            <p class="mt-3 mb-0">Sudah Punya Akun? <a class="stretched-link"
                    href="{{ route('auth.login.index') }}">Login</a></p>
        </div>
    </div>
</div>
