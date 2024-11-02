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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">


                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- @yield('content') --}}
                                @yield('container')


                            </div>


                        </div>
                    </div>
                </div>

                {{-- @include('sweetalert::alert') --}}
            </div>

            @include('layouts.admin.footer')

            @yield('scripts')
        </div>
    </div>
</body>

</html>
