@if ($histories->isEmpty())
    <div class="alert alert-warning">
        <p>Data Belum Ada</p>
    </div>
@endif

<div class="top-products-area product-list-wrap">
    <div class="container">
        <div class="row g-3">

            @foreach ($histories as $item)
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

<!-- Pagination-->
<div class="shop-pagination pt-3">
    <div class="container">
        <div class="card">
            <div class="card-body py-3">
                <nav aria-label="Page navigation example">
                    {{ $histories->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
