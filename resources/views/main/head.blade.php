<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.min.css">
    {{-- <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="/css/sb-admin-2.min.css">
    {{-- <script src="/bootstrap/js/bootstrap.bundle.js"></script> --}}
    <script src="/vendor/jquery/jquery.min.js"></script>

    <style>
        .bi {
            font-weight: bold !important;
            font-size: 1.2em !important;
        }

        .nav-item a {
            display: flex !important;
            align-items: center;
            gap: 10px;
        }

        .alert{
            z-index:9999 !important;
        }

        th,
        tr,
        td,
        tbody,
        thead {
            text-wrap: nowrap !important;
            padding-left: 10px !important;
            padding-right: 10px !important;
            mix-blend-mode: normal !important;
        }
    </style>
</head>

<body id="page-top" class="sidebar-toggled">

    <!-- Page Wrapper -->
    <div class="position relative d-flex justify-content-center w-100">
        @if (session()->has('success'))
            <div class="position-absolute z-5 top-0 d-flex gap-2 align-items-center justify-content-between my-4 col-md-4 col-11 alert alert-success fade show"
                role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        @elseif(session()->has('fail'))
            <div class="position-absolute z-5 top-0 d-flex gap-2 align-items-center justify-content-between my-4 col-md-4 col-11 alert alert-danger fade show"
                role="alert">
                <span>{{ session('fail') }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        @endif
    </div>
    <div id="wrapper">
