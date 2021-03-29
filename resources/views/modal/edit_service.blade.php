<div class="modal" id="EditServiceModal">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title">Edit Service</h4>
                <button type="button" class="close modalEditClose" data-dismiss="modal">&times;</button>
            </div>
            
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="editName" type="text" class="form-control" name="name" required>
                    </div>
                </div><br>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitEditServiceModal" style="margin-right: 20px">Save</button>
                <button type="button" class="btn btn-danger modalEditClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>