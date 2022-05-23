<!-- Modal -->
<form id="ruleForm">@csrf
    <div class="modal fade" id="ruleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ruleModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="ruleModalTitle"></h6>
             
            </div>
            <div class="modal-body pb-0">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label>Rule No</label>
                    <input id="" class="form-control" type="number" name="rule_no" required placeholder="eg. 1">
                    <label>Rule title</label>
                    <input id="" class="form-control" type="text" name="title" required placeholder="eg. RULE I - General Provisions">
                </div>
            </div>
            <div class="modal-footer">
              <button 
              type="button"
              class="btn btn-warning"
              data-dismiss="modal"
              onclick="$('#ruleForm')[0].reset()"
              ><i class="fas fa-times-circle"></i> Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
        </div>
      </div>
</form>
