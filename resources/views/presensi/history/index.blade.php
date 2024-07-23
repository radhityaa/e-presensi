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

    <div class="py-3" id="show-history"></div>
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
                            var productListWrap = $('<div>', {
                                class: 'top-products-area product-list-wrap'
                            });
                            var containerDiv = $('<div>', {
                                class: 'container'
                            });
                            var rowDiv = $('<div>', {
                                class: 'row g-3'
                            });

                            res.data.forEach(function(item) {
                                var colDiv = $('<div>', {
                                    class: 'col-12'
                                });
                                var cardDiv = $('<div>', {
                                    class: 'card single-product-card'
                                });
                                var cardBody = $('<div>', {
                                    class: 'card-body',
                                    style: 'padding: 10px;'
                                });
                                var cardContent = $('<div>', {
                                    class: 'd-flex align-items-center'
                                });

                                var cardSideImg = $('<div>', {
                                    class: 'card-side-img'
                                });
                                var imgLink = $('<a>', {
                                    class: 'product-thumbnail d-block',
                                    href: item.picture_in_url,
                                    'data-lightbox': item.picture_in_url
                                });
                                var img = $('<img>', {
                                    src: item.picture_in_url,
                                    width: 112,
                                    height: 112
                                });

                                imgLink.append(img);
                                cardSideImg.append(imgLink);
                                cardContent.append(cardSideImg);

                                var contentDiv = $('<div>', {
                                    class: 'card-content px-4 py-2'
                                });
                                var productTitle = $('<a>', {
                                    class: 'product-title d-block text-truncate mt-0',
                                    href: '#'
                                }).text(new Date(item.created_at).toLocaleDateString(
                                    'id-ID', {
                                        day: '2-digit',
                                        month: 'short',
                                        year: 'numeric'
                                    }));

                                contentDiv.append(productTitle);
                                contentDiv.append('<p class="mb-0 text-info">Masuk: ' + item
                                    .jam_in + '</p>');
                                contentDiv.append('<p class="mb-0 text-warning">Pulang: ' +
                                    item.jam_out + '</p>');

                                var formattedTime =
                                    '09:00:00'; // Define your formatted time logic
                                if (item.jam_in > formattedTime) {
                                    contentDiv.append(
                                        '<p class="mb-0 text-danger">Terlambat</p>'
                                    ); // Add calculateTimeDifference logic
                                } else {
                                    contentDiv.append(
                                        '<p class="mb-0 text-success">Tepat Waktu</p>');
                                }

                                cardContent.append(contentDiv);
                                cardBody.append(cardContent);
                                cardDiv.append(cardBody);
                                colDiv.append(cardDiv);
                                rowDiv.append(colDiv);
                            });

                            containerDiv.append(rowDiv);
                            productListWrap.append(containerDiv);
                            historyContainer.append(productListWrap);

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
                var url = "{{ route('presensi.history') }}";
                fetchHistory(url, month, year);
            });
        });
    </script>
@endpush
