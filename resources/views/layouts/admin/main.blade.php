<!DOCTYPE html>
<html dir="ltr" lang="en">

@include('layouts.admin.head')

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        @include('layouts.admin.topbar')

        @include('layouts.admin.sidebar')

        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('content')

                {{-- @include('sweetalert::alert') --}}
            </div>

            @include('layouts.admin.footer')

        </div>
    </div>

    @yield('script')

    @yield('modal')

    @if (Auth::user()['2fa_secret'])
        @include('layouts.admin.disable_2fa_modal')
    @else
        @include('layouts.admin.enable_2fa_modal')
    @endif
</body>

</html>
