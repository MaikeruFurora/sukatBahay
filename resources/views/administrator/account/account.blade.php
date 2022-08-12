@extends('layout.adminLayout.app')
@section('title','Account')
@section('moreCss')
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/css/dashboard.css') }}">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
@include('administrator.account.modalForm')
<section class="section">
    <div class="section-body">
      <h2 class="section-title">Account</h2>
      <div class="row">
        <div class="col-lg-12 col-md-8 col-sm-12 col-12">
          @include('administrator.account.revise_year')
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
          @if (session()->has('msg'))
            <div class="alert alert-primary" role="alert">
                {{ session()->get('msg') }}
            </div>
          @endif
          <div class="card">
            <div class="card-header">
              <h4>Profile</h4>
            </div>
              <div class="card-body">
                <form id="formProfile" method="POST" action="{{ route('admin.account.create') }}">@csrf
                  <div class="form-group">
                    <label for="">Fullname</label>
                    <input type="text" class="form-control" name="fullname" value="{{ auth()->user()->fullname }}" disabled>
                  </div>  
                  <div class="form-group">
                    <label for="">Email address</label>
                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" disabled>
                  </div>
                    <button type="submit" class="btn btn-primary" disabled>Save</button>
                    <button type="button" class="btn btn-secondary btnEdit">Edit Profile</button>
                  </form>
              </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm 12 col-12">
          <div class="card">
            <div class="card-header">
              <h4>Change Password</h4>
            </div>
            <div class="card-body">
              <form>
                  <div class="form-group">
                    <label for="">Old Password</label>
                    <input type="password" class="form-control" id="">
                  </div>
                  <div class="form-group">
                    <label for="">New Password</label>
                    <input type="password" class="form-control" id="">
                  </div>
                  <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" id="">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
    let isActive=true;
    $(".btnEdit").on('click',function(){
        isActive=!isActive
        $("#formProfile button[type='submit']").prop('disabled',isActive);
        $("#formProfile :input").prop('disabled',isActive);
    })

    let reviseYearTable = $("#reviseYearTable").DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url:'revise-year/list',
            dataType: "json",
            type: "POST",
            data:{ _token: $('input[name="_token"]').val() }
        },
        columns: [
            { data:"id" },
            { data:"year" },
            { data:"description" },
            { data:"updated_at" },
            { 
                data:null,
                render:function(data){
                    return `
                      <button class="btn btn-warning btn-sm pl-3 pr-3" name="btnEdit" value="${data.id}"><i class="fas fa-edit"></i> Edit</button>
                      `
                }
            },
            
        ]
    });

    $('button[name="btnAdd"]').on('click',function(){
          $("#reviseYearModalTitle").text('Create Year')
          $("#reviseYearForm button[type='submit']").text("Create");
          $("#reviseYearForm input[name='id']").val('')
          $("#reviseYearModal").modal("show")
      })

    $('#reviseYearForm').on('submit',function(e){
            e.preventDefault()
            $.ajax({
                url:'revise-year/store',
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(){
                    $("#reviseYearForm button[type='submit']").html(` 
                    Saving... <div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>
                    `).attr("disabled", true);
                }
           }) .done(function (data) {
                reviseYearTable.ajax.reload()
                getToast("success", `<i class="fas fa-book-reader"></i>`,"Successfully saved");
                $("#reviseYearForm button[type='submit']").text("Create").attr("disabled", false);
                $("#reviseYearModal").modal("hide")
                $("#reviseYearForm")[0].reset()
            })
            .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("#reviseYearForm button[type='submit']").text("Create").attr("disabled", false);
            });
       })

       $(document).on('click','button[name="btnEdit"]',function(){
        $("#reviseYearModalTitle").text('Revision Year')
        $("#reviseYearForm button[type='submit']").text("Update");
        let updateId = $(this).val();
        $.ajax({
                url:`revise-year/edit/${updateId}`,
                type:'GET', 
                beforeSend: function(){
                    $("button[value="+updateId+"]").html(` Loading... `).attr("disabled", false);
                }
            }).done(function(data){
                $('#reviseYearForm input[name="id"]').val(data.id)
                $('input[name="year"]').val(data.year)
                $('textarea[name="description"]').val(data.description)
                $("#reviseYearModal").modal("show")
                $("button[value="+updateId+"]").html(` <i class="fas fa-edit"></i> Edit `).attr("disabled", false);
            }) .fail(function (jqxHR, textStatus, errorThrown) {
                getToast("error", "Eror", errorThrown);
                $("#reviseYearForm button[type='submit']").text("Update").attr("disabled", false);
                $("button[value="+updateId+"]").html(` <i class="fas fa-edit"></i> Edit `).attr("disabled", false);
            });
       })
  </script>
@endsection