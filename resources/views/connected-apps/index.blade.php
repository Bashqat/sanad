@extends('layouts.app')
<title>Sanad | Add app</title>
@section('content')
<div class="contact-page-new">
    <div class="container-fluid">
        <div class="row">

          		<div class="card-header">
          			<a class="float-right btn btn-primary common-button-site" href="{{ route('organisation.app.create',$org_id) }}">Add New App <i class="fa fa-plus ml-1"></i></a>
          		</div>
            <div class="col-md-12">
                <div class="inner-new-contact border bg-white">
                    <div class="card-body">
                        <div class="tabel-scroll-sec">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Application</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apps as $app )
                                        <tr>
                                            <td>
                                                @if ($app->logo)
                                                    <img src="{{ $app->logo }}" class="img-fluid img-thumbnail" width="80px">
                                                @endif
                                                {{ $app->title }}
                                            </td>
                                            <td>
                                                @if ($app->status == "disconnected")
                                                <form action="{{ route('organisation.app.update') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="org_id" value="{{$org_id}}">
                                                    <input type="hidden" name="id" value="{{(isset
                                                    ($app->id))?$app->id:''}}">
                                                    <input type="hidden" name="status" value="connected">
                                                    <button type="submit" class="btn btn-success">Connect</button>
                                                </form>
                                                @elseif ($app->status == "connected")
                                                    <button type="button" class="btn btn-secondary disabled" role="button" aria-disabled="true">Connected</button>
                                                    <form method="POST" action="{{ route('xero.updateOrganization') }}" id="updateOrganizationForm">
                                                        @csrf

                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($app->status == "connected")
                                                <div class="dropdown">
                                                    <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">
                                                        <!-- <a href="{{ route('xero.options') }}" class="dropdown-item">Options</a> -->
                                                        <form action="{{ route('organisation.app.update') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="org_id" value="{{$org_id}}">
                                                            <input type="hidden" name="id" value="{{(isset
                                                            ($app->id))?$app->id:''}}">
                                                            @if ($app->status == "disconnected")
                                                                <input type="hidden" name="status" value="connected">
                                                            @elseif ($app->status == "connected")
                                                                <input type="hidden" name="status" value="disconnected">
                                                            @endif
                                                            <button type="submit" class="dropdown-item">
                                                                {{ ( $app->status == "disconnected") ? "Connect": "Disconnect" }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                              <div class="dropdown">
                      														<!--Trigger-->
                      														<a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
                      														<!--Menu-->

                                                        <div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">
                                                          <a href="{{ route('organisation.app.edit', [$org_id,$app->id]) }}" class="dropdown-item">Edit</a>
                                                          <form class="inline-block" action="{{ route('organisation.app.delete')}}" method="POST" onsubmit="return confirm('Are you sure?');">
                        																			<input type="hidden" name="org_id" value="{{$org_id}}">
                                                              <input type="hidden" name="id" value="{{$app->id}}">

                        																			<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        																			<input type="submit" class="dropdown-item" value="Delete">
                        																	</form>
                                                        </div>

                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
