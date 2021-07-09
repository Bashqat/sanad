@extends('layouts.app')

@section('content')
    <!-- Main content -->
        <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Edit Organization</a></li>
                    </ul>
                    </div><!-- /.card-header --> --}}
                    <div class="card-body">
                    <div class="tab-content org-create-table">
                        <div class="tab-pane active" id="settings">
                            {{-- {{ dd($organization) }} --}}
                            <x-forms.form type="Update information" method="put" action="{{ route('organization.update', $organization->id) }}" :inputs="$organizationFields" :values="$organization"/>
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
