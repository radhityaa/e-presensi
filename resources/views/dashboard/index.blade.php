@extends('layouts.app')

@push('page-css')
@endpush

@section('content')
    @if ($message = Session::get('error'))
        <div class="alert alert-error">
            {{ $message }}
        </div>
    @endif

    <div class="pt-3"></div>

    <div class="container direction-rtl">
        <!-- User Information-->
        <div class="card user-info-card mb-3">
            <div class="card-body d-flex align-items-center">
                <div class="user-profile me-3">
                    @if (!empty(Auth::guard('student')->user()->photo))
                        <a href="{{ url(Storage::url('uploads/students/' . Auth::guard('student')->user()->photo)) }}"
                            data-lightbox="{{ url(Storage::url('uploads/students/' . Auth::guard('student')->user()->photo)) }}">
                            <img src="{{ url(Storage::url('uploads/students/' . Auth::guard('student')->user()->photo)) }}"
                                alt="avatar" class="imaged w64 rounded">
                        </a>
                    @else
                        <a href="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}"
                            data-lightbox="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}">
                            <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar"
                                class="imaged w64 rounded img-fluid">
                        </a>
                    @endif
                </div>
                <div class="user-info">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-1">{{ Auth::guard('student')->user()->name }}</h5>
                    </div>
                    <p class="mb-0">{{ Auth::guard('student')->user()->classroom->name }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Absensi day --}}
    <div class="container">
        <div class="row justify-content-center mb-3">

            <div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body"
                                style="padding-right: 0px; padding-left: 0px; padding-bottom: 20px; padding-top: 20px;">
                                <div class="mb-2 container">
                                    @if ($presensiToday)
                                        <a href="{{ url(Storage::url('uploads/absensi/' . $presensiToday->picture_in)) }}"
                                            data-lightbox="{{ url(Storage::url('uploads/absensi/' . $presensiToday->picture_in)) }}">
                                            <img class="rounded mx-auto d-block"
                                                src="{{ url(Storage::url('uploads/absensi/' . $presensiToday->picture_in)) }}"
                                                width="120" height="120">
                                        </a>
                                    @else
                                        <img class="rounded mx-auto d-block"
                                            src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" width="120"
                                            height="120">
                                    @endif
                                </div>
                                <div class="text-center">
                                    <h5 class="mb-0 mt-0">Masuk</h5>
                                    <span
                                        class="mb-0 mt-0">{{ $presensiToday ? $presensiToday->jam_in : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body"
                                style="padding-right: 0px; padding-left: 0px; padding-bottom: 20px; padding-top: 20px;">
                                <div class="mb-2 container">
                                    @if ($presensiToday && $presensiToday->picture_out)
                                        <a href="{{ url(Storage::url('uploads/absensi/' . $presensiToday->picture_out)) }}"
                                            data-lightbox="{{ url(Storage::url('uploads/absensi/' . $presensiToday->picture_out)) }}">
                                            <img class="rounded mx-auto d-block"
                                                src="{{ url(Storage::url('uploads/absensi/' . $presensiToday->picture_out)) }}"
                                                width="120" height="120">
                                        </a>
                                    @else
                                        <img class="rounded mx-auto d-block"
                                            src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" width="120"
                                            height="120">
                                    @endif
                                </div>
                                <div class="text-center">
                                    <h5 class="mb-0 mt-0">Pulang</h5>
                                    <span
                                        class="mb-0 mt-0">{{ $presensiToday && $presensiToday->jam_out ? $presensiToday->jam_out : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Menu --}}
    <div class="container direction-rtl">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-4">
                        <a href="{{ route('settings.profile.information') }}" style="color: gray;">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <i class="bi bi-person" style="font-size: 40px;"></i>
                                </div>
                                <p class="mb-0">Profile</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{ route('submission.index') }}" style="color: gray;">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <i class="bi bi-calendar-check" style="font-size: 30px;"></i>
                                </div>
                                <p class="mb-0">Pengajuan</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{ route('presensi.history') }}" style="color: gray;">
                            <div class="feature-card mx-auto text-center">
                                <div class="card mx-auto bg-gray">
                                    <i class="bi bi-clock-history" style="font-size: 30px;"></i>
                                </div>
                                <p class="mb-0">Riwayat</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistic --}}
    <div class="container">
        <div class="card">
            <div class="card-body direction-rtl">
                <div class="row">
                    <div class="col-3">
                        <!-- Single Counter -->
                        <div class="single-counter-wrap text-center">
                            <h4 class="mb-0">
                                <span
                                    class="counter">{{ empty($rekapAbsen->total_absen) ? 0 : $rekapAbsen->total_absen }}</span>
                            </h4>
                            <span class="solid-line"></span>
                            <p class="mb-0 fz-12">Hadir</p>
                        </div>
                    </div>

                    <div class="col-3">
                        <!-- Single Counter -->
                        <div class="single-counter-wrap text-center">
                            <h4 class="mb-0">
                                <span
                                    class="counter">{{ empty($rekapAbsen->total_absen_terlambat) ? 0 : $rekapAbsen->total_absen_terlambat }}</span>
                            </h4>
                            <span class="solid-line"></span>
                            <p class="mb-0 fz-12">Telat</p>
                        </div>
                    </div>

                    <div class="col-3">
                        <!-- Single Counter -->
                        <div class="single-counter-wrap text-center">
                            <h4 class="mb-0">
                                <span
                                    class="counter">{{ empty($recapSubmmission->total_sakit) ? 0 : $recapSubmmission->total_sakit }}</span>
                            </h4>
                            <span class="solid-line"></span>
                            <p class="mb-0 fz-12">Sakit</p>
                        </div>
                    </div>

                    <div class="col-3">
                        <!-- Single Counter -->
                        <div class="single-counter-wrap text-center">
                            <h4 class="mb-0">
                                <span
                                    class="counter">{{ empty($recapSubmmission->total_izin) ? 0 : $recapSubmmission->total_izin }}</span>
                            </h4>
                            <span class="solid-line"></span>
                            <p class="mb-0 fz-12">Ijin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Absensi Month --}}
    <div class="mt-4">

        <!-- Pagination-->
        <div class="shop-pagination pb-3">
            <div class="container">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="d-flex align-items-center justify-content-between"><small class="ms-1">Absensi Bulan
                                Ini</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-products-area product-list-wrap">
            <div class="container">
                <div class="row g-3">

                    @foreach ($presensiMonth as $item)
                        <div class="col-12">
                            <div class="card single-product-card">
                                <div class="card-body" style="padding: 10px;">
                                    <div class="d-flex align-items-center">
                                        <div class="card-side-img">
                                            <a class="product-thumbnail d-block"
                                                href="{{ url(Storage::url('uploads/absensi/' . $item->picture_in)) }}"
                                                data-lightbox="{{ url(Storage::url('uploads/absensi/' . $item->picture_in)) }}">
                                                <img src="{{ url(Storage::url('uploads/absensi/' . $item->picture_in)) }}"
                                                    width="112" height="112">
                                            </a>
                                        </div>

                                        <div class="card-content px-4 py-2">
                                            <a class="product-title d-block text-truncate mt-0"
                                                href="#">{{ date('d M Y', strtotime($item->created_at)) }}</a>
                                            <p class="mb-0 text-info">Jam Masuk: {{ $item->jam_in }}</p>
                                            <p class="mb-0 text-warning">Jam Pulang: {{ $item->jam_out }}</p>
                                            @if ($item->jam_in > $formattedTime)
                                                <p class="mb-0 text-danger">Terlambat
                                                    {{ calculateTimeDifference($timeIn, $item->jam_in) }}</p>
                                            @else
                                                <p class="mb-0 text-success">Tepat Waktu</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if ($presensiMonth->lastPage() > 1)
            <!-- Pagination-->
            <div class="shop-pagination pt-3">
                <div class="container">
                    <div class="card">
                        <div class="card-body py-3">
                            <nav aria-label="Page navigation example">
                                {{ $presensiMonth->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="pb-3"></div>
@endsection
