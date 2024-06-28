@extends('layouts.admin.template')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('title')
    Detail Siswa
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <div class="card">
            <h5 class="card-header">Detail Siswa</h5>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Nama Lengkap" value="{{ $student->name }}" disabled />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK"
                                value="{{ $student->nik }}" disabled />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="classroom_id" class="form-label">Kelas</label>
                            <select id="classroom_id" name="classroom_id" class="select2 form-select"
                                data-allow-clear="true" disabled>
                                <option value="">Pilih Kelas</option>
                                @foreach ($classrooms as $item)
                                    <option value="{{ $item->id }}" @if ($item->id == $student->classroom_id) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="phone">Nomor HP</label>
                            <input type="number" name="phone" id="phone" class="form-control"
                                placeholder="0895xxxxxx" value="{{ $student->phone }}" disabled />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="address">Alamat Lengkap</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Alamat Lengkap" disabled>{{ $student->address }}</textarea>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="status">Status</label>
                            <select name="status" id="status" class="form-select" disabled>
                                <option value="0" {{ $student->status === 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ $student->status === 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="2" {{ $student->status === 2 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('admin.student.index') }}" class="btn btn-dark">Kembali</a>
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
