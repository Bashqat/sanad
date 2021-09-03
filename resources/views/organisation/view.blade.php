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
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab"> Organization Detail</a></li>
                    </ul>
                    </div><!-- /.card-header --> --}}
                    <div class="card-body">
                    <div class="tab-content org-create-table">
                        <div class="tab-pane active" id="settings">


                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="display_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Organisation Name <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                              {{ isset($organisation_data[0]->display_name) ? $organisation_data[0]->display_name : ''}}
                            </div>
                        </div>
                          <!-- An unexamined life is not worth living. - Socrates -->




                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Legal Name <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                {{ isset($organisation_data[0]->legal_name) ? $organisation_data[0]->legal_name : ''}}
                            </div>
                        </div>





                        <div class="form-group row">
                            <label for="type_of_organization" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Type of Organization <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9  col-sm-9">
                                {{$organisation_data[0]->type_of_organization}}
                            </div>
                        </div>



                            <div class="form-group row">
                                    <label for="type_of_business" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Type of Business <span style="color:red;">*</span> </label>
                                    <div class="col-lg-9 col-md-9  col-sm-9">
                                        {{$organisation_data[0]->type_of_business}}
                                    </div>
                            </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                            <div class="form-group row">
                                <label for="business_registration_number" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Business Registration Number </label>
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    {{ isset($organisation_data[0]->business_registration_number) ? $organisation_data[0]->business_registration_number : ''}}
                                </div>
                            </div>



                                    <div class="form-group row">
                                        <label for="location" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Location <span style="color:red;">*</span> </label>
                                        <div class="col-lg-9 col-md-9  col-sm-9">
                                            {{$organisation_data[0]->location}}
                                            </div>
                                        </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                    <div class="form-group row">
                        <label for="address" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Address </label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            
                        </div>
                    </div>






                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="phone" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Phone </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        {{ isset($organisation_data[0]->phone) ? $organisation_data[0]->phone : ''}}
                    </div>
                </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="fax" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Fax </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        {{ isset($organisation_data[0]->fax) ? $organisation_data[0]->fax : ''}}
                    </div>
                </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
            <div class="form-group row">
                <label for="mobile" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Mobile </label>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    {{ isset($organisation_data[0]->mobile) ? $organisation_data[0]->mobile : ''}}
                </div>
            </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                <div class="form-group row">
                    <label for="website" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Website </label>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        {{ isset($organisation_data[0]->website) ? $organisation_data[0]->website : ''}}
                    </div>
                </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
            <div class="form-group row">
                <label for="email" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Email </label>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    {{ isset($organisation_data[0]->email) ? $organisation_data[0]->email : ''}}
                </div>
            </div>



                        <div class="form-group row">
                            <label for="currency" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Currency <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9  col-sm-9">
                                {{ isset($organisation_data[0]->currency) ? $organisation_data[0]->currency : ''}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currency" class="col-lg-3 col-md-3 col-sm-3 col-form-label">No of Invited User <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9  col-sm-9">
                                {{ isset($invite_user) ? $invite_user : 0}}
                            </div>
                        </div>








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
