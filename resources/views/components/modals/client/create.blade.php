<form id="createForm">
      <div class="modal" tabindex="-1" role="dialog" id="createModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Client</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="createName">Nama</label>
                    <input type="text" class="form-control" id="createName" name="name">
                </div>
                <div class="form-group">
                    <label for="createEmail">Email</label>
                    <input type="text" class="form-control" id="createEmail" name="email">
                </div>
                <div class="form-group">
                    <label for="createEmail">Phone</label>
                    <input type="text" class="form-control" id="createPhone" name="phone">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="placeBirth">Place Birth:</label>
                        <input required="" type="text" name="placeBirth" id="placeBirth" class="form-control">
                      </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                          <label for="dateBirth">Date Birth:</label>
                          <input required="" type="date" name="dateBirth" id="dateBirth" class="form-control">
                        </div>
                    </div>

                </div>
               
                <div class="form-group">
                    <label for="cover">Photo</label>
                    <input type="file" id="cover" name='cover' class="form-control-file" required data-allowed-file-extensions="jpg png" data-max-file-size-preview="3M">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createSubmit">Save changes</button>
            </div>
          </div>
        </div>
      </div>
</form>
