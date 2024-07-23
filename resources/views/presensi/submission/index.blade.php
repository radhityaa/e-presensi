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
                                <button type="button" class="btn btn-primary btn-block w-100" id="search-data">
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

    <div class="container py-3">

        <div class="add-new-contact-wrap">
            <a class="shadow" href="{{ route('submission.create') }}">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>

        <div class="py-3" id="show-history"></div>

        {{-- @foreach ($submissions as $item)
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
                                class="bi {{ $item->approve == 0 ? 'bi-clock' : ($item->approve == 1 ? 'bi-check2-circle' : 'bi-x-circle') }} h1 mb-0"></i>
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

        {{ $submissions->links() }} --}}
    </div>
@endsection

@push('page-js')
    <script>
        $(function() {
            function fetchHistory(url, month, year) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        month: month,
                        year: year
                    },
                    cache: false,
                    success: function(res) {
                        var historyContainer = $('#show-history');
                        historyContainer.empty();

                        if (res.data.length === 0) {
                            historyContainer.append(
                                '<div class="alert alert-warning"><p>Data Belum Ada</p></div>');
                        } else {
                            res.data.forEach(function(item) {
                                var cardClass = item.approve === 0 ? 'bg-warning' : (item
                                    .approve === 1 ? 'bg-success' : 'bg-danger');
                                var iconClass = item.approve === 0 ? 'bi-clock' : (item
                                    .approve === 1 ? 'bi-check2-circle' : 'bi-x-circle');
                                var statusText = item.status === 's' ? 'Sakit' : 'Izin';
                                var approveText = item.approve === 0 ? 'Menunggu Dikonfirmasi' :
                                    (item.approve === 1 ? 'Disetujui: ' + item.approve_by :
                                        'Ditolak: ' + item.reject_by);
                                var dateText = item.approve === 1 ? item.formatted_approve_at :
                                    item.formatted_reject_at;

                                var timelineCard = $('<div>', {
                                    class: 'card timeline-card ' + cardClass
                                });
                                var cardBody = $('<div>', {
                                    class: 'card-body'
                                });
                                var dFlex = $('<div>', {
                                    class: 'd-flex justify-content-between'
                                });
                                var timelineText = $('<div>', {
                                    class: 'timeline-text mb-2'
                                });
                                var timelineIcon = $('<div>', {
                                    class: 'timeline-icon mb-2'
                                });

                                var badge = $('<span>', {
                                    class: 'badge mb-2 rounded-pill'
                                }).text(item.formatted_created_at);
                                var h6 = $('<h6>').text(statusText);
                                timelineText.append(badge).append(h6);

                                var icon = $('<i>', {
                                    class: 'bi ' + iconClass + ' h1 mb-0'
                                });
                                timelineIcon.append(icon);

                                dFlex.append(timelineText).append(timelineIcon);

                                var description = $('<p>', {
                                    class: 'mb-2'
                                }).text(item.description);

                                var timelineTags = $('<div>', {
                                    class: 'timeline-tags'
                                });
                                var statusBadge = $('<span>', {
                                    class: 'badge fw-normal ' + cardClass
                                }).text(approveText);

                                timelineTags.append(statusBadge);

                                if (item.approve > 0) {
                                    var dateBadge = $('<span>', {
                                        class: 'badge fw-normal ' + cardClass
                                    }).text('Tanggal: ' + dateText);
                                    timelineTags.append(dateBadge);
                                }

                                cardBody.append(dFlex).append(description).append(timelineTags);
                                timelineCard.append(cardBody);

                                historyContainer.append(timelineCard);
                            });

                            var paginationDiv = $('<div>', {
                                class: 'shop-pagination pt-3'
                            });
                            var paginationContainer = $('<div>', {
                                class: 'container'
                            });
                            var paginationCard = $('<div>', {
                                class: 'card'
                            });
                            var paginationCardBody = $('<div>', {
                                class: 'card-body py-3'
                            });
                            var nav = $('<nav>', {
                                'aria-label': 'Page navigation example'
                            });

                            nav.append(res.links);
                            paginationCardBody.append(nav);
                            paginationCard.append(paginationCardBody);
                            paginationContainer.append(paginationCard);
                            paginationDiv.append(paginationContainer);
                            historyContainer.append(paginationDiv);

                            // Bind click event to pagination links
                            historyContainer.find('a.page-link').on('click', function(e) {
                                e.preventDefault();
                                var url = $(this).attr('href');
                                fetchHistory(url, month, year);
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }

            $('#search-data').on('click', function(e) {
                e.preventDefault();
                var month = $('#month').val();
                var year = $('#year').val();
                var url = "{{ route('submission.index') }}";
                fetchHistory(url, month, year);
            });
        });
    </script>
@endpush
