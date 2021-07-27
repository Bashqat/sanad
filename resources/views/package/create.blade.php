@extends('layouts.app')
<title>Sanad | Add package</title>
@section('content')
    <!-- Main content -->
        <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header p-2">
                    <ul class="nav nav-pills justify-content-start px-3">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Add Package</a></li>
                    </ul>
                    </div><!-- /.card-header --> --}}
                    <div class="card-body">
                    <div class="tab-content org-create-table">
                        <div class="tab-pane active" id="settings">
                        <form class="form-horizontal" method="POST" action="{{ !empty($package_data) ? route('package.update') : route('package.store')}}">
                            @csrf

                            @if(!empty($package_data) )
                              <input type="hidden" name="package_id" value="{{ isset($package_data[0]->id) ? $package_data[0]->id : ''}}">
                            @endif

                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Package Name <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" name="name" class="form-control
                                " id="package_name " placeholder="Enter Package Name" required="" value="{{ isset($package_data[0]->name) ? $package_data[0]->name : ''}}">
                            </div>
                        </div>
                          <!-- An unexamined life is not worth living. - Socrates -->




                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Price <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="number" step="any"  name="price" class="form-control
                                " id="price " placeholder="Enter price" required="" value="{{ isset($package_data[0]->price) ? $package_data[0]->price : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="storage_per_org" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Number Of Organisation Limit <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="number" name="storage_per_org" class="form-control
                                " id="storage_per_org " placeholder="Enter number of organisation" required="" value="{{ isset($package_data[0]->storage_per_org) ? $package_data[0]->storage_per_org : ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Number of invitation user Limit<span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="number" name="invite_user_count" class="form-control
                                " id="invite_user_count " placeholder="Enter user count" required="" value="{{ isset($package_data[0]->invite_user_count) ? $package_data[0]->invite_user_count : ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact_count" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Number of Contact Limit <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="number" name="contact_count" class="form-control
                                " id="invite_user_count " placeholder="Enter number of contact" required="" value="{{ isset($package_data[0]->invite_user_count) ? $package_data[0]->invite_user_count : ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Third Party Api  </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                              <select data-placeholder="Select" name="third_party_api[]" multiple class="chosen-select" tabindex="8">
                                <option value=""></option>
                                <option>Xero</option>


                              </select>
                            </div>
                        </div>




                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10 text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>

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
