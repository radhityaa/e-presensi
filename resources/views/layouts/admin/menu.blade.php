<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">{{ env('APP_NAME') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div>Dashboards</div>
            </a>
        </li>

        <!-- Schedules -->
        <li class="menu-item {{ request()->is('admin/schedules*') ? 'active' : '' }}">
            <a href="{{ route('admin.schedules.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                <div>Jadwal Pelajaran</div>
            </a>
        </li>

        <!-- Submissions -->
        <li class="menu-item {{ request()->is('admin/submission*') ? 'active' : '' }}">
            <a href="{{ route('admin.submission.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-license"></i>
                <div>Data Pengajuan</div>
            </a>
        </li>

        <!-- Data Master -->
        <li class="menu-item {{ request()->is('admin/master/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-database"></i>
                <div>Data Master</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/master/users*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                        <div>Data User</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/master/student*') ? 'active' : '' }}">
                    <a href="{{ route('admin.student.index') }}" class="menu-link">
                        <div>Data Siswa</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('admin/master/classroom*') ? 'active' : '' }}">
                    <a href="{{ route('admin.classroom.index') }}" class="menu-link">
                        <div>Data Kelas</div>
                    </a>
                </li>
            </ul>
        </li>

        @role('admin|staff|walikelas')
            <!-- Report -->
            <li class="menu-item {{ request()->is('admin/report/*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-report"></i>
                    <div>Laporan</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('admin/report/absensi*') ? 'active' : '' }}">
                        <a href="{{ route('admin.report.presensi') }}" class="menu-link">
                            <div>Absensi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/report/rekap*') ? 'active' : '' }}">
                        <a href="{{ route('admin.report.rekap') }}" class="menu-link">
                            <div>Rekap Absensi</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole

        @role('admin|staff')
            <!-- Settings -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Setting</span>
            </li>
            <li class="menu-item {{ request()->is('admin/settings/location*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.location') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-map"></i>
                    <div>Lokasi</div>
                </a>
            </li>

            <li class="menu-item {{ request()->is('admin/settings/absence-time*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.absenceTime') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-clock"></i>
                    <div>Jam Absen</div>
                </a>
            </li>

            <li class="menu-item {{ request()->is('admin/settings/*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                    <div>Jadwal Pelajaran</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('admin/settings/subjects*') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.subjects.index') }}" class="menu-link">
                            <div>Mata Pelajaran</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/settings/schedules*') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.schedules.index') }}" class="menu-link">
                            <div>Ubah Jadwal</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Misc -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text" data-i18n="Misc">Misc</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.qr.qrcode') }}" target="_blank" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-qrcode"></i>
                    <div>Srole QRCode</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/" target="_blank"
                    class="menu-link">
                    <i class="menu-icon tf-icons ti ti-file-description"></i>
                    <div data-i18n="Documentation">Documentation</div>
                </a>
            </li>
        @endrole
    </ul>
</aside>
