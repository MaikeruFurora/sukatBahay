@extends('layout.adminLayout.app')
@section('title','Rule | Management')
@section('moreCss')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
@include('administrator.rule.modalForm')
<section class="section">
    
    <div class="section-body">
        <h2 class="section-title">Rule</h2>
        <div class="row">
           <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book-reader" style="font-size: 20px"></i>&nbsp;&nbsp;List of Rule</h4>
                    <div class="card-header-action"><button class="btn btn-primary" name="btnAdd" style="font-size: 14px"> Create Rule</button></div>
               </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:13px">
                            <thead>
                            <tr>
                                <th>RULE NO.</th>
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

        let datatableRule = $("#datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url:'rule/list',
                dataType: "json",
                type: "POST",
                data:{ _token: $('input[name="_token"]').val() }
            },
            columns: [
                { data:"rule_no" },
                { data:"title" },
                { data:"updated_at" },
                { 
                    data:null,
                    render:function(data){
                        return `
                         <button class="btn btn-warning btn-sm pl-3 pr-3" name="btnEdit" value="${data.id}"><i class="fas fa-edit"></i> Edit</button>
                         <a class="btn btn-success btn-sm pl-3 pr-3" href="section/${data.id}"><i class="fas fa-puzzle-piece"></i> Section</button>
                         `
                    }
                },
               
            ]
       });

       $('button[name="btnAdd"]').on('click',function(){
            $("#ruleModalTitle").text('Create Rule')
            $("#ruleForm button[type='submit']").text("Create");
            $("#ruleForm input[name='id']").val('')
            $("#ruleModal").modal("show")
        })

       $('#ruleForm').on('submit',function(e){
            e.preventDefault()
            $.ajax({
                url:'rule/store',
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $("#ruleForm button[type='submit']").html(` 
                    Saving... <div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>
                    `).attr("disabled", true);
                }
           }) .done(function (data) {
                datatableRule.ajax.reload()
                getToast("success", `<i class="fas fa-book-reader"></i>`,"Successfully saved");
                $("#ruleForm button[type='submit']").text("Create").attr("disabled", false);
                $("#ruleModal").modal("hide")
                $("#ruleForm")[0].reset()
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("#ruleForm button[type='submit']").text("Create").attr("disabled", false);
            });
       })

       $(document).on('click','button[name="btnEdit"]',function(){
        $("#ruleModalTitle").text('Edit Rule')
        $("#ruleForm button[type='submit']").text("Update");
        let updateId = $(this).val();
        $.ajax({
                url:`rule/edit/${updateId}`,
                type:'GET', 
                beforeSend: function(){
                    $("button[value="+updateId+"]").html(` Loading... `).attr("disabled", false);
                }
            }).done(function(data){
                $('#ruleForm input[name="id"]').val(data.id)
                $('input[name="rule_no"]').val(data.rule_no)
                $('input[name="title"]').val(data.title)
                $("#ruleModal").modal("show")
                $("button[value="+updateId+"]").html(` <i class="fas fa-edit"></i> Edit `).attr("disabled", false);
            }) .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("#ruleForm button[type='submit']").text("Update").attr("disabled", false);
                $("button[value="+updateId+"]").html(` <i class="fas fa-edit"></i> Edit `).attr("disabled", false);
            });
       })

    </script>
@endsection