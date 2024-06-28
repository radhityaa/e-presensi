<div class="footer-nav-area" id="footerNav">
    <div class="container px-0">
        <!-- Footer Content -->
        <div class="footer-nav position-relative shadow-sm footer-style-two">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="bi bi-house"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('submission.index') }}">
                        <i class="bi bi-calendar-check"></i>
                    </a>
                </li>

                <li class="active">
                    <a href="{{ route('qrcode.scan') }}">
                        <i class="bi bi-camera"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('presensi.history') }}">
                        <i class="bi bi-clock-history"></i>
                    </a>
                </li>

                <li>
                    <a href="{{ route('settings.index') }}">
                        <i class="bi bi-gear"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
