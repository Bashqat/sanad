<!-- Modal -->
<div class="modal fade" id="contact-merge-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Select Contact To Merge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="contact-merge-form" method="POST" action="{{ route('contactToMerge', [$org_id]) }}">
                @csrf
                <div class="modal-body add-gp-sec">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="hidden" id="merge-selected-row" value="" name="rows">
                                <select id="contact-select-merge" class="form-control select2bs4 select2" style="width: 100%;" name="mergeContactId" required>
                                    <option value="">Select Contact</option>
                                    @foreach ($contacts as $key => $contact)
                                        <option value="{{ $key }}">{{ $contact }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
