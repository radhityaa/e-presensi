@extends('layouts.app')

@section('content')
    <div class="page-content-wrapper py-3">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="custom-container">
                        <div class="register-form">
                            <form action="{{ route('settings.profile.update-password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <h6 class="mb-3 text-center">Ubah Password</h6>

                                <div class="form-group text-start mb-3">
                                    <input class="form-control @error('current_password') is-invalid @enderror"
                                        type="password" name="current_password" id="current_password"
                                        placeholder="Password Lama" autocomplete="off" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group text-start mb-3 position-relative">
                                    <input class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" type="password" placeholder="Password Baru" autocomplete="off"
                                        required>
                                    <div class="position-absolute" id="password-visibility">
                                        <i class="bi bi-eye"></i>
                                        <i class="bi bi-eye-slash"></i>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group text-start mb-3">
                                    <input class="form-control" type="password" name="password_confirmation"
                                        id="password_confirmation" placeholder="Konfirmasi Password Baru" required
                                        autocomplete="off">
                                </div>

                                <button class="btn btn-primary w-100" type="submit">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
