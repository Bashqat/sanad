@extends('layouts.app')
<title>Contacts</title>
@section('content')

@include('contact.add-tag-modal')
@include('contact.merge-contact-modal')
{{-- Add Group Modal --}}
@include('contact.add-group-modal')
@include('contact.group-modal')

<div class="contact-page-new mb-1">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- <div class="col-lg-12 contact-add-button">
                <a href="{{ route('contact.create',[$org_id]) }}">
                       <button class="btn add-new-contact common-button-site float-right">New Contact <i class="fa fa-plus ml-1"></i> </button>
                     </a>
            </div> -->
            <div class="common-sidebar-sec mb-3">
            @include('contact.sidebar')
            </div>

            <div class="contact-list-sec common-table-scroll contact-filters w-100">
                <div class="inner-new-contact">
                  <div class="card-header p-0">
                      <h3 class="card-title"> All Contacts</h3>
                      <div class="btn-group float-right">
                      <form class="form-inline contact-side-bar-search contact-table-search">
                            <div class="input-group input-group-sm">
                                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                                <div class="input-search-append">
                                    <button class="btn" type="submit">
                                        <!-- <i class="fas fa-search"></i> -->
                                        <img src="/images/site-images/noun_Search_1.svg">
                                    </button>
                                </div>
                            </div>
                     </form>
                        <div class="input-group-prepend">
                            <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <i class="fa fa-list mr-1 p-1"></i> -->
                                <img src="/images/site-images/view.svg">
                                View
                            </button>

                            <div class="dropdown-menu">

                                <a class="toggle-vis dropdown-item" data-column="1"><input type="checkbox">Name</a>
                                <a class="toggle-vis dropdown-item" data-column="2"><input type="checkbox">website</a>
                                  <a class="toggle-vis dropdown-item" data-column="3"><input type="checkbox">email</a>
                                  <a class="toggle-vis dropdown-item" data-column="4"><input type="checkbox">phone</a>
                                  <a class="toggle-vis dropdown-item" data-column="5"><input type="checkbox">Action</a>


                            </div>
                            </div>
                          <div class="input-group-prepend">
                              <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <!-- <i class="fa fa-cog"></i> -->
                                  <img src="/images/site-images/options.svg">
                                  Options
                              </button>

                              <div class="dropdown-menu">
                                  <a class="dropdown-item option" href="javascript:void(0);" data-type="group" data-id="contacts_table">Add to group</a>
                                  <a class="dropdown-item option" href="javascript:void(0);" data-type="tag" data-id="contacts_table">Add Tag</a>
                                  @if(!isset($type))
                                  <a class="dropdown-item option" href="/organisation/{{$org_id}}/contact-merge" data-type="merge" data-id="contacts_table">Merge</a>
                                  @endif
                                  <a class="dropdown-item option" href="/organisation/{{$org_id}}/contact-archive" data-type="archive" data-id="contacts_table">Archive</a>
                                  <form action="{{ route('export.contacts', [$org_id,'all','']) }}" method="GET">
                                      <button type="submit" class="dropdown-item" href="/export-contacts" data-id="contacts_table">Export CSV</button>
                                  </form>
                              </div>



                              </div>
                              <div class="input-group-prepend">


                                  <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <!-- <i class="fa fa-filter mr-1"></i> -->
                                      <img src="/images/site-images/sort-by.svg">
                                      Sort By
                                  </button>
                                  <input type="hidden" class="org_id" name="org_id" value={{$org_id}}>


                                  <div class="dropdown-menu">
                                      <a class="dropdown-item " href="javascript:void(0);" data-type="group" data-id="contacts_table"><input type="checkbox" class="filter" name="filter" value="country">Country</a>
                                      <a class="dropdown-item " href="javascript:void(0);" data-type="tag" data-id="contacts_table"><input type="checkbox" class="filter" name="filter" value="tag">Tag</a>

                                  </div>
                              </div>

                              <a href="{{ route('contact.create',[$org_id]) }}">
                                <button class="btn add-new-contact common-button-site float-right">
                                    <!-- <i class="fa fa-plus"></i> -->
                                    <img src="/images/site-images/pluse.svg">
                                     Add New Contact  </button>
                              </a>

                          </div>
                      </div>
                  </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="contact_table" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                  <th><input type="checkbox" name="checkbox" class="select-all"></th>
                                  <th>Name</th>
                                  <th>First person</th>
                                  <th>Second person</th>
                              <th>Website</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <!-- <th></th> -->
                                  <!-- <th>Tags</th> -->
                                  <th>Action</th>
                              </tr>
                            </thead>

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
