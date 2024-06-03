@extends('layouts.admin.template')

@section('title')
    Rekap Absensi
@endsection

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/template/vendor/libs/select2/select2.css') }}" />
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Rekap Absensi</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <form action="{{ route('admin.report.rekapPrint') }}" target="_blank" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="month">Bulan</label>
                            <select class="form-select" name="month" id="month">
                                <option value="">Pilih Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>
                                        {{ $month[$i] }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="year">Tahun</label>
                            @php
                                use App\Helpers\DateHelper;
                                $yearOptions = DateHelper::yearOptions(2023);
                            @endphp
                            <select class="form-select" name="year" id="year">
                                <option value="">Pilih Tahun</option>
                                {!! $yearOptions !!}
                            </select>
                        </div>
                        <div class="d-flex gap-4">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" id="print"><i
                                        class="tf-icons ti ti-printer me-2"></i>Cetak</button>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-success" id="export"><i
                                        class="tf-icons ti ti-file-spreadsheet me-2"></i> Export Excel</button>
                            </div>
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
