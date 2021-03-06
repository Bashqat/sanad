@extends('layouts.app')
<title>Add organisation</title>
@section('content')
    <!-- Main content -->
        <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card org-create-table">
                    {{-- <div class="card-header p-2">
                    <ul class="nav nav-pills justify-content-start px-3">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Add Organisation</a></li>
                    </ul>
                    </div><!-- /.card-header --> --}}
                    <div class="card-body">
                    <div class="tab-content">
                      <img class="loader" style="display:none" src="/images/loader.gif">
                        <div class="tab-pane active" id="settings">
                        <form class="form-horizontal" id="org_new" method="POST" action="{{ !empty($organisation_data) ? route('org_update') : route('org_store')}}" enctype="multipart/form-data">
                            @csrf

                            @if(!empty($organisation_data) )
                              <input type="hidden" name="org_id" value="{{ isset($organisation_data[0]->org_id) ? $organisation_data[0]->org_id : ''}}">
                              <input type="hidden" name="id" value="{{ isset($organisation_data[0]->id) ? $organisation_data[0]->id : ''}}">
                            @else

                            @endif

                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="display_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Name <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" name="display_name" class="form-control
                                " id="display_name " placeholder="Enter Organisation Name" required="" value="{{ isset($organisation_data[0]->display_name) ? $organisation_data[0]->display_name : ''}}">
                            </div>
                        </div>
                          <!-- An unexamined life is not worth living. - Socrates -->




                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Legal Name <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" name="legal_name" class="form-control
                                " id="legal_name " placeholder="Enter Legal Name" required="" value="{{ isset($organisation_data[0]->legal_name) ? $organisation_data[0]->legal_name : ''}}">
                            </div>
                        </div>



                        <!-- An unexamined life is not worth living. - Socrates -->

                    <div class="form-group row">
                        <label for="logo" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Logo </label>
                        <div class="col-lg-9 col-md-9 col-sm-9 input-group">
                          @if(isset($organisation_data[0]->logo) && $organisation_data[0]->logo!="")
      											<div class="thumb_img">
                            		<img src="{{ url('/organisation_logo') }}/{{ isset($organisation_data[0]->logo)?$organisation_data[0]->logo:'' }}" class="img-thumbnail" placeholder="Image not found">
                            </div>
      											@endif
                            <div class="custom-file">
                                <input type="file" name="logo" class="form-control custom-file-input  "  id="logoFile" accept="image/*" >
                                <label class="custom-file-label" for="logoFile">Choose file</label>
                            </div>
                        </div>
                    </div>



                        <div class="form-group row">
                            <label for="type_of_Organisation" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Type of Organisation <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9  col-sm-9">
                                <select name="type_of_Organisation" class="form-control select2  " style="width: 100%;" required="">

                                <option value="">Select </option>
                                    @foreach($organisationType as $key=>$val)
                                      <option value="{{$key}}" {{ (isset($organisation_data[0]->type_of_Organisation) && $key==$organisation_data[0]->type_of_Organisation)?'selected':''}}>{{$val}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>



                            <div class="form-group row">
                                    <label for="type_of_business" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Type of Business <span style="color:red;">*</span> </label>
                                    <div class="col-lg-9 col-md-9  col-sm-9">
                                        <select name="type_of_business" class="form-control select2  " style="width: 100%;" required="">
                                            <option value="">Select </option>

                                            @foreach($busType as $buskey=>$busval)
                                                <option value="{{$buskey}}" {{ (isset($organisation_data[0]->type_of_business) && $buskey==$organisation_data[0]->type_of_business)?'selected':''}}>{{$busval}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                            </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                            <div class="form-group row">
                                <label for="business_registration_number" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Business Registration Number </label>
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <input type="text" name="business_registration_number" class="form-control
                                    " id="business_registration_number " placeholder="Enter Business Registration Number" value="{{ isset($organisation_data[0]->business_registration_number) ? $organisation_data[0]->business_registration_number : ''}}">
                                </div>
                            </div>



                                    <div class="form-group row">
                                        <label for="location" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Location <span style="color:red;">*</span> </label>
                                        <div class="col-lg-9 col-md-9  col-sm-9">
                                            <select name="location" class="form-control select2  " style="width: 100%;" required="">

                                                    <option value="">Select </option>
                                                    @foreach($countries as $cntkey=>$cntval)
                                                        <option value="{{$cntkey}}" {{ (isset($organisation_data[0]->location) && $cntkey==$organisation_data[0]->location)?'selected':''}}>{{$cntval}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                    <div class="form-group row contact-row">
                        <label for="address" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Address </label>

                        <div class="col-lg-9 col-md-9 col-sm-9 contact-address-fields">
                            <input type="text" name="address[address1]" class="form-control
                            " id="address1" placeholder="Address" value="{{ isset($organisation_data[0]->address['address1']) ? $organisation_data[0]->address['address1'] : ''}}">
                            <input type="text" name="address[address2]" class="form-control
                            " id="address " placeholder="Address" value="{{ isset($organisation_data[0]->address['address2']) ? $organisation_data[0]->address['address2'] : ''}}">
                            <div class="address-city-post-code">
                                <input type="text" name="address[city]" class="form-control" placeholder="City" value="{{ isset($organisation_data[0]->address['city']) ? $organisation_data[0]->address['city'] : ''}}">
                                <input type="text" name="address[region]" class="form-control" placeholder="Region" value="{{ isset($organisation_data[0]->address['region']) ? $organisation_data[0]->address['region'] : ''}}">
                            </div>
                            <div class="address-city-post-code">
                              <input type="text" name="address[zip_code]" class="form-control" placeholder="Zipcode" value="{{ isset($organisation_data[0]->address['zip_code']) ? $organisation_data[0]->address['zip_code'] : ''}}">
                              <input type="text" name="address[po_box]" class="form-control" placeholder="Po box" value="{{ isset($organisation_data[0]->address['po_box']) ? $organisation_data[0]->address['po_box'] : ''}}">
                            </div>
                        </div>

                    </div>


                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="phone" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Phone </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="phone" class="form-control
                        " id="phone " placeholder="Enter Phone" value="{{ isset($organisation_data[0]->phone) ? $organisation_data[0]->phone : ''}}">
                    </div>
                </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="fax" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Fax </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="fax" class="form-control
                        " id="fax " placeholder="Enter Fax" value="{{ isset($organisation_data[0]->fax) ? $organisation_data[0]->fax : ''}}">
                    </div>
                </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
            <div class="form-group row">
                <label for="mobile" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Mobile </label>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <input type="text" name="mobile" class="form-control
                    " id="mobile " placeholder="Enter Mobile" value="{{ isset($organisation_data[0]->mobile) ? $organisation_data[0]->mobile : ''}}">
                </div>
            </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="website" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Website </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="website" class="form-control
                        " id="website " placeholder="Enter Website" value="{{ isset($organisation_data[0]->website) ? $organisation_data[0]->website : ''}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fax" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Tax Registration Number <span style="color:red;">*</span></label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="tax_reg_number" class="form-control
                        " id="fax " placeholder="Enter Tax Registration Number" value="{{ isset($organisation_data[0]->tax_reg_number) ? $organisation_data[0]->tax_reg_number : ''}}" required>
                    </div>
                </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
            <div class="form-group row">
                <label for="email" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Email </label>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <input type="text" name="email" class="form-control
                    " id="email " placeholder="Enter Email" value="{{ isset($organisation_data[0]->email) ? $organisation_data[0]->email : ''}}">
                </div>
            </div>



                        <div class="form-group row">
                            <label for="currency" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Currency <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9  col-sm-9">
                                <select name="currency" class="form-control select2  " style="width: 100%;" required="">
                                    <option value="">Select </option>
                                    @foreach($currency as $cur)
                                    <option value="{{$cur}}" {{(isset($organisation_data) && $organisation_data[0]->currency==$cur)?'selected':''}}>{{$cur}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="user_defined" class="col-lg-3 col-md-3 col-sm-3 col-form-label">User Defined </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <input type="text" name="user_defined" class="form-control
                        " id="user_defined " placeholder="Enter User Defined" value="{{ isset($organisation_data[0]->user_defined) ? $organisation_data[0]->user_defined : ''}}">
                    </div>
                </div>


                        <div class="form-footer">
                            <div class="form-group row mb-0">
                                <!-- <div class="row"> -->
                                     <div class="col-6 text-left p-0">
                                        <a href="{{ URL::previous() }}" class="btn org_cancle btn-cancle">Cancel</a>
                                    </div>
                                    <div class="col-6 text-right p-0">
                                        <button type="submit" class="btn btn-primary org_submit">Submit</button>
                                    </div>
                               <!--  </div> -->
                            </div>
                        </div>
                        </form>
                </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection
@push('scripts')

 <!-- <script src="{{ url('js/organisation.js') }}" defer></script> -->
@endpush
