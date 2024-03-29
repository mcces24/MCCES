

<div class="modal fade" id="academic" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Add New Academic Year</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="add.php">
            
            
            
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label ">Year Start</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="academic_start" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Year End</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="academic_end" required>
                </div>
            </div>
            <div class="mb-3 row">
                
                <div class="col-sm-8">
                    <input type="hidden" name="status" value="0">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
        </form>
      </div>
    </div>
  </div>
</div>