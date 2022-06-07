@extends('layout.userLayout.app')
@section('content')
<header class="py-5">
  <div class="container px-5">
      <div class="row justify-content-center">
          <div class="col-lg-8 col-xxl-6">
              <div class="text-center my-5">
                  <h1 class="fw-bolder mb-3">{{ $rule->title }}</h1>
                  <p class="lead fw-normal text-muted mb-4">{{ $section->section_title }}</p>
                  <button class="btn btn-deafult btn-sm"><i class="fas fa-feather-alt"></i> Take an Exercises</button>
              </div>
          </div>
      </div>
  </div>
</header>
<div class="container">  
   
    <div class="row">
      
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card mt-1">
            <div class="card-header p-3">
              Sections
            </div>
            <ul class="list-group list-group-flush">
            @foreach ($rule->sections as $item)
               <a href="{{ url('section-content/'.$item->slug) }}" style="text-decoration: none">
                    <li class="list-group-item {{ $item->id==$section->id?'active':'' }}">
                    {{-- #$item->id==$section->id?' <i class="fas fa-check-circle"></i> ':'' --}}
                    {{ $item->section_title }}
                </li>
               </a>
             @endforeach
            </ul>
          </div>
    </div>

        <div class="col-lg-8 col-md-8 col-sm-12">
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
                                        <button type="button" class="btn btn-sm btn-outline-warning text-dark" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</button>
                                      </div>
                                  </div>
                                  @foreach ($value->sub_content as $item)
                                  <div class="px-5">
                                      @php
                                          echo html_entity_decode(str_ireplace($condition, $replace_string,$item->content))
                                      @endphp
                                      <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-outline-warning text-dark" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</button>
                                      </div>
                                  </div>
                                  @endforeach
                                  
                              @endif
                          {{-- for 2004 and 1977 --}}
                            @else
                          {{-- for no revision --}}
                            <div class="p-4">
                              @php
                                echo html_entity_decode(str_ireplace($condition, $replace_string,$value->content))
                              @endphp
                              <div class="btn-group mt-2" role="group" aria-label="Basic example">
                                  <button type="button" class="btn btn-sm btn-outline-warning text-dark" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</button>
                              </div>
                            </div>
                          @endif
                        @endforeach

                      </div>
                     @endfor
                    </div>
                </div>
            </div>
        </div>

       

    </div>
</div>
@endsection