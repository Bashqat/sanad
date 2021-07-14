@extends('layouts.app')
@section('content')


<div class="contact-page-new mb-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 contact-add-button">
                <a href="{{ route('contact.create',[$org_id]) }}">
                       <button class="btn add-new-contact common-button-site float-right">New Contact <i class="fa fa-plus ml-1"></i> </button>
                     </a>
            </div>
            <div class=" col-lg-2 col-md-3 col-sm-12 mb-3">
            @include('contact.sidebar')
            </div>
            <div class="col-lg-10 col-md-9 col-sm-12 common-table-scroll contact-filters">
                <div class="inner-new-contact border bg-white">
                    <div class="card-header">
                        <h3 class="card-title"> All Contacts</h3>
                        <div class="btn-group float-right mr-2">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-list mr-1 p-1"></i>View</button>
                                <div class="dropdown-menu" aria-labelledby="custom-menu">
                                    <a class="dropdown-item" href="#">Check columns list view</a>
                                </div>
                            </div>
                            <div class="input-group-prepend">
                                <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i>
                                    Options
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item option" href="javascript:void(0);" data-type="group" data-id="contacts_table">Add to group</a>
                                    <a class="dropdown-item option" href="javascript:void(0);" data-type="tag" data-id="contacts_table">Add Tag</a>
                                    <a class="dropdown-item option" href="/contact-merge" data-type="merge" data-id="contacts_table">Merge</a>
                                    <a class="dropdown-item option" href="/contact-archive" data-type="archive" data-id="contacts_table">Archive</a>
                                    <form action="" method="GET">
                                        <button type="submit" class="dropdown-item" href="/export-contacts" data-id="contacts_table">Export CSV</button>
                                    </form>
                                </div>
                                <span class="contact-filter d-flex align-items-center"><i class="fa fa-filter mr-1" aria-hidden="true"></i>Filter</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="contacts_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkbox" class="select-all"></th>
                                    <th>Name</th>
                                    <th>Website</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                    <th>Tags</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($contacts))
                                @foreach($contacts as $contact)
                                <tr class="odd">
                                    <td class="sorting_1"><input type="checkbox" class="row-select" value="1"></td>
                                    <td>
                                        <a href="http://127.0.0.1:8001/contact/1">
                                            <div>
                                                <div>{{$contact->name}}</div>
                                                
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <i class="fa fa-globe mr-1" aria-hidden="true"></i><a href="{{$contact->website}}">{{$contact->website}}</a>
                                    </td>
                                    <td>
                                        <i class="fa fa-at mr-1" aria-hidden="true"></i><a href="mailto:sdasd@gmail.com">{{$contact->email}}</a>
                                    </td>
                                    <td>
                                        <i class="fas fa-phone-alt mr-1" aria-hidden="true"></i>{{$contact->website}}
                                    </td>
                                    <td>
                                        <button class="attachment-view-btn d-flex align-items-center" data-toggle="modal" data-target="#attachment-view" data-files="[&quot;images\/contacts\/MIkBawUPoC5j4h0.jpg&quot;]" data-file-type="contact" data-id="1">
                                            <i class="far fa-file-alt"></i>1
                                        </button>
                                    </td>
                                    <td></td>
                            <td>
                                    <div class="dropdown">
                                    <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);"><a href="http://127.0.0.1:8001/contact/1/edit" class="dropdown-item">Edit</a>
                                    <form class="inline-block" action="http://127.0.0.1:8001/contact/1" method="POST" onsubmit="return confirm(`Are you sure?`);">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="C8kQOIRxu5CJMwvLVx7aZZApNzML2DCJz8mrgWqS">
                                        <input type="submit" class="dropdown-item" value="Delete">
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    @endforeach
                    @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal-ATTACHMENT-VIEW -->
<div class="modal fade" id="attachment-view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Attachment View</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body py-5" id="attachment-view-modal">
			</div>
			<div class="modal-footer">
				<div class="upload">
					<ul>
						<li><a href="javascript:void(0)" class="upload-attachment"><i class="fas fa-cloud-upload-alt mr-1"></i>Upload</a></li>
						<li><a href="#" class="download-attachment"><i class="fas fa-download mr-1"></i>Download</a></li>
					</ul>
                    <form method="POST" action="" enctype="multipart/form-data" id="attachmentUploadForm">
                        @csrf
                        <input type="hidden" name="id" id="attachmentUploadId">
                        <input type="hidden" name="uploadType" id="attachmentUploadType">
                        <input type="file" name="files[]" id="uploadFiles" style="display: none;" multiple>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@push('scripts')
    <script src="{{ url('js/contact.js') }}" defer></script>
@endpush
