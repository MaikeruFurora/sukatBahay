@extends('layout.userLayout.app')
@section('content')
<div class="container">
    <div class="text-center mb-5 py-3">
        <h1 class="fw-bolder mb-2">{{ $rule->title }}</h1>
        <p class="lead fw-normal text-muted mb-2">{{ $section->section_title }}</p>
        <button class="btn btn-deafult btn-sm"><i class="fas fa-feather-alt"></i> Take an Exercises</button>
    </div>
    {{-- <div class="row">
        <div class="col-md-3 offset-md-9">
            <div class="mb-3 row">
                <label for="inputPassword" class="col-md-3 col-form-label">Year</label>
                <div class="col-md-9">
                    <select id="my-select" class="form-select" name="year">
                        <option value="none">None</option>
                        @foreach ($year as $item)
                            <option value="{{ $item->id }}">{{ $item->year }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
           
        </div>
      </div> --}}
    
   
    <div class="row">
      
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card mt-1">
            <div class="card-header p-3">
              Sections
            </div>
            <ul class="list-group list-group-flush">
             @foreach ($rule->sections as $item)
               <a href="{{ url('rule-sections/'.$rule->slug.'/'.$item->slug) }}" style="text-decoration: none">
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
                            {{ $unique[$i] }}
                          </a>
                        </li>
                        @endfor
                       
                      </ul>
                    <nav>
                       
                      </nav>
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
                                          echo html_entity_decode($value->content)
                                      @endphp
                                      <div class="btn-group mb-2 mt-2" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-warning" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</button>
                                      </div>
                                  </div>
                                  @foreach ($value->sub_content as $item)
                                  <div class="px-5">
                                      @php
                                          echo html_entity_decode($item->content)
                                      @endphp
                                      <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-warning" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</button>
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
                                  <button type="button" class="btn btn-sm btn-warning" style="font-size: 11px"><i class="fas fa-bookmark"></i> Bookmark</button>
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