@extends('layouts.admin.template')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('title')
    Edit User
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <div class="card">
            <h5 class="card-header">Edit User</h5>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->nik) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Nama Lengkap" value="{{ $user->name }}" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nik">NIK</label>
                            <input type="text" name="nik" id="nik"
                                class="form-control @error('nik') is-invalid @enderror" placeholder="NIK"
                                value="{{ $user->nik }}" required />
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="phone">No. HP</label>
                            <input type="number" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" placeholder="No. HP"
                                value="{{ $user->phone }}" required />
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                value="{{ $user->email }}" required />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select id="role" name="role"
                                class="select2 form-select @error('role') is-invalid @enderror" data-allow-clear="true"
                                required>
                                <option value="">Pilih Role</option>
                                @foreach (getRoles() as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $user->roles()->pluck('id')->first() === $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Isi jika ingin di ubah" autocomplete="off" />
                                <span class="input-group-text cursor-pointer" id="basic-default-password4"><i
                                        class="ti ti-eye-off"></i></span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="">Pilih Status</option>
                                <option value="0" {{ $user->status === 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ $user->status === 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="2" {{ $user->status === 2 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-dark">Kembali</a>
                            <button type="submit" class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('assets/template/vendor/libs/select2/select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Pilih Role'
            })
        });
    </script>
@endpush
