<!-- Modal -->
<div class="modal fade" id="group_deleted_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Assign Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="group-delete-form">
                <div class="modal-body add-gp-sec">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Group Name</label>
                                <input type="hidden" value="{{$org_id}}" name="org_id">
                                <input type="hidden" id="group-deleted-row" value="" name="rows">
                                <select id="group-select" class="form-control select2bs4 select2" style="width: 100%;" name="groupId">
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
