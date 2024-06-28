@extends('layouts.admin.template')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('title')
    Edit Siswa
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <div class="card">
            <h5 class="card-header">Edit Siswa</h5>
            <div class="card-body">
                <form action="{{ route('admin.student.update', $student->nik) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Nama Lengkap" value="{{ $student->name }}" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nik">NIK</label>
                            <input type="text" name="nik" id="nik"
                                class="form-control @error('nik') is-invalid @enderror" placeholder="NIK"
                                value="{{ $student->nik }}" required />
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="classroom_id" class="form-label">Kelas</label>
                            <select id="classroom_id" name="classroom_id"
                                class="select2 form-select @error('classroom_id') is-invalid @enderror"
                                data-allow-clear="true" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($classrooms as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $student->classroom_id) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('classroom_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="phone">Nomor HP</label>
                            <input type="number" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" placeholder="0895xxxxxx"
                                value="{{ $student->phone }}" required />
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="address">Alamat Lengkap</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                                placeholder="Alamat Lengkap" required>{{ $student->address }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="photo">Gambar</label>
                            <input type="file" name="photo" id="photo"
                                class="form-control @error('photo') is-invalid @enderror"></input>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Isi jika ingin di ubah" />
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
                                <option value="0" {{ $student->status === 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ $student->status === 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="2" {{ $student->status === 2 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('admin.student.index') }}" class="btn btn-dark">Kembali</a>
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
    <script src="{{ asset('assets/js/core/student.js') }}"></script>
@endpush
