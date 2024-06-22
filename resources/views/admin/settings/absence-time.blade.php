@extends('layouts.admin.template')

@section('title')
    Setting Jam Absen
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Setting Jam Absen</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <form action="" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="time_in">Jam Masuk</label>
                            <input type="time" class="form-control" id="time_in" name="time_in"
                                value="{{ $absence_time->time_in }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="time_out">Jam Pulang</label>
                            <input type="time" class="form-control" id="time_out" name="time_out"
                                value="{{ $absence_time->time_out }}" required>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('page-js')
    <script src="{{ asset('assets/template/vendor/libs/select2/select2.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
