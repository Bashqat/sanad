<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/custom.css') }}" rel="stylesheet" type="text/css">

</head>
<body class="hold-transition login-page">
    @include('flash-message')
<div class="login-box ">

<div class="login-logo">
        {{-- <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a> --}}
    </div>
    <!-- /.login-logo -->
    <!-- /.login-box-body -->
        <div class="login-card-body">
            <!-- <p class="login-box-msg">Sign in to start your session</p> -->
              <div class="card-body">
                 <h4 class="pb-2 text-center text-dark text-uppercase">{{ __('language.login') }}</h4>
            <form method="post" action="{{ url('/login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="{{ __('language.email') }}"
                           class="form-control @error('email') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           placeholder="{{ __('language.password') }}"
                           class="form-control @error('password') is-invalid @enderror">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="log-btns d-flex align-items-center justify-content-between">
                            <div class="icheck-primary mt-1">
                            <input type="checkbox" id="remember" class="log-reg-check-box">
                            <label for="remember">{{ __('language.remember_me') }}</label>
                        </div>
                         <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt mr-2"></i>{{ __('language.signin') }}</button>

                       <!--  <div class="social-auth-links text-center ">

                         <a href="{{ route('password.request') }}" class="btn"> Forgot password? </a>
                    </div> -->
                       </div>
                    </div>
                </div>
            </form>


            <div class="forget-pass pb-2 pt-3">
                  <!--  <span class="or d-block mb-3 text-center">- OR -</span> -->

                <a href="{{ route('login-gmail') }}" class="gmail">
                            <i class="fas fa-envelope mr-2"></i> {{ __('language.signin_with_gmail') }}
                        </a>
          <!--  <a href="{{ route('register') }}" class="text-center register-btn">Register a new membership</a> -->

            </div>

            <div class="sign-up-btns pt-4 text-capitalize">
                <a href="{{ route('password.request') }}">{{ __('language.forget_password') }}</a>
                <span class="px-1">|</span>
                <a href="{{ route('register') }}">{{ __('language.signup') }}</a>
            </div>

        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->

<script src="{{ mix('js/app.js') }}" defer></script>

</body>
</html>
