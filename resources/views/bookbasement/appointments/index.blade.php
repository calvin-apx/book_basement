@extends('bookbasement.layouts.master')

@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">Appointments</h1>

    </div>

    <div class="card mb-5">

        <div class="card-header bg-dark">
          <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
            <a class="nav-link  text-white {{(Route::currentRouteName() == "appointments.index") ?"active-link-card":""}}" href="{{ route('appointments.index') }}">list</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
            {{-- process for products add/update/list --}}
            @yield('process')
        </div>
    </div>

  </main>



@endsection
