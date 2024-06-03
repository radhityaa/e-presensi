@extends('layouts.admin.template')

@section('title')
    Setting Lokasi Absen
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Setting Lokasi Absen</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <form action="" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="location">Lokasi</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ $location->location }}" placeholder="Ex: -6.369040940520025, 107.39932559111271"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="radius">Radius</label>
                            <input type="number" class="form-control" id="radius" name="radius"
                                value="{{ $location->radius }}" placeholder="30" required>
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
