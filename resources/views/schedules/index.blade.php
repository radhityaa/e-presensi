@extends('layouts.admin.template')

@section('title')
    Daftar Jadwal Pelajaran
@endsection

@push('page-css')
@endpush

@section('content')
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Form Repeater</h5>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                            <label class="form-label" for="form-repeater-1-1">Username</label>
                            <input type="text" id="form-repeater-1-1" class="form-control" placeholder="john.doe" />
                        </div>
                        <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                            <label class="form-label" for="form-repeater-1-2">Password</label>
                            <input type="password" id="form-repeater-1-2" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        </div>
                        <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                            <label class="form-label" for="form-repeater-1-3">Gender</label>
                            <select id="form-repeater-1-3" class="form-select">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                            <label class="form-label" for="form-repeater-1-4">Profession</label>
                            <select id="form-repeater-1-4" class="form-select">
                                <option value="Designer">Designer</option>
                                <option value="Developer">Developer</option>
                                <option value="Tester">Tester</option>
                                <option value="Manager">Manager</option>
                            </select>
                        </div>
                    </div>
                    <hr />
                    <div class="mb-0">
                        <button class="btn btn-primary">
                            <i class="ti ti-plus me-1"></i>
                            <span class="align-middle">Add</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('page-js')
@endpush
