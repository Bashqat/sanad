<div class="modal fade" id="add-tag-modal">
    <div class="modal-dialog">
       <div class="modal-content">
          <form id="tag-form">
             <div class="modal-header">
                <h4 class="modal-title">Add Tag</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
             </div>
             <div class="modal-body add-gp-sec">
                <div class="form-tag">
                   <label for="tag-name" class="col-form-label">Tag Name:</label>
                   <input type="hidden" name="rows" id="tag-selected-row" value="">
                   <input type="text" name="tag" class="form-control" id="tag-name" >
                </div>
             </div>
             <input type="hidden" name="org_id" value="{{$org_id}}">
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
