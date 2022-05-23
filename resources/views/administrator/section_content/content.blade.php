@extends('layout.adminLayout.app')
@section('title','Content | Management')
@section('moreCss')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Content</h2>
        <p class="section-lead" style="font-size: 13px">
            {{ $rule->title }} / {{ $data->section_title }} / Content
        </p>
       <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $data->section_title }}</h4>
                        <div class="card-header-action">
                            <a class="btn btn-dark" href="{{ route('admin.section',$data->rule_id) }}" style="font-size: 14px;color:white"> Back</a>
                            <a class="btn btn-primary" href="{{ route('admin.content.create',$data->id) }}" style="font-size: 14px;color:white"> Create Content</a>
                          </div>
                    </div>
                    <div class="card-body">
                       

                        <ul class="list-unstyled">
                            <li class="media">
                                <ul class="list-unstyled">
                                    <li class="media">
                                      <div class="media-body">
                                        <h5 class="mt-0 mb-1">List-based media object</h5>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                      </div>
                                    </li>
                                    <li class="media my-4">
                                      <div class="media-body">
                                        <h5 class="mt-0 mb-1">List-based media object</h5>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                      </div>
                                    </li>
                                    <li class="media">
                                      <div class="media-body">
                                        <h5 class="mt-0 mb-1">List-based media object</h5>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                      </div>
                                    </li>
                                  </ul>
                            </li>
                            <li class="media my-4">
                              <div class="media-body">
                                <h5 class="mt-0 mb-1">List-based media object</h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                              </div>
                            </li>
                            <li class="media">
                              <div class="media-body">
                                <h5 class="mt-0 mb-1">List-based media object</h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                              </div>
                            </li>
                          </ul>

                       {{-- <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                           <thead>
                            <tr class="text-center ">
                                <th width="60%">Context</th>
                                <th width="10%" class="text-center">Comparison</th>
                                <th width="30%">Action</th>
                            </tr>
                           </thead>
                           <tbody id="content">
                            @forelse ($data['contents'] as $item)
                            <tr>
                                    <td>
                                        @php
                                            echo html_entity_decode($item->content);
                                        @endphp
                                        <div class="btn-group" role="group" aria-label="Button group">
                                            <button class="btn btn-sm btn-primary"><i class="fas fa"></i> Comparison</button>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            echo html_entity_decode($item->comparison);
                                        @endphp
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-warning btn-sm pl-3 pr-3" href="{{ route('admin.content.edit',$item->id) }}">Edit</a>
                                        <button class="btn btn-danger btn-sm pl-2 pr-2"  onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</button>
                                        <form action="{{ route('admin.content.delete',$item->id) }}" method="POST" id="delete-form" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No data here.</td>
                            </tr>
                            @endforelse
                           </tbody>
                        </table>
                       </div> --}}
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
        // "use strict"

        // $('.summernote').summernote({
        //     //placeholder: 'write here...',
        //     spellCheck: true,
        //     dialogsInBody: true,
        //     minHeight: 150,
        // });
 
        // $('.nav-tabs a[href="#home-tab2"]').on('click',function(){
        //     $('.nav-tabs a[href="#home"]').tab('show');
        // })

        // $('.nav-tabs a[href="#profile-tab2"]').on('click',function(){
        //     $('.nav-tabs a[href="#profile2"]').tab('show');
        // })

  
     
        /**
         *
         * section id
         *
         **/

    //     const sectionId = `<?=$data->id?>`;

    //     $('#contentForm').on('submit',function(e){
    //         e.preventDefault()
    //         $.ajax({
    //             url:'store',
    //             type:'POST',
    //             data: new FormData(this),
    //             processData: false,
    //             contentType: false,
    //             cache: false,
    //             beforeSend: function(){
    //                 $("#contentForm button[type='submit']").html(` 
    //                 Saving... <div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>
    //                 `).attr("disabled", true);
    //             }
    //        }) .done(function (data) {
    //             getToast("success", `<i class="fas fa-book-reader"></i>`,"Successfully saved");
    //             $("#contentForm button[type='submit']").text("Create").attr("disabled", false);
    //             $("#contentForm")[0].reset()
    //             myContent(sectionId)
    //             $('#summernote1').summernote('reset')
    //             $('#summernote2').summernote('reset')
    //             $('#summernote3').summernote('reset')
    //             $("#showCancel").html('')
    //         })
    //         .fail(function (jqxHR, textStatus, errorThrown) {
    //             getToast("error", "Eror", errorThrown);
    //             $("#contentForm button[type='submit']").text("Create").attr("disabled", false);
    //         });
    //    })
    //    myContent(sectionId)

    //    $(document).on('click','button[name="btnEdit"]',function(){
    //     $("#contentForm button[type='submit']").text("Update");
    //     $.ajax({
    //             url:`edit/${$(this).val()}`,
    //             type:'GET'
    //         }).done(function(data){
    //             console.log(data);
    //             $('#contentForm input[name="id"]').val(data.id)
    //             $("#sectionModal").modal("show")
    //             if (data.comparison_one!='') {
                    
    //                 $('#summernote1').summernote('code',data.comparison_one)
    //             }
    //             if (data.comparison_two!='') {
    //                 $('#summernote2').summernote('code',data.comparison_two)
    //             }
    //             if (data.comparison_none!='') {
                    
    //                 $('#summernote3').summernote('code',data.comparison_none)
    //             }

    //             if (data.comparison_none=='' || data.comparison_none==null) {
    //                 $('.nav-tabs a[href="#home2"]').tab('show');
    //             } else {
    //                 $('.nav-tabs a[href="#profile2"]').tab('show');
    //             }

    //             // $('#summernote1').summernote('destroy')
    //             // $('#summernote2').summernote('destroy')
    //             // $('#summernote3').summernote('destroy')
                

    //             $("#showCancel").html(
    //                 `<button class="btn btn-secondary mt-2" name="btnCancel">Cancel</button>`
    //             )
    //         }) .fail(function (jqxHR, textStatus, errorThrown) {
    //             getToast("error", "Eror", errorThrown);
    //             $("#contentForm button[type='submit']").text("Update").attr("disabled", false);
    //         });
    //    })

    //    $(document).on('click','button[name="btnCancel"]',function(){
    //     $('#summernote1').summernote('reset')
    //     $('#summernote2').summernote('reset')
    //     $('#summernote3').summernote('reset')
    //     $("#contentForm button[type='submit']").text("Create")
    //     $("#showCancel").html('')
    //    })

    //    $(document).on('click','button[name="delete"]',function(){
    //     $.ajax({
    //     url: `delete/${$(this).val()}`,
    //     type: "DELETE",
    //     data: { _token: $('input[name="_token"]').val() },
    //     // beforeSend: function () {
    //     //     $(".deleteYes").html(`
    //     //     <div class="spinner-border spinner-border-sm" role="status">
    //     //         <span class="sr-only">Loading...</span>
    //     //     </div>`).attr('disabled',true);
    //     // },
    // })
    //     .done(function (response) {
    //         myContent(sectionId)
    //     })
    //     .fail(function (jqxHR, textStatus, errorThrown) {
    //         getToast("error", "Eror", errorThrown);
    //     });
       })

    </script>
@endsection