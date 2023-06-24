<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>SMARTS Web</title>

      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      
      <!-- DATATABLES -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

      <!-- Theme Style -->
      <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}" />

      @livewireStyles
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">

      <!-- Navbar -->
      @include('layouts._navbar')

      <!-- Container Utama -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Logo SMARTS -->
        <a href="{{ route('home') }}" class="brand-link">
          <img src="{{ asset('storage/logo.png') }}" alt="SMARTS Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">SMARTS Web</span>
        </a>

        <!-- Sidebar -->
        @include('layouts._sidebar')
      </aside>

      <!-- Content -->
      <div class="content-wrapper">
          @yield('content')
      </div>

      {{-- Footer --}}
      <footer class="main-footer">
        <strong>Copyright &copy; 2031730131 M. Amin Nur Hasan Bariklana</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Polinema PSDKU Kediri</b>
        </div>
      </footer>

      <aside class="control-sidebar control-sidebar-dark">
      </aside>
    </div>

    <!-- Scripts -->    
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    {{-- FontAwesome --}}
    <script src="https://kit.fontawesome.com/c1a40582b4.js" crossorigin="anonymous"></script>

    <!-- DATATABLES -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Switch -->
    {{-- <script src="{{ asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false,
        });
      });

      $('.tanggalAwal').datepicker({
          format: 'yyyy-mm-dd',
      });

      $('.tanggalAkhir').datepicker({
          format: 'yyyy-mm-dd',
      });
    </script>

    @stack('scripts')
    @livewireScripts
  </body>
</html>
