@extends('layouts.app')

@section('content')
    <div class="page-content-wrapper py-3">
        <div class="container">

            @error('photo')
                <div class="alert custom-alert-3 alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle"></i>
                    <div class="alert-text">
                        <h6>Oops! something is wrong</h6>
                        <span>{{ $message }}</span>
                    </div>
                    <button class="btn btn-close position-relative p-1 ms-auto" type="button" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @enderror

            <div class="card">
                <div class="card-body py-5 text-center">
                    @if (!empty(Auth::guard('student')->user()->photo))
                        <img id="thumbnail" class="w-75 mb-4"
                            src="{{ url(Storage::url('uploads/students/' . Auth::guard('student')->user()->photo)) }}">
                    @else
                        <img id="thumbnail" class="w-75 mb-4" src="{{ asset('assets/affan/img/bg-img/29.png') }}">
                    @endif
                    <h5 class="mb-4">Upload Foto Baru</h5>

                    <!-- Form -->
                    <form action="{{ route('settings.profile.update-picture') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-file">
                            <input class="form-control d-none" id="photo" name="photo" type="file"
                                onchange="imagePreview(event, 'thumbnail')">
                            <label class="form-file-label justify-content-center" for="photo">
                                <span
                                    class="form-file-button btn btn-danger d-flex align-items-center justify-content-center shadow-lg">
                                    <i class="bi bi-plus-circle me-2 fz-16"></i> Upload File
                                </span>
                            </label>
                        </div>

                        <h6 class="mt-4 mb-0">Supported files</h6>
                        <small>.jpg .png .jpeg .gif</small>

                        <div class="mt-4">
                            <button class="btn btn-success"><i class="bi bi-save me-2 fz-16"></i> Simpan</button>
                        </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@push('page-js')
    <script>
        // Image Preview
        let imagePreview = function(event, id) {
            let output = document.getElementById(id)
            output.src = URL.createObjectURL(event.target.files[0])
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        }
    </script>
@endpush
