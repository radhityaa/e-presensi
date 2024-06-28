@extends('layouts.app')

@push('page-css')
@endpush

@section('content')
    <div class="container py-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('submission.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" name="date" id="date" class="form-control" placeholder="Tanggal"
                            required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Tanggal</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="">Izin / Sakit</option>
                            <option value="i">Ijin</option>
                            <option value="s">Sakit</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Alasan</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Alasan" required>{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <button class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="row" style="margin-top: 70px">
        <div class="col">
            <form action="{{ route('submission.store') }}" method="post" id="form-create">
                @csrf

                <div class="form-group">
                    <label for="date">Tanggal*</label>
                    <input type="date" name="date" id="date" class="form-control datepicker"
                        placeholder="Tanggal" required>
                </div>

                <div class="form-group">
                    <label for="status">Jenis*</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Izin / Sakit</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Keterangan*</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                        placeholder="Keterangan" required></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success w-100">Ajukan</button>
                </div>
            </form>
        </div>
    </div> --}}
@endsection


@push('page-js')
    {{-- <script src="{{ asset('assets/template/js/materialize.min.js') }}"></script> --}}

    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function() {
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd"
            });
        });
    </script>
@endpush
