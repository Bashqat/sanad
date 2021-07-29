@extends('layouts.app')
@section('content')
<div class="contact-page-new">
    <div class="container-fluid">
        <div class="row">
            @include('connected-apps.sidebar')
            <div class="col-md-9">
                <div class="inner-new-contact border bg-white">
                    <div class="card-body xero-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">Sync contacts & groups from xero</h5>
                                    <p class="card-text text-danger">Please don't refresh while syncing.</p>
                                    <a href="{{ route('xero.synccontactsfromxero') }}" class="btn btn-primary common-button-site">Sync From Xero</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">Sync contacts & groups to xero</h5>
                                    <p class="card-text text-danger">Please don't refresh while syncing.</p>
                                    <a href="{{ route('xero.synccontactstoxero') }}" class="btn btn-primary common-button-site">Sync To Xero</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
