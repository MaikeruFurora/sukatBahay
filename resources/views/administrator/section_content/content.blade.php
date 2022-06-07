@extends('layout.adminLayout.app')
@section('title','Content | Management')
@section('moreCss')
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
{{-- @include('administrator.section_content.modalForm') --}}
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Content</h2>
        <p class="section-lead" style="font-size: 13px">
            {{ $rule->title }} / {{ $data->section_title }} / Content
        </p>
       <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $data->section_title }}</h4>
                        <form class="card-header-form mr-3">
                          <select id="my-select" class="custom-select" name="select_year">
                            <option value="">No Revision</option>
                            @foreach ($year as $item)
                            <option value="{{ $item->id }}">{{ $item->year }}</option>
                            @endforeach
                          </select>
                        </form>
                        <div class="card-header-action">
                              
                            <a class="btn btn-dark" href="{{ route('admin.section',$data->rule_id) }}" style="font-size: 14px;color:white"> Back</a>
                            {{-- <a class="btn btn-primary" href="{{ route('admin.content.create',$data->id) }}" style="font-size: 14px;color:white"> Create Content</a> --}}
                            {{-- <button class="btn btn-primary" name="btnCreate" style="font-size: 14px;color:white"> Create Content</button> --}}
                          </div>
                          
                    </div>
                    <div class="card-body">
                      <div class="media-content"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
              <!-- Modal -->
              
              <div class="card">
                <div class="card-body">
                  <form id="contentForm">@csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="section_id" value="{{ $data->id }}">
                    <input type="hidden" name="sub_content_id">
                    {{--  --}}
                    <div class="form-row">
                      <div class="form-group col-6">
                        <label for="">Section</label>
                        <input type="text" class="form-control" value="{{ $data->section_title }}" readonly>
                      </div>
                      <div class="form-group col-6">
                        <label for="">Year</label>
                        <select name="revise_year_id" id="" class="custom-select">
                          <option value="">No Revision</option>
                          @foreach ($year as $item)
                          <option value="{{ $item->id }}">{{ $item->year }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Comparison content</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label text-md-right">Content</label>
                        <textarea class="summernote" name="content"></textarea>
                        <textarea class="d-none" name="content_text"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <span class="reset"></span>
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
    <script>
        "use strict"
        $('.summernote').summernote({
          height: ($(window).height() - 700),
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                    e.preventDefault();

                    // Firefox fix
                    setTimeout(function () {
                        document.execCommand('insertText', false, bufferText);
                    }, 10);
                }
            }
        });
        
        let selectedTag = $('select[name="select_year"] option');
        const clearForm = () =>{
          $('.summernote').summernote('reset')
          $('#contentForm input[name="id"]').val('');
          $('#contentForm input[name="sub_content_id"]').val('');
          $('button[name="reset"]').hide();
          // $("select[name='revise_year_id'] option[value="+ selectedTag.filter(":selected").val() +"]").attr("selected", true);
        }
      
   
        $('#contentForm').on('submit',function(e){
          
            e.preventDefault()
             let cleanText =$($(".summernote").summernote("code")).text()
             $('textarea[name="content_text"]').val(cleanText)
            $.ajax({
                url:'store',
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $("#contentForm button[type='submit']").html(` 
                    Saving... <div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>
                    `).attr("disabled", true);
                }
           }) .done(function (data) {
              
                getToast("success", `<i class="fas fa-book-reader"></i>`,"Successfully saved");
                $("#contentForm button[type='submit']").text("Create").attr("disabled", false); 
               
               clearForm()
               content(selectedTag.filter(":selected").val())
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("#contentForm button[type='submit']").text("Create").attr("disabled", false);
            });
       })

     
        /**
         *
         * section id
         *
         **/

        const sectionId = `<?=$data->id?>`;

      const _cancelButton = () =>{
          let _cancelButton=` <button type="button" name="reset" class="btn btn-warning">Cancel</button>`;
          $("#contentForm .reset").html(_cancelButton)
       }

       $(document).on('click','button[name="reset"]',function(){
         clearForm()
         $(this).hide();
       })


       $(document).on('click','button[name="btnEdit"]',function(){
         $("#contentForm button[type='submit']").text("Update");
         clearForm()
        $.ajax({
                url:`edit/${$(this).val()}`,
                type:'GET'
            }).done(function(data){
                _cancelButton()
                $('#contentForm input[name="id"]').val(data.id)
                $('#contentForm input[name="sub_content_id"]').val(data.sub_content_id)
                $('.summernote').summernote('code',data.content)
                if (data.revise_year_id!=null) {
                  $("select[name='revise_year_id'] option[value="+ data.revise_year.id+"]").attr("selected", true); 
                } else {
                  $("select[name='revise_year_id'] option").prop("selectIndex", 0); 
                }
            }) .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("#contentForm button[type='submit']").text("Update").attr("disabled", false);
            });
       })


    const content = (yearSelected) =>{
      let _content = ``;
      let _subcontent = ``;
      $.ajax({
        url: `list/${sectionId}/${yearSelected}`,
        type: "GET",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function(){
            $(".media-content").html(` 
            Loading...`);
        }
       })
        .done(function (response) {
          if (response.contents.length>0) {   
            response.contents.forEach((element) => {
                _content+=`
                <div class="media">
                <div class="media-body">
                  <p> ${ element.content }
                    ${buttongroup(element.id,element.sub_content)}
                    </p>
                    ${subcontent(element.sub_content)}
                    </div>
                    </div>`//hold
                    // <small>Year: ${ element.revise_year.year }</small><br/><br/>
            });
          }else{
            _content=`<small class="text-center">No data available</small>`
          }
          $(".media-content").html(_content);
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
            getToast("error", "Eror", errorThrown);
        });
    }


    const subcontent = (value) =>{
      let _subcontent='';
      if (value!=undefined) {
        if (parseInt(value.length)>0) {
        value.map(elem=>{
          _subcontent+=`
              <div class="media">
                <span class="pr-5"></span>
                <div class="media-body">
                  <p class="mb-0">${ elem.content }
                    ${buttongroup(elem.id,elem.sub_content)}  
                  </p>
                   ${subcontent(elem.sub_content)}
                </div>
              </div>`
            });
        }
      }

      return _subcontent;
    }


   

    const buttongroup = (id,obj) =>{
      let buttongrouphtml=``;
      buttongrouphtml+= `<div class="btn-group" role="group" aria-label="Basic example">`
       
      if (obj!=undefined) {
       
            buttongrouphtml+= `<button 
                       name="btnSubContent"
                         value="${id}"
                         type="button"
                         class="btn btn-default btn-sm pt-0 pb-0"
                         style="font-size:10px"
                 >
                 <i class="fas fa-code-branch"></i> Sub content</button>`
           
      }
              
      buttongrouphtml+= `<button 
                        value="${id}"
                        name="btnEdit"
                        type="button" 
                        class="btn btn-default btn-sm pt-0 pb-0"
                        style="font-size:10px"
                >
                <i class="fa fa-edit"></i> Edit</button>
                <button 
                        name="btnDelete"
                        value="${id}"
                        type="button"
                        class="btn btn-default btn-sm pt-0 pb-0 btn_${id}"
                        style="font-size:10px"
                >
                <i class="fa fa-trash"></i> Delete</button>
              </div>`;

          return buttongrouphtml
    }

    $(document).on('click','button[name="btnDelete"]',function(){
      let deletedID = $(this).val();
      if (confirm("Are you sure?")) {
        $.ajax({
        url: `delete/${deletedID}`,
        type: "DELETE",
        data: { _token: $('input[name="_token"]').val() },
        beforeSend: function(){
            $('btn_'+deletedID).html(` 
            <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
          </div>
            `).attr("disabled", true);
        }
       })
        .done(function (response) {
          $('btn_'+deletedID).html(`<i class="fa fa-trash"></i> Delete`).attr('disabled',false)
          getToast("success", "Success", "Data has been successfully deleted!");
          content(selectedTag.filter(":selected").val())
        })
        .fail(function (jqxHR, textStatus, errorThrown) {
           $('btn_'+deletedID).html(`<i class="fa fa-trash"></i> Delete`).attr('disabled',false)
            getToast("error", "Eror", errorThrown);
        });
      }

      return false;
    })

    $(document).on('click','button[name="btnSubContent"]',function(){
          $("#contentForm button[type='submit']").text("Create")
          // $("#contentModalTitle").text("Create Sub Content");
          clearForm()
          _cancelButton()
          $('#contentForm input[name="sub_content_id"]').val($(this).val());
          
    })

    $('select[name="select_year"]').on('change',function(){
      content($(this).val())
    })


    content(selectedTag.filter(":selected").val())

    </script>
@endsection