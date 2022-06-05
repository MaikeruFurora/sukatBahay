<!-- Modal -->
<form id="contentForm">@csrf
    <div class="modal fade" id="contentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="contentModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="contentModalTitle"></h6>
            </div>
            <div class="modal-body pb-0">
              <input type="hidden" name="id">
              <input type="hidden" name="section_id" value="{{ $data->id }}">
              <input type="hidden" name="sub_content_id">
              {{--  --}}
              <div class="form-row">
                <div class="form-group col-6">
                  <label for="">Section</label>
                  <input type="text" class="form-control" value="{{ $data->section_title }}" readonly>
                </div>
                <div class="form-group col-6">
                  <label for="">Year</label>
                  <select name="revise_year_id" id="" class="custom-select">
                    <option value="">None</option>
                    @foreach ($year as $item)
                    <option value="{{ $item->id }}">{{ $item->year }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Comparison content</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
               </div>
              <div class="form-group">
                <label class="col-form-label text-md-right">Content</label>
                  <textarea class="summernote" name="content" data-height="100"></textarea>
                  <textarea class="d-none" name="content_text"></textarea>
              </div>
              {{--  --}}
            
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

