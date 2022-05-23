<!-- Modal -->
<form id="contentForm">@csrf
    <div class="modal fade" id="contentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="contentModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="contentModalTitle"></h6>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id">
                <input type="hidden" name="section_id" value="{{ $sectionData->id }}">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="">1977</label>
                        <textarea class="summernote" id="summernote1" name="comparison_one"></textarea>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="">2004</label>
                        <textarea class="summernote" id="summernote2" name="comparison_two"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button 
              type="button"
              class="btn btn-warning"
              data-dismiss="modal"
              onclick="$('#contentForm')[0].reset()"
              ><i class="fas fa-times-circle"></i> Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
        </div>
      </div>
</form>
