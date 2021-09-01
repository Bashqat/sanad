<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }} | Registration Page</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/custom.css') }}" rel="stylesheet" type="text/css">


</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        {{-- <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a> --}}
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <!--  <p class="login-box-msg">Register a new membership</p> -->
        <div class="card-body">
            <h4 class="pb-2 text-center text-dark text-capitalize">{{ __('language.signup') }}</h4>
            <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="input-group mb-3">
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="{{ __('language.full_name') }}"
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="{{ __('language.email') }}"
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="{{ __('language.password') }}"
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password"
                           name="password_confirmation"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="{{ __('language.confirm_password') }}"
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- <div class="input-group mb-3">
                    <div class="input-group">
                        <div class="custom-file">
                          <input
                          type="file"
                          name="profile"
                          class="form-control custom-file-input @error('profile') is-invalid @enderror"
                          id="exampleInputFile"
                          required
                          accept="image/*">
                          <label class="custom-file-label" for="exampleInputFile">{{ __('language.choose_file') }}</label>
                        </div>
                    </div>
                    @error('profile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div> -->

                <div class="row">
                    <div class="col-12">
                        <div class="log-btns d-flex align-items-center">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" class="@error('terms') is-invalid @enderror log-reg-check-box" required>
                                <label for="agreeTerms">
                                {{ __('language.aggre_to') }}<a href="#"> {{ __('language.term_condition') }}</a>
                                </label>
                                @error('terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="log-btns d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('language.register') }}</button>
                        </div>
                    </div>
                     <div class="col-12">
                        <div class="or-text d-flex justify-content-center py-1">
                            <h5 class="mb-0">{{ __('language.or') }}</h5>
                        </div>
                     </div>
                    <!-- /.col -->
                    <div class="col-12">
                        <div class="forget-pass pb-2 pt-3 justify-content-end">
                            <a href="{{ route('login-gmail') }}" class="btn btn-block btn-danger">
                                <i class="fas fa-envelope mr-2"></i> {{ __('language.signin_with_gmail') }}
                            </a>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            {{ __('language.already_have_account') }}?<a href="{{ route('login') }}" class="text-center"> {{ __('language.login_here') }}</a>
        </div>
    </div>
        <!-- /.form-box -->
    </div><!-- /.card -->

    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<div class="register-footer-link w-100 p-2">
    <div class="row">
        <div class="col-12">
            <a href="#" class="text-uppercase text-muted">sanad hub</a>
            <span class="text-muted px-1">|</span>
            <a href="#" class="text-muted">terms</a>
        </div>
    </div>
    </div>

<script src="{{ mix('js/app.js') }}" defer></script>
<script src="{{ url('js/script.js') }}" defer></script>
</body>
</html>
