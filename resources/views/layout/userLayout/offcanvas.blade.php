
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"><i class="far fa-bookmark"></i> Bookmark</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ol class="list-group list-group-numbered">
      @forelse (auth()->user()->load('bookmarks')->bookmarks as $value)
      <a class="text-decoration-none" href="{{ url("rule-content/".$value->content->section->rule->slug."/".$value->content->section->slug) }}">
      <li class="list-group-item d-flex justify-content-between align-items-start pb-0">
        <div class="ms-2 me-auto">
          <div class="fw-bold" style="font-size: 13px">{{ $value->content->section->section_title }}</div>
          <p style="font-size: 11px;">
            {{ mb_strimwidth($value->content->content_text,0,((strlen($value->content->content_text)/2)/2),' ...') }}
          </p>
        </div>
        <span class="badge bg-success rounded-pill pt-1 pb-1" style="font-size: 10px">Read more</span>
      </li>
      </a>
      @empty
        <small>No bookmark</small>
      @endforelse
       
      </ol>
  </div>
</div>