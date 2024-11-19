@php
    $isActive = function($path) {
        return request()->routeIs($path) ? 'selected' : '';
    };

    $isAnyActive = function($paths) {
        foreach ($paths as $path) {
            if ($isActive($path)) {
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
