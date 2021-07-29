@extends('layouts.app')
<title>Sanad | Add app</title>
@section('content')
    <!-- Main content -->
        <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header p-2">
                    <ul class="nav nav-pills justify-content-start px-3">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Add app</a></li>
                    </ul>
                    </div><!-- /.card-header --> --}}
                    <div class="card-body">
                    <div class="tab-content org-create-table">
                        <div class="tab-pane active" id="settings">
                        <form class="form-horizontal" method="POST" action="{{ !empty($apps) ? route('organisation.app.updatedata') : route('organisation.app.store')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="org_id" value="{{ $org_id}}">
                            @if(!empty($apps) )

                              <input type="hidden" name="id" value="{{ isset($apps[0]['id']) ? $apps[0]['id']: ''}}">
                            @else

                            @endif

                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="display_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">App Title <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" name="title" class="form-control
                                " id="title " placeholder="Enter Title" required="" value="{{ isset($apps[0]['title']) ? $apps[0]['title'] : ''}}">
                            </div>
                        </div>
                          <!-- An unexamined life is not worth living. - Socrates -->




                        <!-- An unexamined life is not worth living. - Socrates -->
                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">App api key <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" name="app_id" class="form-control
                                " id="app_id " placeholder="Enter api key" required="" value="{{ isset($apps[0]['app_id']) ? $apps[0]['app_id'] : ''}}">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">App security token <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" name="app_token" class="form-control
                                " id="app_token " placeholder="Enter token" required="" value="{{ isset($apps[0]['app_token']) ? $apps[0]['app_token'] : ''}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="legal_name" class="col-lg-3 col-md-3 col-sm-3 col-form-label">App Extra Info <span style="color:red;">*</span> </label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <input type="text" name="app_extra_info" class="form-control
                                " id="app_extra_info " placeholder="Enter token" required="" value="{{ isset($apps[0]['app_extra_info']) ? $apps[0]['app_extra_info'] : ''}}">
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
