@extends('layout.adminLayout.app')
@section('title','Content-Create | Management')
@section('moreCss')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
{{-- @include('administrator.section_content.modalForm') --}}
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Edit Content</h2>
        <p class="section-lead" style="font-size: 13px">
            {{ $content->title }} / {{ $content->section_title }} / Create
        </p>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{ $content->section_title }}</h4>
                    <div class="card-header-action">
                        <a class="btn btn-dark" href="{{ route('admin.content',$content->section_id) }}" style="font-size: 14px;color:white"> Back</a>
                    </div>
                  </div>
                  <div class="card-body">
                  
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" >Comparison 1977 &amp; 2004</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" >No Comparison</a>
                      </li>
                    </ul>
                    <form method="POST" action="{{ route('admin.content.store') }}"  enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{ $content->id }}">@csrf
                        <input type="hidden" name="section_id" value="{{ $content->section_id }}">
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade pb-0 show active" id="home2" >
                              <div class="row">
                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                      <label for="">1977</label>
                                      <textarea class="summernote" id="summernote1" name="comparison_one">{{ $content->comparison_one }}</textarea>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                      <label for="">2004</label>
                                      <textarea class="summernote" id="summernote2" name="comparison_two">{{ $content->comparison_two }}</textarea>
                                  </div>
                              </div>
                            </div>
                            <div class="tab-pane fade pb-0" id="profile2" >
                                <div class="row">
                                    <div class="col-12">
                                        <textarea class="summernote" id="summernote3"  name="comparison_none">{{ $content->comparison_none }}</textarea>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <button class="btn btn-primary mt-2" type="submit">&nbsp;&nbsp;Update&nbsp;&nbsp;</button>
                    </form>
                  </div>
                </div>
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
            </div>
        </div>
       
    </div>

</section>
@endsection

@section('moreJs')
   <script src="{{ asset('adminstyle/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script>
        "use strict"
        let comparison_none = `<?=$content->comparison_none?>`
        $('.summernote').summernote({
            //placeholder: 'write here...',
            spellCheck: true,
            dialogsInBody: true,
            minHeight: 150,
        });

        $('.alert-success').fadeOut(6000)
  
        if (comparison_none=='' || comparison_none==null) {
            $('.nav-tabs a[href="#home2"]').tab('show');
        } else {
            $('.nav-tabs a[href="#profile2"]').tab('show');
        }
    </script>
@endsection