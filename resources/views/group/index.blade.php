@extends('layouts.app')
@section('content')

{{-- Add Group Modal --}}
@include('contact.add-group-modal')
{{-- Add Tag Modal --}}
@include('contact.add-tag-modal')

<div class="contact-page-new mb-1">
    @error('title')
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! $message !!}</strong>
    </div>
    @enderror
    @error('parent')
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! $message !!}</strong>
    </div>
    @enderror
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-12 mb-3">
                @include('contact.sidebar')
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12 common-table-scroll contact-filters">
                <div class="inner-new-contact border bg-white">
                    <div class="card-header">
                        <h3 class="card-title">All Groups</h3>
                        <div class="btn-group float-right mr-2">
                            <div class="input-group-prepend">
                                

                                <div class="dropdown">
                                    <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-filter mr-1" aria-hidden="true"></i>Filter
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-sm w-auto dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item group-filter active" href="javascript:void(0)" data-value="active">Active</a>
                                        <a class="dropdown-item group-filter" href="javascript:void(0)" data-value="archive">Archive</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="group_list_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkbox" class="select-all"></th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
{{-- EDIT MODAL --}}
<div class="modal fade" id="edit-group-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script src="{{ url('js/contact.js') }}" defer></script>
@endpush
