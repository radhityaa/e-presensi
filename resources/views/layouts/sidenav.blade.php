<div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
    aria-labelledby="affanOffcanvsLabel">

    <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas"
        aria-label="Close"></button>

    <div class="offcanvas-body p-0">
        <div class="sidenav-wrapper">
            <!-- Sidenav Profile -->
            <div class="sidenav-profile bg-gradient">
                <div class="sidenav-style1"></div>

                <!-- User Thumbnail -->
                <div class="user-profile">
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

                <!-- User Info -->
                <div class="user-info">
                    <h6 class="user-name mb-0">{{ Auth::guard('student')->user()->name }}</h6>
                    <span>{{ Auth::guard('student')->user()->classroom->name }}</span>
                </div>
            </div>

            <!-- Sidenav Nav -->
            <ul class="sidenav-nav ps-0">
                <li>
                    <a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i> Home</a>
                </li>
                <li>
                    <a href="{{ route('submission.index') }}"><i class="bi bi-calendar-check"></i> Pengajuan</a>
                </li>
                <li>
                    <a href="{{ route('presensi.history') }}"><i class="bi bi-collection"></i> Riwayat</a>
                </li>
                <li>
                    <a href="{{ route('settings.index') }}"><i class="bi bi-gear"></i> Pengaturan</a>
                </li>
                <li>
                    <div class="night-mode-nav">
                        <i class="bi bi-moon"></i> Night Mode
                        <div class="form-check form-switch">
                            <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                        </div>
                    </div>
                </li>
                <li>
                    <a href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a>
                </li>
            </ul>

            <!-- Social Info -->
            <div class="social-info-wrap">
                <a href="#">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#">
                    <i class="bi bi-twitter"></i>
                </a>
                <a href="#">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>

            <!-- Copyright Info -->
            <div class="copyright-info">
                <p>
                    <span id="copyrightYear"></span>
                    &copy; Made by <a href="#">SMAN 3 Purwakarta</a>
                </p>
            </div>
        </div>
    </div>
</div>
