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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="main-heading">{{ ucfirst( str_replace("-"," ", Request::segment(1)) ) }}</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content pb-3 position-relative master_section-sec">
            @include('flash-message')
            @yield('content')

        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer pt-5 pl-0 pr-0 pb-0">
        <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4  mt-5 mb-4">

        <!-- Content -->
       <!-- Facebook -->
          <a class="fb-ic" href="#">
            <i class="fab fa-facebook-f fa-lg text-white mr-md-3 mr-3 fa-1x"> </i>
          </a>
          <!-- Twitter -->
          <a class="tw-ic" href="#">
            <i class="fab fa-twitter fa-lg text-white mr-md-3 mr-3 fa-1x"> </i>
          </a>
          <!--Linkedin -->
          <a class="li-ic" href="#">
            <i class="fab fa-linkedin-in fa-lg text-white mr-md-3 mr-3 fa-1x"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic" href="#">
            <i class="fab fa-instagram fa-lg text-white mr-md-3 mr-3 fa-1x"> </i>
          </a>
          <!--Pinterest-->
          <a class="pin-ic" href="#">
            <i class="fab fa-pinterest fa-lg text-white mr-md-3 mr-3 fa-1x"> </i>
          </a>
          <!-- Google +-->
          <a class="ytube-ic" >
            <i class="fab fa-youtube fa-lg text-white  fa-1x"> </i>
          </a>

      </div>
      <!-- Grid column -->


      <!-- Grid column -->
      <div class="col-md-4 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase text-white">Company</h5>

        <ul class="list-unstyled mt-3 footer-menu">
          <li>
            <a class="text-white" href="#!">Policies</a>
          </li>
          <li>
            <a class="text-white" href="#!">Refund</a>
          </li>
          <li>
            <a class="text-white" href="#!">Payment</a>
          </li>
          <li>
            <a class="text-white" href="#!">Cancellation</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase text-white">Get in touch</h5>

        <ul class="list-unstyled mt-3">
          <li>
            <span class="d-block text-white">call us</span>
            <a class="text-white" href="tel:+919665840279">+91 9665 8402 79</a>
          </li>
          <li>
             <span class="d-block text-white">email us</span>
            <a class="text-white text-lowercase" href="mailto:info@basilhomes.in">info@basilhomes.in</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

        <!-- <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div> -->
       <div class="copyright ">
        <hr class="border-light">
       <div class="container">
            <div class="row justify-content-center justify-content-sm-between ">
                <div class="copyright-left mx-1">
                    <span class="text-white">Copyright &copy; SANAD</span>
                </div>
                <div class="copyright-right">
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">terms & conditions</a></li>
                        <span class="text-white">|</span>
                        <li><a href="#" class="text-white">privacy policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
       </div>
    </footer>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ url('js/script.js') }}" defer></script>
<script src="{{ url('js/custom.js') }}" defer></script>
@yield('third_party_scripts')

@stack('scripts')
</body>
</html>
