@extends('layout.adminLayout.app')
@section('title','Dashboard')
@section('moreCss')
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
      <h2 class="section-title">Dashboard</h2>
    </div>

    {{-- <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i style="font-size: 30px" class="fas fa-user-shield"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Admin</h4>
              </div>
              <div class="card-body">
               111
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i style="font-size: 30px" class="fas fa-user-nurse"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Nurse</h4>
              </div>
              <div class="card-body">
                222
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i style="font-size: 30px" class="fas fa-pills"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Medicine</h4>
              </div>
              <div class="card-body">
                333
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i style="font-size: 30px" class="fas fa-user-injured"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Patient</h4>
              </div>
              <div class="card-body">
                444
              </div>
            </div>
          </div>
        </div>
    </div> --}}
    
</section>
@endsection

@section('moreJs')
  
@endsection