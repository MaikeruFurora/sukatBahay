<!-- Modal -->
<form id="sectionForm">@csrf
    <div class="modal fade" id="sectionModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="sectionModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="sectionModalTitle"></h6>
             
            </div>
            <div class="modal-body pb-0">
                <input type="hidden" name="id">
                <input type="hidden" name="rule_id" value="{{ $ruleData->id }}">
                <div class="form-group">
                    <label>Section No</label>
                    <input id="" class="form-control" type="number" name="section_no" required placeholder="eg. 1">
                    <label>Section title</label>
                    <input id="" class="form-control" type="text" name="section_title" required placeholder="eg. Section 101 - General Provisions">
                </div>
            </div>
            <div class="modal-footer">
              <button 
              type="button"
              class="btn btn-warning"
              data-dismiss="modal"
              onclick="$('#sectionForm')[0].reset()"
              ><i class="fas fa-times-circle"></i> Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
        </div>
      </div>
</form>
