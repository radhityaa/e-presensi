@extends('layouts.app')

@section('content')
    <div class="page-content-wrapper py-3">
        <div class="container">
            <!-- User Information-->
            <div class="card user-info-card mb-3">
                <div class="card-body d-flex align-items-center">
                    <div class="user-profile me-3">
                        @if (!empty(Auth::guard('student')->user()->photo))
                            <a href="{{ url(Storage::url('uploads/students/' . Auth::guard('student')->user()->photo)) }}"
                                data-lightbox="{{ url(Storage::url('uploads/students/' . Auth::guard('student')->user()->photo)) }}">
                                <img
                                    src="{{ url(Storage::url('uploads/students/' . Auth::guard('student')->user()->photo)) }}">
                            </a>
                        @else
                            <a href="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}"
                                data-lightbox="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}">
                                <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}">
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

            <!-- User Meta Data-->
            <div class="card user-data-card">
                <div class="card-body">
                    <form action="#">
                        <div class="form-group mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input class="form-control" id="name" name="name" type="text"
                                value="{{ old('name', $student->name) }}" placeholder="name">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="nik">NIK</label>
                            <input class="form-control" id="nik" name="nik" type="text"
                                value="{{ old('nik', $student->nik) }}" placeholder="NIK" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="phone">Nomor HP</label>
                            <input class="form-control" id="phone" name="phone" type="number"
                                value="{{ $student->phone }}" placeholder="0895xxxxx">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="address">Alamat Lengkap</label>
                            <textarea class="form-control" id="address" name="address" cols="30" rows="10" placeholder="Alamat Lengkap">{{ old('address', $student->address) }}</textarea>
                        </div>

                        <button class="btn btn-success w-100" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
