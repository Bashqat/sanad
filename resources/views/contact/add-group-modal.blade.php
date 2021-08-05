<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
       <div class="modal-content">
          <form method="POST" action="{{ route('organisation.group.create') }}">
             @csrf
             <div class="modal-header">
                <h4 class="modal-title">Add Group</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body add-gp-sec">
                 <div class="form-group">
                     <label for="group-name" class="col-form-label">Group Name:</label>
                     <input type="text" name="title" class="form-control" id="group-name" required>
                     <input type="hidden" name="org_id" value="{{$org_id}}">
                 </div>

                 @if(!empty($groups[0]))
                 <div class="form-group">
                     <label for="group-parent" class="col-form-label">Select Parent:</label>
                     <select id="group-parent" name="parent" class="form-control select2bs4 select2 select-input-field" style="width: 100%;">
                         <option value="">Select Group Parent</option>
                         @foreach ($groups as $group)
                             <option value="{{ $group->id }}">{{ $group->title }}</option>
                         @endforeach
                     </select>
                 </div>
                 @endif
             </div>
             <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
             </div>
          </form>
       </div>
       <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
 </div>
