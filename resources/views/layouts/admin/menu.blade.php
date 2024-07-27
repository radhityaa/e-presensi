<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="32" height="32">
            <span class="app-brand-text demo menu-text fw-bold">E-Presensi</span>
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

        <!-- Data Master -->
        <li class="menu-item {{ request()->is('admin/master/*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-database"></i>
                <div>Data Master</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/master/presensi*') ? 'active' : '' }}">
                    <a href="{{ route('admin.presensi.master.index') }}" class="menu-link">
                        <div>Data Absensi</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('admin/master/submission*') ? 'active' : '' }}">
                    <a href="{{ route('admin.submission.index') }}" class="menu-link">
                        <div>Data Izin Sakit</div>
                    </a>
                </li>

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

            <li class="menu-item {{ request()->is('admin/settings/subjects*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.subjects.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                    <div>Mata Pelajaran</div>
                </a>
            </li>

            <li class="menu-item {{ request()->is('admin/settings/schedules*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.schedules.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                    <div>Jadwal Pelajaran</div>
                </a>
            </li>

            <!-- Misc -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text" data-i18n="Misc">Misc</span>
            </li>
            <li class="menu-item">
                <a href="{{ route('admin.qr.qrcode') }}" target="_blank" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-qrcode"></i>
                    <div>QRCode</div>
                </a>
            </li>
        @endrole
    </ul>
</aside>
