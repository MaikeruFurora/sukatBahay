@extends('layout.userLayout.app')
@section('content')
  <!-- Testimonial section-->
  {{-- <div class="py-5 bg-light text-white">
    <div class="container px-5 my-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <form action="{{ route('search.force') }}" method="GET">
                    <div class="search"> <i class="fa fa-search"></i> <input type="text" name="search" class="form-control" placeholder="Find Something" required value="{{ request('search') }}"> <button class="btn btn-primary">Search</button> </div>
                </form>
            </div>
        </div>
       
    </div>
</div> --}}
<!-- Blog preview section-->
<div class="container mt-5">  
    <div class="row">
      
    <div class="col-lg-4 col-md-4 col-sm-4 order-2">
        <div class="accordion  mt-5" id="accordionFlushExample">
            @foreach ($menu as $item)
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $item->slug }}" aria-expanded="{{ ($item->slug==$rule->slug)?'true':'false' }}" aria-controls="flush-collapse-{{ $item->slug }}">
                    {{ $item->title }}
                    </button>
                </h2>
                <div id="flush-collapse-{{ $item->slug }}" class="accordion-collapse collapse {{ ($item->slug==$rule->slug)?'show':'' }}" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        @if (count($item['sections'])>0)
                        <ul class="list-group list-group-flush">
                        @forelse ($item['sections'] as $sub)
                        <a href="{{ url('rule-content/'.$item->slug.'/'.$sub->slug) }}" style="text-decoration: none;color:black">
                            <li class="list-group-item {{ ($sub->slug==$section->slug)?'new-active':'' }}">
                                    {{ $sub->section_title }}
                                </li>
                            </a>
                        @empty
                            <li> <a class="dropdown-item" href="#"> Nothing else here</a></li>
                        @endforelse
                        </ul>
                        @else
                            <small>No data available</small>
                        @endif
                    </div>
                </div>
            </div>        
            @endforeach
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 order-1">
       <div class="card mt-5 mb-3">
           <div class="card-body pb-1 pt-4">
            <div class="text-center text-dark">
                <h2 class="fw-bolder mb-3">{{ $rule->title }}</h2>
                <p class="lead fw-normal text-muted mb-4">{{ $section->section_title }}</p>
            </div>
           </div>
       </div>
       <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                @for ($i = 0; $i < count($unique); $i++)
                    <li class="nav-item">
                    <a class="nav-link {{ $i==0?'show active':'' }}" id="nav-{{ str_replace(' ','-',$unique[$i]) }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ str_replace(' ','-',$unique[$i]) }}" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                        &nbsp;&nbsp;{{ $unique[$i] }}&nbsp;&nbsp;
                    </a>
                    </li>
                    @endfor
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                @for ($i = 0; $i < count($unique); $i++)
                <div class="tab-pane fade {{ $i==0?'show active':'' }} mt-3" id="nav-{{ str_replace(' ','-',$unique[$i]) }}" role="tabpanel" aria-labelledby="nav-{{ str_replace(' ','-',$unique[$i]) }}-tab">
                    @foreach ($section->contents as $key => $value)
                    {{-- for 2004 and 1977 --}}
                        @if(!is_null($value->reviseYear))
                            @if ($unique[$i]===$value->reviseYear->year)
                                <div class="p-4">
                                    @php
                                        echo html_entity_decode(str_ireplace($condition, $replace_string,$value->content))
                                    @endphp
                                    <div class="btn-group mb-2 mt-2" role="group" aria-label="Basic example">
                                    <a href="{{ route('content.bookmark',$value->id) }}" class="btn btn-sm btn-outline-warning text-dark" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</a>
                                    </div>
                                </div>
                                @foreach ($value->sub_content as $item)
                                <div class="px-5">
                                
                                    @php
                                    echo html_entity_decode(str_ireplace($condition, $replace_string,$item->content))
                                @endphp
                                    <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                    <a href="{{ route('content.bookmark',$value->id) }}" class="btn btn-sm btn-outline-warning text-dark" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</a>
                                    </div>
                                </div>
                                @endforeach
                                
                            @endif
                        {{-- for 2004 and 1977 --}}
                        @else
                        {{-- for no revision --}}
                        <div class="p-4">
                            @php
                            echo html_entity_decode($value->content)
                            @endphp
                            <div class="btn-group mt-2" role="group" aria-label="Basic example">
                                <a href="{{ route('content.bookmark',$value->id) }}" class="btn btn-sm btn-outline-warning text-dark" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                        @foreach ($value->sub_content as $item)
                        <div class="px-5">
                            @php
                                echo html_entity_decode(str_ireplace($condition, $replace_string,$item->content))
                            @endphp
                            <div class="btn-group mb-3" role="group" aria-label="Basic example">
                            <a href="{{ route('content.bookmark',$value->id) }}" class="btn btn-sm btn-outline-warning text-dark" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    @endforeach
                
                </div>
                @endfor
            </div>
        </div>
       </div>
    </div>

    </div><!-- row -->
</div><!-- container -->
@endsection