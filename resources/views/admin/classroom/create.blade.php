@extends('layouts.admin.template')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('title')
    Tambah Kelas Baru
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <div class="card">
            <h5 class="card-header">Tambah Kelas Baru</h5>
            <div class="card-body">
                <form action="{{ route('admin.classroom.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="name">Nama Kelas</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="Nama Kelas" value="{{ old('name') }}" required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Wali Kelas</label>
                        <select id="user_id" name="user_id"
                            class="select2 form-select @error('user_id') is-invalid @enderror" data-allow-clear="true"
                            required>
                            <option value="">Pilih Wali Kelas</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('admin.classroom.index') }}" class="btn btn-dark">Kembali</a>
                            <button type="submit" class="btn btn-success">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('assets/template/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/core/classroom.js') }}"></script>
@endpush
