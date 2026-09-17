@extends('bookbasement.layouts.master')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">Products</h1>

    </div>

    <div class="card mb-5">

        <div class="card-header bg-dark">
          <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
            <a class="nav-link  text-white {{(Route::currentRouteName() == "products.index") ?"active-link-card":""}}" href="{{ route('products.index') }}">Add</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white {{(Route::currentRouteName() == "products.list") ?"active-link-card":""}}" href="{{ route('products.list') }}">List</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
            {{-- process for products add/update/list --}}
            @yield('process')
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            year
          </button>
        </div>
      </div>
    <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
  </main>




@endsection

@section('js')
   <!-- Graphs -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
   <script>
     var ctx = document.getElementById("myChart");
     var myChart = new Chart(ctx, {
       type: 'line',
       data: {
         labels: ["January", "Febraury", "March", "April", "May", "June", "July", "August","September","October",
         "November","December"],
         datasets: [{
           data: [100, 42, 53, 94, 100, 60, 50, 100, 44, 33, 14, 42],
           lineTension: 0,
          backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',

            ],
           borderWidth: 4,
           pointBackgroundColor: '#e60400'
         }]
       },
       options: {
         scales: {
           yAxes: [{
             ticks: {
               beginAtZero: false
             }
           }]
         },
         legend: {
           display: false,
         }
       }
     });
   </script>
@endsection


