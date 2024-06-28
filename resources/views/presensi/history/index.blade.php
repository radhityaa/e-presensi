@extends('layouts.app')

@section('content')
    <div class="container direction-rtl pt-3">
        <div class="card">
            <div class="card-body">
                <div class="col">
                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="month" class="form-label">Bulan</label>
                                <select name="month" id="month" class="form-control">
                                    <option value="">Bulan</option>
                                    @foreach ($month as $key => $value)
                                        <option value={{ $key + 1 }} {{ date('m') == $key + 1 ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="year" class="form-label">Tahun</label>
                                <select name="year" id="year" class="form-control">
                                    <option value="">Tahun</option>
                                    @php
                                        $yearStart = 2022;
                                        $yearNow = date('Y');
                                    @endphp
                                    @for ($year = $yearStart; $year <= $yearNow; $year++)
                                        <option value={{ $year }} {{ date('Y') == $year ? 'selected' : '' }}>
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-block w-100" id="search-data">
                                    <ion-icon name="search-outline"></ion-icon>
                                    Cari
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3" id="show-history"></div>
@endsection

@push('page-js')
    <script>
        $(function() {
            $('#search-data').on('click', function() {
                var month = $('#month').val()
                var year = $('#year').val()
                $.ajax({
                    type: 'POST',
                    url: '/presensi/history',
                    data: {
                        _token: "{{ csrf_token() }}",
                        month: month,
                        year: year
                    },
                    cache: false,
                    success: function(res) {
                        $('#show-history').html(res)
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            })
        })
    </script>
@endpush
