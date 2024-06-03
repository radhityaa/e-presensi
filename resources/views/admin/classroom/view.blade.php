@extends('layouts.admin.template')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('title')
    Detail Kelas
@endsection

@section('content')
    <div class="col-lg-12 mb-4 col-md-12">
        <div class="card">
            <h5 class="card-header">Detail Kelas</h5>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label" for="name">Nama Kelas</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap"
                            value="{{ $classroom->name }}" disabled />
                    </div>
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Wali Kelas</label>
                        <select id="user_id" name="user_id" class="select2 form-select" data-allow-clear="true" disabled>
                            <option value="">Pilih Wali Kelas</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $classroom->user_id) selected @endif>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('admin.classroom.index') }}" class="btn btn-dark">Kembali</a>
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
