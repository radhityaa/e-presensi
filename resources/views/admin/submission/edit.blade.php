@extends('layouts.admin.template')

@section('title')
    Detail Pengajuan
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Detail Pengajuan: {{ $submmission->student->name }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.submission.update', $submmission) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Nama Lengkap" value="{{ $submmission->student->name }}" readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="nik">NIK</label>
                                <input type="number" name="nik" id="nik" class="form-control" placeholder="NIK"
                                    value="{{ $submmission->student->nik }}" readonly />
                            </div>
                            <div class="col-md-4">
                                <label for="classroom_id" class="form-label">Kelas</label>
                                <input type="text" class="form-control" name="classroom_id" id="classroom_id"
                                    value="{{ $submmission->student->Classroom->name }}" readonly />
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="status">Jenis</label>
                                <input type="text" class="form-control" name="status" id="status"
                                    placeholder="Status" value="{{ $submmission->status === 'i' ? 'Ijin' : 'Sakit' }}"
                                    readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="created_at">Tanggal Pengajuan</label>
                                <input type="text" name="created_at" id="created_at" class="form-control"
                                    placeholder="Tanggal" value="{{ $submmission->created_at->format('d M y h:i') }}"
                                    readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="approve">Status</label>
                                <select name="approve" id="approve" class="form-control"
                                    @if ($submmission->approve == 0) required @else disabled @endif>
                                    <option value="" selected disabled>{{ $approveName }}
                                    </option>
                                    <option value="1">Approved</option>
                                    <option value="2">Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="description">Alasan</label>
                        <textarea class="form-control" name="description" id="description" rows="3" readonly>
                            {{ $submmission->description }}
                        </textarea>
                    </div>

                    @if ($submmission->approve == 1)
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="approve_at">Tanggal Approve</label>
                                    <input type="text" name="approve_at" id="approve_at" class="form-control"
                                        value="{{ $submmission->approve_at ? $submmission->approve_at->format('d M y h:i') : '' }}"
                                        readonly />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="approve_by">Approve By</label>
                                    <input type="text" name="approve_by" id="approve_by" class="form-control"
                                        value="{{ $submmission->approve_by ? $submmission->approve_by : '' }}" readonly />
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($submmission->approve == 2)
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="reject_at">Tanggal Reject</label>
                                    <input type="text" name="reject_at" id="reject_at" class="form-control"
                                        value="{{ $submmission->reject_at ? $submmission->reject_at->format('d M y h:i') : '' }}"
                                        readonly />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="reject_by">Reject By</label>
                                    <input type="text" name="reject_by" id="reject_by" class="form-control"
                                        value="{{ $submmission->reject_by ? $submmission->reject_by : '' }}" readonly />
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <div class="d-flex gap-4">
                            @if ($submmission->approve == 0)
                                <button type="submit" class="btn btn-success">Submit</button>
                            @endif
                            <a href="{{ route('admin.submission.index') }}" class="btn btn-dark">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
