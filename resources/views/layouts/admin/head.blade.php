<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('src/assets/images/logoitk.png') }}">
    <title>@yield('title') | SIMGAJI</title>
    <!-- Custom CSS -->
    <link href="{{ asset('src/assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('src/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('src/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- This page plugin CSS -->
    <link href="{{ asset('src/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('src/dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('src/assets/libs/toastr.css') }}" rel="stylesheet">
    <style>
        .badge-light-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-light-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-light-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
