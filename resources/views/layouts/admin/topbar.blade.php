<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-brand">
                <!-- Logo icon -->
                <a href="#">
                    <b class="logo-icon">
                        <!-- Dark Logo icon -->
                        <img src="{{ URL::asset('src/assets/images/logoitk.png') }}" alt="homepage" class="dark-logo"
                            width="40" />
                        <!-- Light Logo icon -->
                        <img src="{{ URL::asset('src/assets/images/logoitk.png') }}" alt="homepage" class="light-logo"
                            width="40" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                        <!-- dark Logo text -->
                        <img src="{{ URL::asset('src/assets/images/simbanding.png') }}" alt="homepage" class="dark-logo"
                            width="110" />
                        <!-- Light Logo text -->
                        <img src="{{ URL::asset('src/assets/images/simbanding.png') }}" class="light-logo"
                            alt="homepage" width="110" />
                    </span>
                </a>
            </div>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item d-none d-md-block">
                    @yield('notification')
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                        <img src="{{ URL::asset('https://ui-avatars.com/api/?background=random&name=' . Auth::user()->name) }}"
                            alt="userprofile" class="rounded-circle" width="40">
                        <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span>
                            <span class="text-dark">{{ Auth::user()->name }}</span>
                            <i data-feather="chevron-down" class="svg-icon"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item d-flex justify-content-between align-items-center reset_password_button">
                            <div>
                                <i data-feather="lock" class="svg-icon mr-2 ml-1"></i>
                                Ubah Password
                            </div>
                        </button>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item d-flex justify-content-between align-items-center 2fa_button">
                            <div>
                                <i data-feather="key" class="svg-icon mr-2 ml-1"></i>
                                2FA
                            </div>
                            @if (Auth::user()["2fa_secret"])
                                <span class="badge badge-light-success px-3">Enabled</span>
                            @else
                                <span class="badge badge-light-danger px-3">Disabled</span>
                            @endif
                        </button>
                        {{-- <a class="dropdown-item" href="javascript:void(0)"><i data-feather="credit-card"
                                        class="svg-icon mr-2 ml-1"></i>
                                    My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="mail"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="home"><i data-feather="settings"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Account Setting</a> --}}
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item"><i data-feather="power" class="svg-icon mr-2 ml-1">
                                </i>Logout</button>
                        </form>
                        {{-- <div class="dropdown-divider"></div>
                                <div class="pl-4 p-3"><a href="javascript:void(0)" class="btn btn-sm btn-info">View
                                        Profile</a></div>
                            </div> --}}
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
