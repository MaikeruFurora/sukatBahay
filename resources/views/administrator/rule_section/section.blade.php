@extends('layout.adminLayout.app')
@section('title','Section | Management')
@section('moreCss')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
@include('administrator.rule_section.modalForm')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Section</h2>
        <p class="section-lead" style="font-size: 13px">
            {{ $ruleData->title }} / Section
        </p>
        <div class="row">
            
           <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book-reader" style="font-size: 20px"></i>&nbsp;&nbsp;{{ $ruleData->title }}</h4>
                    <div class="card-header-action">
                        <a class="btn btn-dark" href="{{ route('admin.rule') }}" style="font-size: 14px;color:white"> Back</a>
                        <button class="btn btn-primary" name="btnAdd" style="font-size: 14px"> Create Section</button>
                    </div>
               </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap table-md" style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:13px">
                            <thead>
                            <tr>
                                <th>SECTION NO.</th>
                                <th>TITLE</th>
                                <th>UPDATED AT</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                             <tbody></tbody>
                        </table>
                    </div>
    
                </div>
            </div>
           </div>
        </div>
    </div>

</section>
@endsection

@section('moreJs')
   <script src="{{ asset('adminstyle/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('adminstyle/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        "use strict"
        const ruleId = `<?=$ruleData->id?>`;
        let datatableSection = $("#datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url:`list/${ruleId}`,
                dataType: "json",
                type: "POST",
                data:{ _token: $('input[name="_token"]').val() }
            },
            columns: [
                { data:"section_no" },
                { data:"section_title" },
                { data:"updated_at" },
                { 
                    data:null,
                    render:function(data){
                        return `
                         <button class="btn btn-warning btn-sm pl-3 pr-3" name="btnEdit" value="${data.id}"><i class="fas fa-edit"></i> Edit</button>
                         <a class="btn btn-success btn-sm pl-3 pr-3" href="content/${data.id}">Content</button>
                         `
                    }
                },
               
            ]
       });

       $('button[name="btnAdd"]').on('click',function(){
            $("#sectionModalTitle").text('Create Section')
            $("#sectionForm button[type='submit']").text("Create");
            $("#sectionForm input[name='id']").val('')
            $("#sectionModal").modal("show")
        })

       $('#sectionForm').on('submit',function(e){
            e.preventDefault()
            $.ajax({
                url:'store',
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $("#sectionForm button[type='submit']").html(` 
                    Saving... <div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>
                    `).attr("disabled", true);
                }
           }) .done(function (data) {
                datatableSection.ajax.reload()
                getToast("success", `<i class="fas fa-book-reader"></i>`,"Successfully saved");
                $("#sectionForm button[type='submit']").text("Create").attr("disabled", false);
                $("#sectionModal").modal("hide")
                $("#sectionForm")[0].reset()
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("#sectionForm button[type='submit']").text("Create").attr("disabled", false);
            });
       })

       $(document).on('click','button[name="btnEdit"]',function(){
        $("#sectionModalTitle").text('Edit Rule')
        $("#sectionForm button[type='submit']").text("Update");
        let updateId=$(this).val()
        $.ajax({
                url:`edit/${updateId}`,
                type:'GET',
                beforeSend: function(){
                    $("button[value="+updateId+"]").html(` Loading... `).attr("disabled", false);
                }
            }).done(function(data){
                $('#sectionForm input[name="id"]').val(data.id)
                $('input[name="section_no"]').val(data.section_no)
                $('input[name="section_title"]').val(data.section_title)
                $("#sectionModal").modal("show")
                 $("button[value="+updateId+"]").html(` <i class="fas fa-edit"></i> Edit `).attr("disabled", false);
            }) .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("#sectionForm button[type='submit']").text("Update").attr("disabled", false);
                 $("button[value="+updateId+"]").html(` <i class="fas fa-edit"></i> Edit `).attr("disabled", false);
            });
       })



    </script>
@endsection