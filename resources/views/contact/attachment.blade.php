<ul class="nav nav-pills" id="pills-tab" role="tablist">
  @php
    $folder = [];
    $count='';
  @endphp
@if(!empty($folderList))
@foreach($folderList as $list)
@php
  $folder[] = $list['id']
@endphp
  <li class="nav-item folder_id_{{$list['id']}}" role="presentation">
      <a class="nav-link folder_name_{{$list['id']}}" id="pills-home-tab"  data-toggle="pill" href="#folder_content_{{$list['id']}}" role="tab" aria-controls="pills-home" aria-selected="true">{{$list['folder_name']}}</a>
  </li>

  @endforeach
  @endif
  <li class="nav-item" role="presentation">
      <a class="nav-link contact_detail_id"  id="add_new_folder" data_contact_id={{$contact_detail_id}} data-toggle="pill" href="pills-contact" data_id={{$contact_id}} role="tab" aria-controls="pills-contact" aria-selected="false"><img class="active-add-folder" src="/images/site-images/active-add-folder.svg"> <img class="add-folder" src="/images/site-images/add-folder.svg"> Add New Folder</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  @if(!empty($folderList))
  @foreach($folderList as $key=>$list)
    <div class="tab-pane fade {{($key==0)?'active show':''}}" id="folder_content_{{$list['id']}}" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="tab-header folder_apend_{{$list['id']}} d-flex justify-content-between align-items-center">
            <h4 class="folder_name_{{$list['id']}}">{{$list['folder_name']}}</h4>
            <input type="hidden" value="{{$list['contact_id']}}" class="contact_id">
            <input type="hidden" value="{{$list['contact_detail_id']}}" class="contact_d_id">
            <input type="hidden" value="{{$list['id']}}" class="folder_id">
            <div class="dropdown attachement-dropdown">
                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/images/site-images/hr-3-dots.svg">
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <div class="triangle-table-dropdown "></div>
                    <a class="dropdown-item rename-folder" folder_id="{{$list['id']}}" href="#">Rename Folder</a>
                    <a class="dropdown-item delete-folder" folder_id="{{$list['id']}}"  href="#">Delete Folder</a>
                    <!-- <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
            </div>
        </div>
        <div class="folder-content">
        @if(!empty($files[$list['id']]))
          @php
          $count=1;
          if($count>1)
          {
            $count=count($files[$list['id']]);
            $count = ceil($count/5);
          }

          
          @endphp
        @foreach($files[$list['id']] as $file)
        <div class="tab-files-detail file_detail_{{$file['id']}} d-flex justify-content-between align-items-center">
            <div class="attached-file">
                <img src="/images/site-images/attached-pdf.svg">
            </div>
            <div class="attached-file-name">
                <p class="file_name_{{$file['id']}}">{{$file['file_name']}}</p>
                @php
                  $created_at = date('d/m/Y ', strtotime($file['created_at']));
                  $created_at_time = date("h:i:sa", strtotime($file['created_at']));
                @endphp
                <span>File Uploaded on - {{$created_at}}-{{$created_at_time}} </span>
            </div>
            <div class="attached-file-options">
                <div class="dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/images/site-images/3-dots-attach-option.svg">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item file_rename" file_id="{{$file['id']}}" file_type="{{$file['file_type']}}"  href="#">Rename</a>
                        <a class="dropdown-item" href="{{$file['file_path']}}" target="_blank" download="{{$file['file_name']}}">Download</a>
                        <a class="dropdown-item move_file" file_id="{{$file['id']}}" contact_id="{{$list['contact_detail_id']}}" href="#">Move file to other folder</a>
                    </div>
                </div>
            </div>
        </div>


        @endforeach
        @endif
      </div>
        <div class="tab-footer  d-flex justify-content-between align-items-center">
          <input type="hidden" name="org_id" class="org_id" value="{{$org_id}}">
            <div class="tab-pagination d-flex align-items-center">
                <a class="pagination pre_{{$list['id']}}" page_no="1" folder_id="{{$list['id']}}"><img src="/images/site-images/page-arrow-left.svg"></a>
                <a class="pagination next_{{$list['id']}}" page_no="2" folder_id="{{$list['id']}}"><img src="/images/site-images/page-arrow-right.svg"></a>
                <p class="mb-0 pagination_count_{{$list['id']}}">1</p>/<p class="mb-0">{{$count}}</p>
            </div>
            <div class="tab-upload-file">
                <button class="btn tab-file-upload-btn d-flex align-items-center upload_attachment" folder_id="{{$list['id']}}" contact_id="{{$list['contact_id']}}" contact_detail_id="{{$list['contact_detail_id']}}">
                    <img src="/images/site-images/attch-upload-file.svg"> Upload File
                </button>
            </div>
        </div>

    </div>
    @endforeach
    @endif
  </div>
    <!------Modal add new folder---------->
    <div class="modal fade folder-attachement-modal" id="new_file_modal" tabindex="-1" role="dialog" aria-labelledby="pinModal" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content enter-pin-sec">
    			<div class="modal-header">
    				<h5 class="modal-title" id="pinModal">Add new file</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<form method="post" class="attachment_file" action="" enctype="multipart/form-data">
    					@csrf
    					<input type="hidden" name="contact_id" class="c_id" value="">
    					<input type="hidden" name="contact_detail_id" class="c_detail_id" value="">
              <input type="hidden" value="" name="folder_id" class="f_id">
    					<div class="form-group">
    				    <label for="folder_name">Folder name</label>
    				    <input type="file" class="form-control"  name="file_name" id="file_name">
    			  </div>
    				<div class="form-group">
    						<button type="button" class="btn tab-file-upload-btn d-flex align-items-center" id="add_file" >Add</button>
    					</div>
    				</form>

    			</div>
    		</div>
    	</div>
    </div>
    <!---------->

    <!------Modal for rename folder---------->
    <div class="modal fade  rename-attachement-modal folder-attachement-modal" id="rename_folder" tabindex="-1" role="dialog" aria-labelledby="pinModal" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
          <div class="header-submenu-triangle"></div>
    			<div class="modal-header align-items-center">
    				<h5 class="modal-title" id="pinModal">Rename folder</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<form method="post" id="form-rename-folder" action="">
    					@csrf
    					<input type="hidden" name="folder_id" value="" class="rename_folder_id">


    					<div class="form-group">
    				    <label for="folder_name">New name</label>
    				    <input type="text" class="form-control"  name="folder_name" id="folder_name" placeholder="Folder Name">
    			  </div>
    				<div class="form-group">
    						<button type="click" class="btn tab-file-upload-btn d-flex align-items-center" id="update_folder_name" >Update</button>
    					</div>
    				</form>

    			</div>
    		</div>
    	</div>
    </div>

       <!------Modal for delete folder---------->
       <div class="modal fade  delete-attachement-modal folder-attachement-modal" id="delete_folder" tabindex="-1" role="dialog" aria-labelledby="pinModal" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
          <div class="modal-header">
    				<h5 class="modal-title" id="pinModal">Delete folder</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<form method="post" id="form-rename-folder" action="">
              <p class="form-group">To able to delete folder,Kindli remove all the files either by deleting or move to other folder</p>


    				</form>

    			</div>
    		</div>
    	</div>
    </div>
    <!------Modal for rename file---------->
    <div class="modal fade  rename-attachement-modal  folder-attachement-modal" id="rename_file" tabindex="-1" role="dialog" aria-labelledby="pinModal" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header align-items-center">
    				<h5 class="modal-title" id="pinModal">Rename file</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<form method="post" id="form-rename-file" action="">
    					@csrf
    					<input type="hidden" name="file_id" value="" class="rename_file_id">
              <input type="hidden" name="file_type" value="" class="rename_file_type">


    					<div class="form-group">
    				    <label for="folder_name">New name</label>
    				    <input type="text" class="form-control"  name="file_name" id="file_name" placeholder="File Name">
    			  </div>
    				<div class="form-group">
    						<button type="click" class="btn tab-file-upload-btn d-flex align-items-center" id="update_file_name" >Update</button>
    					</div>
    				</form>

    			</div>
    		</div>
    	</div>
    </div>
    <!------Modal for move file to other---------->
    <div class="modal fade  rename-attachement-modal folder-attachement-modal" id="move_file_modal" tabindex="-1" role="dialog" aria-labelledby="pinModal" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header align-items-center">
    				<h5 class="modal-title" id="pinModal">Move file</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<form method="post" id="form-move-file" action="">
    					@csrf
              <input type="hidden" name="contact_id" value="" class="move_contact_id">
    					<input type="hidden" name="file_id" value="" class="move_file_id">

    				<div class="form-group">
    						<button type="click" class="btn tab-file-upload-btn d-flex align-items-center" id="update-parent-folder" >Move</button>
    					</div>
    				</form>

    			</div>
    		</div>
    	</div>
    </div>

@if(!empty($folderList))
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">third</div>
</div>
@endif
