@extends('layouts.app')
@section('content')
<div class="container">
    
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#buisness" role="tab" aria-controls="buisness">Buisness</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#application" role="tab" aria-controls="application">Application</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#email_smtp" role="tab" aria-controls="email_smtp">Email/Smtp</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#payment_gateway" role="tab" aria-controls="payment_gateway">Payment Gateway</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#cron" role="tab" aria-controls="payment_gateway">Cron</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Messages</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-controls="settings">Settings</a>
      </li> -->
  </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="buisness" role="tabpanel">
                <div class="card">
                   
                   <div class="card-body pt-5">
                   <div class="tab-content edit-profile-main-sec">
                       <div class="tab-pane active" id="settings">
                       <form class="form-horizontal" id="business_setting" method="POST" action="" enctype="multipart/form-data">
                           @csrf
                           <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Business Name</label>
                                    <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror" id="inputName" placeholder="Business Name" value="{{ (isset($setting[0]->business_name)) ? $setting[0]->business_name : '' }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Business Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email" value="{{ (isset($setting[0]->email)) ? $setting[0]->email : '' }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Business Name</label>
                                    <textarea  name="address" class="form-control @error('address') is-invalid @enderror" id="inputAddress" placeholder="Address" required>{{ (isset($setting[0]->address)) ? $setting[0]->address : '' }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Business Currency</label>
                                    <input type="text" name="currency" class="form-control @error('currency') is-invalid @enderror" id="inputCurrency" placeholder="Currency" value="{{ (isset($setting[0]->currency)) ? $setting[0]->currency : '' }}" required>
                                    @error('currency')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                           
                           
                           
                           <div class="form-group row">
                           <div class="offset-sm-2 col-sm-10 text-right">
                               <button type="submit" class="btn btn-primary update_setting">Update</button>
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
            <div class="tab-pane" id="application" role="tabpanel">
                <div class="card">
                   
                   <div class="card-body pt-5">
                   <div class="tab-content edit-profile-main-sec">
                       <div class="tab-pane active" id="settings">
                       <form class="form-horizontal" id="application_setting" method="POST" action="" >
                           @csrf
                           <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Application Name</label>
                                    <input type="text" name="application_name" class="form-control @error('application_name') is-invalid @enderror" id="inputApplicationname" placeholder="Application name" value="{{ (isset($setting[0]->application_name)) ? $setting[0]->application_name : '' }}">
                                    @error('application_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Application Title</label>
                                    <input type="text" name="application_title" class="form-control @error('application_title') is-invalid @enderror" id="inputApplicationtitle" placeholder="Application title" value="{{ (isset($setting[0]->application_title)) ? $setting[0]->application_title : '' }}">
                                    @error('application_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Default Language</label>
                                    <input type="text" name="application_default_language" class="form-control @error('application_default_language') is-invalid @enderror" id="inputApplicationlanguage" placeholder="Application title" value="{{ (isset($setting[0]->application_default_language)) ? $setting[0]->application_default_language : '' }}">
                                    @error('application_default_language')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                
                            </div>
                           
                           
                           
                           <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10 text-right">
                                    <button type="submit" class="btn btn-primary update_setting">Update</button>
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
  <div class="tab-pane" id="email_smtp" role="tabpanel">
  <div class="card">
                   
                   <div class="card-body pt-5">
                   <div class="tab-content edit-profile-main-sec">
                       <div class="tab-pane active" id="settings">
                       <form class="form-horizontal" method="POST" id="smtp_setting" action="" enctype="">
                           @csrf
                           <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                           <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Smtp Email</label>
                                    <input type="text" name="smtp_email" class="form-control @error('smtp_email') is-invalid @enderror" id="inputSmtpemail" placeholder="Smtp Email" value="{{ (isset($setting[0]->smtp_email)) ? $setting[0]->smtp_email : '' }}">
                                    @error('smtp_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Smtp Username</label>
                                    <input type="text" name="smtp_username" class="form-control @error('smtp_username') is-invalid @enderror" id="inputSmtpusername" placeholder="Smtp Username" value="{{ (isset($setting[0]->smtp_username)) ? $setting[0]->smtp_username : '' }}">
                                    @error('smtp_username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Smtp Host</label>
                                    <input type="text" name="smtp_host" class="form-control @error('smtp_host') is-invalid @enderror" id="inputSmtphost" placeholder="Smtp password" value="{{ (isset($setting[0]->smtp_host)) ? $setting[0]->smtp_host : '' }}">
                                    @error('smtp_host')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">

                                    <label for="inputEmail4">Smtp Password</label>
                                    <input type="text" name="smtp_password" class="form-control @error('smtp_password') is-invalid @enderror" id="inputSmtppassword" placeholder="Smtp password" value="{{ (isset($setting[0]->smtp_password)) ? $setting[0]->smtp_password : '' }}">
                                    @error('smtp_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                
                                
                            </div>
                            
                           
                           
                           
                           <div class="form-group row">
                           <div class="offset-sm-2 col-sm-10 text-right">
                               <button type="submit" class="btn btn-primary update_setting">Update</button>
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
  <div class="tab-pane" id="payment_gateway" role="tabpanel"><div class="card">In progress</div></div>
  <div class="tab-pane" id="cron" role="tabpanel"><div class="card">in progress</div></div>
  


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
      $( document ).ready(function() {
        $(document).on("click",".update_setting",function() {
           // 
           var form_id=$(this).closest('form').attr('id');
           var form_data=$('#'+form_id).serialize();
           console.log(form_data);
           $.ajax({
               type:'POST',
               dataType: "json",
               url:'/master-setting-update',
               data:form_data,
               success:function(data) {
                  if(data.status=="success")
                  {
                      alert('Setting updated');
                  }
               }
            });
            return false;
            });
     });
      </script>