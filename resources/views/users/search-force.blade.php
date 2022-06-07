@extends('layout.userLayout.app')
@section('content')
  <!-- Testimonial section-->
  <div class="py-5 bg-dark text-white pb-2">
    <div class="container px-3 my-5">
        <div class="row gx-2 justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="text-center mb-1">
                    <img  src="{{ asset($logo.'white.png') }}" height="100" alt="">
                </div>
                <form action="{{ route('search.force') }}" method="GET">
                    <div class="search"> <i class="fa fa-search"></i> <input type="text" name="search" class="form-control" placeholder="Find Something" required value="{{ request('search') }}"> <button class="btn bg-dark text-white">Search</button> </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Blog preview section-->
<div class="container mt-3">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
    @if (count($result)>0)
    <small class=" text-muted mb-3">Result match: {{ $result->count() }} item(s)</small>
    @endif
    @forelse ($result as $item)
    <a href="{{ url('rule-content/'.$item->section->rule->slug.'/'.$item->section->slug) }}" style="text-decoration: none;color:black">
        <div class="card mt-3 p-3" onMouseOver="this.style.backgroundColor='#f0f5f5'" onMouseOut="this.style.backgroundColor='white'">
            <div class="card-body pb-1">
               
                <h6 class="text-primary">{{ $item->section->rule->title }} > {{ $item->section->section_title }}</h6>
                <span style="font-size: 11px">
                    @php
                        echo html_entity_decode(str_ireplace($condition, $replace_string,$item->content_text))
                    @endphp
                </span>
            </div>
        </div>
    </a>
    @empty
    <div class="text-center mt-5">
        <h1 class="fw-bolder">Search not Found!</h1>
        <p class="lead fw-normal text-muted mb-0">How can we help you?</p>
    </div>
    @endforelse
    <div class="d-flex justify-content-center mt-5 mb-5">
        {!! $result->links() !!}
    </div>
    </div>
</div><!-- row -->
</div><!-- container -->
@endsection