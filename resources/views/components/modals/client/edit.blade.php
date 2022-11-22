<form id="editForm">
      <div class="modal" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ubah Client</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="createName">Nama</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="createEmail">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="createEmail">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="createEmail">Place Birth</label>
                            <input type="text" class="form-control" id="placebirth" name="placebirth">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="createEmail">Date Birth</label>
                            <input type="date" class="form-control" id="datebirth" name="datebirth">
                        </div>
                    </div>

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
