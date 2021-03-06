@extends('layouts.app')
<title>Sanad | Setting</title>
@section('content')
<div class="container">
<div class="alert  msg_response" >
  <!-- <strong>Success!</strong> Indicates a successful or positive action. -->
</div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#pin_setting" role="tab" aria-controls="home"> {{ __('language.change_pin') }}</a>
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">{{ __('language.email_smtp') }}</a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Messages</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-controls="settings">Settings</a>
      </li> -->
  </ul>

  <div class="tab-content">
    <div class="tab-pane active" id="pin_setting" role="tabpanel">
      <div class="card">

                   <div class="card-body pt-5">
                   <div class="tab-content edit-profile-main-sec">
                       <div class="tab-pane active" id="settings">
                       <form class="pin_setting" method="POST" action="" id="pin_change">
                           @csrf
                           <input type="hidden" name="superadmin_id" value="{{Auth::user()->id}}">
                           <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputPin">{{ __('language.pin') }}</label>

                                    <input type="number" name="pin" class="form-control" id="inputPin" placeholder="{{ __('language.pin') }}" value="{{ (isset($setting[0]->pin)) ? $setting[0]->pin : '' }}" required>
                                    <span id="pin_error" class="error" role="alert">

                                            </span>
                                </div>
                              </div>



                           <div class="form-group row">
                           <div class="offset-sm-2 col-sm-10 text-right">
                               <button type="submit" class="btn btn-primary update_superadmin_setting">{{ __('language.update') }}</button>
                           </div>
                           </div>
                       </form>
                       </div>
                       <!-- /.tab-pane -->
                   </div>
                   <!-- /.tab-content -->
                   </div><!-- /.card-body -->
               </div></div>
    <div class="tab-pane" id="profile" role="tabpanel">
      <div class="card">
              <div class="form-row">
                  <div class="form-group col-md-12">
                      <h1 class="text-center">No Email Smtp</h1>
                  </div>
              </div>
        </div>
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
