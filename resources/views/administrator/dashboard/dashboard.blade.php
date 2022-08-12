@extends('layout.adminLayout.app')
@section('title','Dashboard')
@section('moreCss')
  <link rel="stylesheet" href="{{ asset('adminstyle/assets/css/dashboard.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
      <h2 class="section-title">Dashboard</h2>
    </div>

    <div class="row">
          <div class="col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                  <i style="font-size: 30px" class="fas fa-user-shield"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Verified Users</h4>
                </div>
                <div class="card-body">
                 {{ $userCount }}
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-danger">
                  <i style="font-size: 30px" class="fas fa-user-nurse"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Not Verified</h4>
                </div>
                <div class="card-body">
                  {{ $userNotVerified }}
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-warning">
                  <i style="font-size: 30px" class="fas fa-pills"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Rule | Chapter</h4>
                </div>
                <div class="card-body">
                  {{ $ruleCount }}
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-sm-12 col-12">
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
  
    </div>
{{-- 
    <div class="row">
      <div class="col-12 col-md-8 col-lg-8">
        <div class="card">
          <div class="card-header">
            <h4>Line Chart</h4>
          </div>
          <div class="card-body">
            <canvas id="myChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-lg-4">
       
          <div class="card card-hero">
            <div class="card-header">
              <div class="card-icon">
                <i class="far fa-question-circle"></i>
              </div>
              <h4>14</h4>
              <div class="card-description">Customers need help</div>
            </div>
            <div class="card-body p-0">
              <div class="tickets-list">
                <a href="#" class="ticket-item">
                  <div class="ticket-title">
                    <h4>My order hasn't arrived yet</h4>
                  </div>
                  <div class="ticket-info">
                    <div>Laila Tazkiah</div>
                    <div class="bullet"></div>
                    <div class="text-primary">1 min ago</div>
                  </div>
                </a>
                <a href="#" class="ticket-item">
                  <div class="ticket-title">
                    <h4>Please cancel my order</h4>
                  </div>
                  <div class="ticket-info">
                    <div>Rizal Fakhri</div>
                    <div class="bullet"></div>
                    <div>2 hours ago</div>
                  </div>
                </a>
                <a href="#" class="ticket-item">
                  <div class="ticket-title">
                    <h4>Do you see my mother?</h4>
                  </div>
                  <div class="ticket-info">
                    <div>Syahdan Ubaidillah</div>
                    <div class="bullet"></div>
                    <div>6 hours ago</div>
                  </div>
                </a>
                <a href="features-tickets.html" class="ticket-item ticket-more">
                  View All <i class="fas fa-chevron-right"></i>
                </a>
              </div>
            </div>
          </div>
      </div>
    </div> --}}
    
</section>
@endsection

@section('moreJs')
<script src="{{ asset('adminstyle/assets/modules/chartjs/chart.min.js') }}"></script>
<script>
  "use strict";

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    datasets: [{
      label: 'Statistics',
      data: [460, 458, 330, 502, 430, 610, 488],
      borderWidth: 2,
      backgroundColor: '#6777ef',
      borderColor: '#6777ef',
      borderWidth: 2.5,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: 150
        }
      }],
      xAxes: [{
        ticks: {
          display: false
        },
        gridLines: {
          display: false
        }
      }]
    },
  }
});

var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    datasets: [{
      label: 'Statistics',
      data: [460, 458, 330, 502, 430, 610, 488],
      borderWidth: 2,
      backgroundColor: '#6777ef',
      borderColor: '#6777ef',
      borderWidth: 2.5,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: 150
        }
      }],
      xAxes: [{
        ticks: {
          display: false
        },
        gridLines: {
          display: false
        }
      }]
    },
  }
});

var ctx = document.getElementById("myChart3").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    datasets: [{
      data: [
        80,
        50,
        40,
        30,
        20,
      ],
      backgroundColor: [
        '#191d21',
        '#63ed7a',
        '#ffa426',
        '#fc544b',
        '#6777ef',
      ],
      label: 'Dataset 1'
    }],
    labels: [
      'Black',
      'Green',
      'Yellow',
      'Red',
      'Blue'
    ],
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
  }
});

var ctx = document.getElementById("myChart4").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    datasets: [{
      data: [
        80,
        50,
        40,
        30,
        100,
      ],
      backgroundColor: [
        '#191d21',
        '#63ed7a',
        '#ffa426',
        '#fc544b',
        '#6777ef',
      ],
      label: 'Dataset 1'
    }],
    labels: [
      'Black',
      'Green',
      'Yellow',
      'Red',
      'Blue'
    ],
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
  }
});
</script>
@endsection