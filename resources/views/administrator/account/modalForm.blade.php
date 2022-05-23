<!-- Modal -->
<form id="reviseYearForm">@csrf
    <div class="modal fade" id="reviseYearModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="reviseYearTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="reviseYearModalTitle"></h6>
            </div>
            <div class="modal-body pb-0">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label>Year</label>
                    <input class="form-control" type="number" name="year" required placeholder="eg. 2022">
               </div>
            </div>
            <div class="modal-footer">
              <button 
              type="button"
              class="btn btn-warning"
              data-dismiss="modal"
              onclick="$('#reviseYearForm')[0].reset()"
              ><i class="fas fa-times-circle"></i> Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
        </div>
      </div>
</form>
