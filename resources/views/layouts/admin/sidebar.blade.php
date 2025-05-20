@php
    $isActive = function($path) {
        return request()->routeIs($path) ? 'selected' : '';
    };

    $isAnyActive = function($paths) {
    foreach ($paths as $path) {
        if (request()->routeIs($path)) {
            return 'selected';
        }
    }

    return '';
};

@endphp

<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link {{ $isActive('slip.index') }}" href="{{ route('slip.index') }}"
                        aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <b class="hide-menu">Dashboard</b>
                    </a>


                @hasanyrole(['admin', 'finance'])
                    <li class="list-divider"></li>
                    <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>
                @endrole

                @role('staff')
                    <li class="sidebar-item {{ $isActive('employee.profile') }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('employee.profile') }}" aria-expanded="false">
                            <i class="fas fa-id-badge" class="feather-icon"></i>
                            <b class="hide-menu">Profil Saya</b>
                        </a>
                    </li>
                @endrole



                @role('admin')
                    <li class="sidebar-item {{ $isActive('account.index') }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('account.index') }}" aria-expanded="false">
                            <i class="fas fa-user" class="feather-icon"></i>
                            <b class="hide-menu">Akun</b>
                        </a>
                    </li>
                @endrole

                @hasanyrole(['admin', 'finance'])
                    <li class="sidebar-item {{ $isActive('upload.index') }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('upload.index') }}" aria-expanded="false">
                            <i class="fas fa-upload" class="feather-icon"></i>
                            <b class="hide-menu">Upload</b>
                        </a>
                    </li>
                @endhasanyrole

                @role(['admin', 'finance'])
                    <li class="sidebar-item {{ $isActive('salary.index', 'pages.payroll.create') }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('salary.index') }}" aria-expanded="false">
                            <i class="fas fa-fax" class="feather-icon"></i>
                            <b class="hide-menu">Payroll</b>
                        </a>
                    </li>
                @endrole

                @role(['admin', 'finance', 'staff'])
                    <li class="sidebar-item dropdown {{ request()->routeIs('laporan.list') || request()->routeIs('laporan.create') ? 'active' : '' }}">
                        <a href="#laporanDropdown" class="sidebar-link dropdown-toggle" data-bs-toggle="collapse" role="button" aria-expanded="{{ (request()->routeIs('laporan.list') || request()->routeIs('laporan.create')) ? 'true' : 'false' }}" aria-controls="laporanDropdown">
                            <i class="fas fa-fax"></i>
                            <b class="hide-menu">Laporan</b>
                        </a>
                        <ul class="collapse list-unstyled {{ (request()->routeIs('laporan.list') || request()->routeIs('laporan.create')) ? 'show' : '' }}" id="laporanDropdown">
                            <li class="{{ request()->routeIs('laporan.list') ? 'active' : '' }}">
                                <a class="sidebar-link" href="{{ route('laporan.list') }}">Daftar Laporan</a>
                            </li>
                            <li class="{{ request()->routeIs('laporan.create') ? 'active' : '' }}">
                                <a class="sidebar-link" href="{{ route('laporan.create') }}">Upload Laporan</a>
                            </li>
                        </ul>
                    </li>
                @endrole



                @role('admin')
                    <li class="sidebar-item {{ $isActive('api-key.index') }}">
                        <a class="sidebar-link sidebar-link" href="{{ route('api-key.index') }}" aria-expanded="false">
                            <i class="fas fa-key" class="feather-icon"></i>
                            <b class="hide-menu">Api Key</b>
                        </a>
                    </li>
                @endrole
            </ul>
        </nav>
    </div>
</aside>
