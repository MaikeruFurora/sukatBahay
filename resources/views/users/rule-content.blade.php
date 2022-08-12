@extends('layout.userLayout.app')
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-diaglog-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-1"><small>Highlight Text</small></div>
        <div class="modal-body p-3"><small id="show"></small></div>
        <div class="modal-footer p-0">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" style="font-size: 12px" class="btn btn-warning btn-sm btn-dismiss">Cancel</button>
                <button type="button" style="font-size: 12px" class="btn btn-success btn-sm btn-saved">Saved</button>
              </div>
        </div>
      </div>
    </div>
  </div>
@section('content')
  <!-- Testimonial section-->
  <div class="py-5 text-white pb-2" style="background: #37B47E">
    <div class="container px-3 py-4 my-2">
        <div class="row gx-2 justify-content-center">
            <div class="col-lg-10 col-xl-6">
                <div class="text-center mb-3">
                    <img  src="{{ asset($logo.'white.png') }}" height="100" alt="">
                </div>
                <form action="{{ route('search.force') }}" method="GET">
                    <div class="search"> <i class="fa fa-search"></i> <input type="text" name="search" class="form-control input-modified" placeholder="Search" required value="{{ request('search') }}"> <button class="btn btn-modified">Search</button> </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Blog preview section-->
<div class="container mt-4">  
    <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 order-2 gy-3">
        <div class="accordion " style="box-shadow: 0 0 40px rgba(177, 231, 208, .5)" id="accordionFlushExample">
            @foreach ($menu as $item)
            <div class="accordion-item">
                <h2 class="accordion-header border-bottom" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-{{ $item->slug }}" aria-expanded="{{ ($item->slug==$rule->slug)?'true':'false' }}" aria-controls="flush-collapse-{{ $item->slug }}" style="font-size:14px">
                    <span class="fw-bolder">{{ $item->title }}</span>
                    </button>
                </h2>
                <div id="flush-collapse-{{ $item->slug }}" class="accordion-collapse collapse {{ ($item->slug==$rule->slug)?'show':'' }}" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body p-4">
                        @if (count($item['sections'])>0)
                        <ul class="list-group list-group-flush">
                        @forelse ($item['sections'] as $sub)
                        <li class="list-group-item {{ ($sub->slug==$section->slug)?'sub-active':'' }}">
                            <a href="{{ url('rule-content/'.$item->slug.'/'.$sub->slug) }}" style="text-decoration: none;color:black;font-size:12px">
                                <i class="fas fa-check"></i>&nbsp;&nbsp;{{ $sub->section_title }}
                                </a>
                                </li>
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
    <h2 class="fw-bolder mb-3 mt-3" style="color:#1A3066">{{ $rule->title }}</h2>
       <p class="lead fw-normal text-muted mb-5">{{ $section->section_title }}</p>
       @if (session()->has('msg'))
       <div class="alert alert-dismissible fade show alert-{{ session()->get('action') ?? 'success' }}" role="alert">
         {{ session()->get('msg') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
       @endif
       <div class="card mt-4" style="box-shadow: 0 0 40px rgba(177, 231, 208, .5)">
        <div class="card-header bg-default">
        <ul class="nav nav-tabs card-header-tabs">
        @for ($i = 0; $i < count($unique); $i++)
            <li class="nav-item">
            <a class="nav-link {{ $i==0?'show active':'' }}" id="nav-{{ str_replace(' ','-',$unique[$i]) }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ str_replace(' ','-',$unique[$i]) }}" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                &nbsp;&nbsp;<b>{{ $unique[$i] }}</b>&nbsp;&nbsp;
            </a>
            </li>
        @endfor
        </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                @for ($i = 0; $i < count($unique); $i++)
                <div class="tab-pane fade has-user-select {{ $i==0?'show active':'' }} mt-3" id="nav-{{ str_replace(' ','-',$unique[$i]) }}" role="tabpanel" aria-labelledby="nav-{{ str_replace(' ','-',$unique[$i]) }}-tab">
                    @foreach ($section->contents as $key => $value)
                    {{-- for 2004 and 1977 --}}
                        @if(!is_null($value->reviseYear))
                            @if ($unique[$i]===$value->reviseYear->year)
                                <div class="p-4">
                                   @include('users.component.bookmark',['condition'=>$condition, 'replace_string'=> $replace_string,'value'=>$value]) 
                                </div>
                                @foreach ($value->sub_content as $item)
                                <div class="px-5">
                                    @include('users.component.bookmark',['condition'=>$condition, 'replace_string'=> $replace_string,'value'=>$item])
                                </div>
                                @endforeach
                                
                            @endif
                            
                        {{-- for 2004 and 1977 --}}
                        
                        @else
                        
                        {{-- for no revision --}}
                        
                        <div class="p-4">
                            @include('users.component.bookmark',['condition'=>$condition, 'replace_string'=> $replace_string,'value'=>$value])
                        
                        </div>
                        @foreach ($value->sub_content as $item)
                        <div class="px-5">
                            @include('users.component.bookmark',['condition'=>$condition, 'replace_string'=> $replace_string,'value'=>$item])
                            
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
@section('js')
    <script src="{{ asset('userStyle/js/main.js') }}"></script>
@endsection