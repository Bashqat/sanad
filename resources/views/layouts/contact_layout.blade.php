<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>

    <link href="{{ url('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/toastr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/custom.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ url('css/chosen/style.css') }}">

    <link rel="stylesheet" href="{{ url('css/chosen/chosen.css') }}">

    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed" @if (Session::has('message'))

@endif>
<div class="wrapper">
@include('layouts.header_menu')

<div id="modal-div">
</div>
    <!-- Left side column. contains the logo and sidebar -->
{{-- @include('layouts.sidebar') --}}

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper contact-content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="main-heading">{{ ucfirst( str_replace("-"," ", Request::segment(1)) ) }}</h1>
                    </div>
                </div>
            </div>
        </section> -->

        <section class="content pb-3 position-relative master_section-sec">

            @yield('content')

        </section>
    </div>

    <!-- Main Footer -->
    
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ url('js/script.js') }}" defer></script>
<script src="{{ url('js/custom.js') }}" defer></script>
<script src="{{ url('js/chosen/chosen.jquery.js') }}" ></script>
<script src="{{ url('js/chosen/init.js') }}" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>

@yield('third_party_scripts')

@stack('scripts')
</body>
</html>
