<form id="editForm">
      <div class="modal" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ubah Payment Methode</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="createName">Payment Methode</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="coverEdit">Photo</label>
                    <input type="file" id="coverEdit" name='coverEdit' class="form-control-file" required data-allowed-file-extensions="jpg png" data-max-file-size-preview="3M">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editSubmit">Save changes</button>
            </div>
          </div>
        </div>
      </div>
</form>
