@extends('layouts.contact_layout')
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
            <div class="common-sidebar-sec">
            @include('contact.sidebar')
            </div>

              <div class="contact-list-sec common-table-scroll contact-filters w-100 @if ( $errors->any() || Session::get('info') || Session::get('success') || Session::get('warning') )alert-position @endif">
            @include('flash-message')

                @include('contact.contact_filter')
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="contact_table" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                  <th>
                                    <!-- <input type="checkbox" name="checkbox" class="select-all"> -->
                                  </th>
                                  <th>Contact name</th>
                                  <th>First person</th>
                                  <th>Second person</th>
                                  <th>Country</th>
                                  <!-- <th>Email</th>
                                  <th>Phone</th> -->
                                  <!-- <th></th> -->
                                   <th>Tags</th>
                                   <th>Attachment</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($contacts as $contact)
                                <tr>
                                  <td><input type="checkbox" class="row-select" value="{{ $contact->id }}"></td>
                                  <td>
                                    <div class="contact-name-col"><a class="text-right d-block" href="/organisation/{{$org_id}}/contact/{{$contact->id}}/view">{{$contact->name}}</a>
                                  <p class="text-right">{{$contact->name_arabic}}</p></div>
                                </td>
                                   @php
                                   $first_person="";
                                   $first_person_html="";
                                   if(isset($contact->contact_information) && count($contact->contact_information)>0 && $contact->contact_information[0]->first_name!="" )
                                    {
                                      $first_person=$contact->contact_information[0]->first_name;
                                      $first_person_html='<div class="contact-list-person d-flex align-items-center">
                                        <p>'.$first_person.'</p>
                                        <img src="/images/site-images/contact-email-data.svg"><img src="/images/site-images/contact-phone-data.svg">
                                        <img src="/images/site-images/contact-wtap-data.svg">
                                      </div>';
                                    }
                                    echo '<td>'.$first_person_html.'</td>';
                                    $second_person='';
                                    $second_person_html='';
                                    if(isset($contact->contact_information) && count($contact->contact_information)>1 && $contact->contact_information[1]->first_name!="" )
                                    {
                                       $second_person=$contact->contact_information[1]->first_name;
                                       $second_person_html='<div class="contact-list-person d-flex align-items-center"><p>'.$second_person.'</p><img src="/images/site-images/contact-email-data.svg"><img src="/images/site-images/contact-phone-data.svg"><img src="/images/site-images/contact-wtap-data.svg"></div>';

                                     }
                                     echo '<td>'.$second_person_html.'</td>';
                                  @endphp
                                  <td>
                                    {{(isset($contact->address[0]['country'])?$contact->address[0]['country']:'')}}
                                  </td>
                                  @php
                                  $tags=$contact->tags;
                                  $tag_html='';
                                  if(!empty($tags))
                                  {
                                    foreach($tags as $key=>$tag )
                                    {
                                      if($key<'3')
                                      {
                                        $tag_html.='<div class="tab-buttons">
                                        <button type="button" data-tag-name="test" data-tag-index="0" class="btn btn-success edit-tag">'.$tag.'</button>
                                        </div>';
                                      }

                                    }

                                  }
                                  echo '<td>'.$tag_html.'</td>';
                                  $attachment_count=(isset($contact->attachment) && !empty($contact->attachment))?count($contact->attachment):'';
                                  $edit_path=route('contacts.edit',[$org_id,$contact->id]);
                                  $delete_path=route('contact.delete');
                                  @endphp
                                  <td>
                                    <a class="attachment-view-btn d-flex align-items-center" data-files='.json_encode($contact->attachment).' data-toggle="modal" data-target="#attachment-view" data-file-type="contact" data-id="'.$contact->id.'">
                                      <img src="/images/site-images/doc-attch.svg">{{$attachment_count}}
                                    </a>
                                  </td>
                                  <td>
                                    <div class="dropdown">
                                          <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="/images/site-images/3-dots-contact-list.svg" style="width:100%"></a>
                                          <div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);"><a href="{{$edit_path}}" class="dropdown-item">Edit</a>
                                          <form class="inline-block" action="{{$delete_path}}" method="POST" onsubmit="return confirm(`Are you sure?`);">

                                              <input type="hidden" name="org_id" value="{{$org_id}}">
                                              <input type="hidden" name="id" value=""{{$contact->id}}">
                                              @csrf
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
                    <form method="POST" action="{{route('contact.attachment',$org_id)}}" enctype="multipart/form-data" id="attachmentUploadForm">
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
