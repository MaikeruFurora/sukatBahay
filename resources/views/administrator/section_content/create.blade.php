@extends('layout.adminLayout.app')
@section('title','Content-Create | Management')
@section('moreCss')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/summernote/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/jquery-selectric/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endsection
@section('content')
{{-- @include('administrator.section_content.modalForm') --}}
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Create Content</h2>
        <p class="section-lead" style="font-size: 13px">
            {{ $rule->title }} / {{ $data->section_title }} / Create
        </p>
        @if (session()->has('msg'))
        <div class="alert alert-success alert-has-icon">
             <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
             <div class="alert-body">
                 <button class="close" data-dismiss="alert">
                     <span>&times;</span>
                   </button>
                 <div class="alert-title">Success</div>
                     {{ session()->get('msg') }}
             </div>
       </div>
        @endif
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Write Your Content</h4>
                <div class="card-header-action">
                  <a class="btn btn-dark" href="{{ route('admin.content',$data->id) }}" style="font-size: 14px;color:white"> Back</a>
              </div>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('admin.content.store') }}"  enctype="multipart/form-data">
                <input type="hidden" name="id">@csrf
                <input type="hidden" name="section_id" value="{{ $data->id }}">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Section</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control" value="{{ $data->section_title }}" readonly>
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Comparison</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control selectric" name="year">
                      <option>1977</option>
                      <option>2004</option>
                      <option>None</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control selectric">
                      <option>Publish</option>
                      <option>Draft</option>
                      <option>Pending</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-2">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea class="summernote" name="content"></textarea>
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button type="submit" class="btn btn-primary">Create</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>

</section>
@endsection

@section('moreJs')
   <script src="{{ asset('adminstyle/assets/modules/summernote/summernote-bs4.js') }}"></script>
   <script src="{{ asset('adminstyle/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script>
        "use strict"
        $("select").selectric();
        $(".inputtags").tagsinput('items');
        $('.summernote').summernote({
            //placeholder: 'write here...',
            spellCheck: true,
            dialogsInBody: true,
            minHeight: 150,
        });

        $('.alert-success').fadeOut(6000)
  
    </script>
@endsection