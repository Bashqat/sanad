@extends('layouts.app')
<title>Sanad | Setting</title>
@section('content')
<div class="container">
<div class="alert  msg_response" >
  <!-- <strong>Success!</strong> Indicates a successful or positive action. -->
</div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <!-- <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#buisness" role="tab" aria-controls="buisness">{{ __('language.business') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#application" role="tab" aria-controls="application">{{ __('language.application') }}</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#email_smtp" role="tab" aria-controls="email_smtp">{{ __('language.email_smtp') }}</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#payment_gateway" role="tab" aria-controls="payment_gateway">{{ __('language.payment_gateway') }}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#cron" role="tab" aria-controls="payment_gateway">{{ __('language.cron') }}</a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Messages</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-controls="settings">Settings</a>
      </li> -->
  </ul>

        <div class="tab-content">


          <div class="tab-pane active" id="email_smtp" role="tabpanel">
              <div class="card">

                   <div class="card-body pt-5">
                   <div class="tab-content edit-profile-main-sec">
                       <div class="tab-pane active" id="settings">
                       <form class="form-horizontal" method="POST" id="" action="{{ route('organisation.setting-update') }}" enctype="">
                           @csrf
                           <input type="hidden" name="org_id" value="{{$org_id}}">
                           <div class="form-row">
                                <div class="form-group col-md-6">

                                    <label for="inputSmtpemail">{{ __('language.smtp_email') }}</label>
                                    <input type="email" name="smtp_email" class="form-control @error('smtp_email') is-invalid @enderror" id="inputSmtpemail" placeholder="{{ __('language.smtp_email') }}" value="{{ (isset($smtp_data[0]->smtp_email)) ? $smtp_data[0]->smtp_email : '' }}" required>
                                    <span id="smtp_email_error" class="error" role="alert">

                                        </span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">{{ __('language.smtp_username') }}</label>
                                    <input type="text" name="smtp_username" class="form-control @error('smtp_username') is-invalid @enderror" id="inputSmtpusername" placeholder="{{ __('language.smtp_username') }}" value="{{ (isset($smtp_data[0]->smtp_username)) ? $smtp_data[0]->smtp_username : '' }}">
                                    <span id="smtp_username_error" class="error" role="alert" required>

                                        </span>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">{{ __('language.smtp_host') }}</label>
                                    <input type="text" name="smtp_host" class="form-control @error('smtp_host') is-invalid @enderror" id="inputSmtphost" placeholder="{{ __('language.smtp_host') }}" value="{{ (isset($smtp_data[0]->smtp_host)) ? $smtp_data[0]->smtp_host : '' }}" required>
                                    <span id="smtp_host_error" class="error" role="alert">

                                        </span>
                                </div>
                                <div class="form-group col-md-6">

                                    <label for="inputEmail4">{{ __('language.smtp_password') }}</label>
                                    <input type="text" name="smtp_password" class="form-control @error('smtp_password') is-invalid @enderror" id="inputSmtppassword" placeholder="{{ __('language.smtp_password') }}" value="{{ (isset($smtp_data[0]->smtp_password)) ? $smtp_data[0]->smtp_password : '' }}" required>
                                    <span id="smtp_password_error" class="error" role="alert">

                                        </span>
                                </div>



                            </div>




                           <div class="form-group row">
                           <div class="offset-sm-2 col-sm-10 text-right">
                               <button type="submit" class="btn btn-primary update_setting">{{ __('language.update') }}</button>
                           </div>
                           </div>
                       </form>
                       </div>
                       <!-- /.tab-pane -->
                   </div>
                   <!-- /.tab-content -->
                </div><!-- /.card-body -->
        </div>
  </div>


</div>


@endsection

<style>
  .nav.nav-tabs {
    float: left;
    display: block;
    margin-right: 20px;
    border-bottom:0;
    border-right: 1px solid #ddd;
    padding-right: 15px;
}
.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    background: #ccc;
}

/* .nav-tabs .nav-link.active {
    color: #495057;
    background-color:#007bff !important;
    border-color: transparent !important; */
}
.nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: 0rem!important;
    border-top-right-radius: 0rem!important;
}
.tab-content>.active {
    display: block;
    /* background: #007bff; */
    min-height: 165px;
}
.nav.nav-tabs {
    float: left;
    display: block;
    margin-right: 20px;
    border-bottom: 0;
    border-right: 1px solid transparent;
    padding-right: 15px;
}


    </style>
