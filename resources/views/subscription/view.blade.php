@extends('layouts.app')
<title>Sanad | Subscription Detail</title>
@section('content')
    <!-- Main content -->
        <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header p-2">
                    <ul class="nav nav-pills justify-content-start px-3">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab"> Subscription Detail</a></li>
                    </ul>
                    </div><!-- /.card-header --> --}}
                    <div class="card-body">
                    <div class="tab-content org-create-table">
                        <div class="tab-pane active" id="settings">


                          @if(isset($subscriptions[0]) && !empty($subscriptions[0]))
                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="display_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">User Name </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                              {{ isset($subscriptions[0]->user_detail['name']) ? $subscriptions[0]->user_detail['name'] : ''}}
                            </div>
                        </div>
                          <!-- An unexamined life is not worth living. - Socrates -->




                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Package Name  </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                {{ isset($subscriptions[0]->package['name']) ? $subscriptions[0]->package['name'] : ''}}
                            </div>
                        </div>





                        <div class="form-group row">
                            <label for="type_of_organization" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Price  </label>
                            <div class="col-lg-9 col-md-9  col-sm-9">
                                {{$subscriptions[0]->package_price}}
                            </div>
                        </div>



                            <div class="form-group row">
                                    <label for="type_of_business" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Start Date <span style="color:red;">*</span> </label>
                                    <div class="col-lg-9 col-md-9  col-sm-9">
                                        {{$subscriptions[0]->start_date}}
                                    </div>
                            </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                            <div class="form-group row">
                                <label for="business_registration_number" class="col-lg-3 col-md-3 col-sm-3 col-form-label">End Date </label>
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    {{ isset($subscriptions[0]->end_date) ? $subscriptions[0]->end_date : ''}}
                                </div>
                            </div>



                                    <div class="form-group row">
                                        <label for="location" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Transaction Id <span style="color:red;">*</span> </label>
                                        <div class="col-lg-9 col-md-9  col-sm-9">
                                            {{$subscriptions[0]->payment_transaction_id}}
                                            </div>
                                        </div>



                        <!-- An unexamined life is not worth living. - Socrates -->
                    <div class="form-group row">
                        <label for="address" class="col-lg-3 col-md-3 col-sm-3 col-form-label">Paid via </label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            {{ isset($subscriptions[0]->paid_via) ? $subscriptions[0]->paid_via : ''}}
                        </div>
                    </div>

                    @else
                    <h1 class="text-center">No subscription detail exist</h1>

                    @endif










                        <!-- An unexamined life is not worth living. - Socrates -->













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
