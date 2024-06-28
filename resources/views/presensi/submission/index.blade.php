@extends('layouts.app')

@section('content')
    <div class="container py-3">

        @foreach ($submissions as $item)
            <div
                class="card timeline-card {{ $item->approve == 0 ? 'bg-warning' : ($item->approve == 1 ? 'bg-success' : 'bg-danger') }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="timeline-text mb-2">
                            <span class="badge mb-2 rounded-pill">{{ date('d-m-Y', strtotime($item->created_at)) }}</span>
                            <h6>{{ $item->status === 's' ? 'Sakit' : 'Izin' }}</h6>
                        </div>
                        <div class="timeline-icon mb-2">
                            <i
                                class="bi {{ ($item->approve == 0 ? 'bi-clock' : $item->approve == 1) ? 'bi-check2-circle' : 'bi-x-circle' }} h1 mb-0"></i>
                        </div>
                    </div>
                    <p class="mb-2">{{ $item->description }}</p>
                    <div class="timeline-tags">
                        <span
                            class="badge fw-normal {{ $item->approve == 0 ? 'bg-warning' : ($item->approve == 1 ? 'bg-success' : 'bg-danger') }}">{{ $item->approve == 0 ? 'Menunggu Dikonfirmasi' : ($item->approve == 1 ? 'Disetujui: ' . $item->approve_by : 'Ditolak: ' . $item->reject_by) }}</span>
                        @if ($item->approve > 0)
                            <span
                                class="badge fw-normal {{ $item->approve == 0 ? 'bg-warning' : ($item->approve == 1 ? 'bg-success' : 'bg-danger') }}">Tanggal:
                                {{ $item->approve == 1 ? $item->approve_at->format('d M Y') : $item->reject_at->format('d M Y') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        {{ $submissions->links() }}
    </div>
@endsection
