@extends('layouts.contact_layout')
<title>Contacts</title>
@section('content')



<div class="contact-page-new mb-1">
    <div class="container-fluid">
        <div class="row flex-nowrap">

            <div class="common-sidebar-sec mb-3">
            @include('contact.sidebar')
            </div>

            <div class="contact-list-sec common-table-scroll contact-filters w-100">
                @include('contact.contact_filter')
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="contacts_archive_table" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                  
                                  <th>Contact name</th>
                                  <th>First person</th>
                                  <th>Second person</th>
                                  <th>Country</th>
                                  <!-- <th>Email</th>
                                  <th>Phone</th> -->
                                  <!-- <th></th> -->

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
