@php
    function isActive($path)
    {
        return request()->routeIs($path) ? 'selected' : '';
    }

    function isAnyActive($paths)
    {
        foreach ($paths as $path) {
            if (isActive($path)) {
                return 'selected';
            }
        }

        return '';
    }
@endphp

<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link {{ isActive('slip.index') }}" href="{{ route('slip.index') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <b class="hide-menu">Dashboard</b>
                    </a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>


                <li class="sidebar-item {{ isActive('slip.index') }}">
                    <a class="sidebar-link sidebar-link" href="{{ URL('/pengajuan') }}" aria-expanded="false">
                        <i class="fas fa-indent" class="feather-icon"></i>
                        <b class="hide-menu">Data Pengajuan</b>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
