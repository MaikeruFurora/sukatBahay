@php
    echo html_entity_decode(str_ireplace($condition, $replace_string,$value->content))
@endphp
@if (auth()->guest())
    <div class="btn-group mb-3 no-user-select" role="group" aria-label="Basic example">
        <a href="{{ route('content.bookmark',$value->id) }}" class="btn btn-outline-link text-dark" style="font-size: 13px"><i class="far fa-bookmark"></i> Save</a>
    </div>    
@else
{{-- 
    
if the user login    
    
--}}
    @if ($value->bookmarkedBy())
        <div class="btn-group mb-3 no-user-select" role="group" aria-label="Basic example">
            <a onclick="event.preventDefault();document.getElementById('content-id').submit();" class="btn btn-outline-link text-dark" style="font-size: 13px"><i class="fas fa-bookmark"></i> Saved</a>
        </div>
        <form id="content-id" action="{{ route('content.bookmark.destroy',$value->id) }}" method="POST" class="d-none">
            @csrf
        </form>
    @else
        <div class="btn-group mb-3 no-user-select" role="group" aria-label="Basic example">
            <a href="{{ route('content.bookmark',$value->id) }}" class="btn btn-outline-link text-dark" style="font-size: 13px"><i class="far fa-bookmark"></i> Save</a>
        </div>
    @endif    
@endif