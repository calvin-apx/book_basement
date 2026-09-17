<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <title>@yield('title','laravel')</title>
  <!-- Bootstrap core CSS -->
    <link  href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link  href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">


  <!-- Custom styles for this template -->
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  @yield('js-headers')
  @yield('css')

</head>
<body>
    {{-- Top Navigator --}}
    @include('bookbasement.layouts.navigator.top_nav')

      <div class="container-fluid">
        <div class="row">

            @include('bookbasement.layouts.navigator.side_nav')

            @yield('content')

        </div>
      </div>
      @include('bookbasement.layouts.footer')
</body>
</html>
