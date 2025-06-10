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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

        .hover-pointer {
            cursor: pointer;
        }

        .hover-pointer:hover {
            color: blue;
        }

        .required:after {
            content: " *";
            color: red;
            font-weight: bold;
        }

        #invalid-list li {
            list-style: none;
            font-size: 1rem;
            font-weight: 500;
        }

        .slip-download-button {
            position: relative;
            overflow: hidden;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .slip-download-button.loading {
            pointer-events: none;
            /* Disable clicks while loading */
            color: transparent;
            /* Hide the icon text while loading */
        }

        .slip-download-button.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            transform: translate(-50%, -50%);
            z-index: 2;
            /* Ensure it appears above the button */
        }

        .slip-download-button.done {
            background-color: #28a745 !important;
            /* Success green */
            color: #fff !important;
        }

        .slip-download-button.done::after {
            content: '\f00c';
            /* FontAwesome checkmark */
            font-family: FontAwesome;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 14px;
            z-index: 2;
            /* Ensure it appears above the button */
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes spin {
            from {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>
