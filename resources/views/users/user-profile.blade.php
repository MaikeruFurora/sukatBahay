@extends('layout.userLayout.app')
@section('content')
<div class="container mt-5 py-5">  
   <div class="col-12">
    <div class="row gx-5 mt-5">
        <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">A better way to start building.</h2></div>
        <div class="col-lg-8">
            <div class="card p-3" style="box-shadow: 0 0 40px rgba(51, 51, 51, .2)">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">Change Password</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Saved | Bookmark</button>
                          </li>
                      
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade p-4 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            
                            <form action="">
                                <div class="mb-4">
                                    <label for="exampleFormControlInput1" class="form-label">Fullname</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" value="{{ auth()->user()->fullname }}">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" value="{{ auth()->user()->email }}">
                                </div>
                                <br>
                                <button class="btn btn-sm btn-secondary float-end">Save Changes</button>
                            </form>

                        </div>
                        <div class="tab-pane fade p-4" id="password" role="tabpanel" aria-labelledby="password-tab">
                         
                            <form action="" class="mt-4">
                                <div class="mb-4">
                                    <label for="" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="">
                                </div>
                                <br>
                                <button class="btn btn-sm btn-secondary float-end">Save Changes</button>
                                <br>
                            </form>

                        </div>
                        <div class="tab-pane fade p-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                          @php
                           $listBookmark = auth()->user()->load('bookmarks' )->bookmarks;
                       
                          @endphp
                            @forelse ($listBookmark as $value)
                            <a class="text-decoration-none" href="{{ url("rule-content/".$value->content->section->rule->slug."/".$value->content->section->slug) }}">
                            <li class="list-group-item d-flex justify-content-between align-items-start pb-0">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold" style="font-size: 15px">{{ $value->content->section->section_title }}</div>
                                    <p style="font-size: 11px;">
                                        {{ mb_strimwidth($value->content->content_text,0,((strlen($value->content->content_text)/2)/2),' ...') }}
                                    </p>
                                </div>
                                <span class="badge bg-success rounded-pill pt-1 pb-1" style="font-size: 10px">Read more</span>
                            </li>
                            </a>
                            {{-- {{  $listBookmark->links() }} --}}
                            @empty
                                <small>No bookmark</small>
                            @endforelse

                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
   </div>
</div><!-- container -->
@endsection