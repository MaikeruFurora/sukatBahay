@extends('layout.adminLayout.app')
@section('title','User | Management')
@section('moreCss')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminstyle/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection
@section('content')
<section class="section">
    <h2 class="section-title">Users</h2>

    <div class="section-body">
        <div class="row">
           <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-users" style="font-size: 18px"></i>&nbsp;&nbsp;List of Users</h4>
               </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;font-size:12px">
                            <thead>
                            <tr>
                                <th>FULLNAME</th>
                                <th>EMAIL</th>
                                <th>CREATED AT</th>
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

        let datatableEquipment = $("#datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url:'user/list',
                dataType: "json",
                type: "POST",
                data:{ _token: $('input[name="_token"]').val() }
            },
            columns: [
                { data:"fullname" },
                { data:"email" },
                { data:"created_at" },

            ]
       });

    </script>
@endsection