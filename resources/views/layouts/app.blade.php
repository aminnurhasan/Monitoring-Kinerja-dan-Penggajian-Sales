<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Codepolitan Attendance</title>

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

    {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Date Range Picker -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}"/> --}}

    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css"> --}}

    @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
<div class="wrapper">

    <!-- Navbar -->
    @include('layouts._navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AttLive</span>
      </a>

      <!-- Sidebar -->
      @include('layouts._sidebar')
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

    <!-- Scripts -->    
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    <!-- DATATABLES -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Switch -->
    <script src="{{ asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}

    <!-- Date Range Picker -->
    {{-- <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}

    <!-- Charting library -->
    {{-- <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script> --}}
    <!-- Chartisan -->
    {{-- <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script> --}}

    {{-- <script type="text/javascript">
        $(document).ready(function(){

            // Format mata uang.
            $( '.gajiPokok' ).mask('000.000.000', {reverse: true});

        })
    </script> --}}

    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false,
        });

        // $("#reservation").daterangepicker();

      //   $(document).ready(function() {
      //     $('#datepicker').datepicker({
      //         format: 'yyyy-mm-dd', // Format tampilan tanggal
      //         autoclose: true, // Menutup datepicker setelah pemilihan tanggal
      //         todayHighlight: true, // Mencetak tanggal hari ini
      //     });
      // });

      });

      $('.tanggalAwal').datepicker({
          format: 'yyyy-mm-dd',
      });
      $('.tanggalAkhir').datepicker({
          format: 'yyyy-mm-dd',
      });

      // $( ".tanggalAwal" ).datepicker({
      //   dateFormat: "yyyy-mm-dd"
      // }); 
      // $( ".tanggalAkhir" ).datepicker({
      //   dateFormat: "yyyy-mm-dd"
      // }); 
        
        // $("#date").datepicker();

        // $("#datepicker").datepicker();
    </script>
    {{-- <script type="text/javascript">
          $(document).ready(function(){

              // Format mata uang.
              $( '.uang' ).mask('000.000.000', {reverse: true});

          })
      </script> --}}

    {{-- <script type="text/javascript">
		
      var gajiPokok = document.getElementById('gajiPokok');
      gajiPokok.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        gajiPokok.value = formatRupiah(this.value, 'Rp. ');
      });
  
      /* Fungsi formatRupiah */
      function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        gajiPokok     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
  
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
          separator = sisa ? '.' : '';
          gajiPokok += separator + ribuan.join('.');
        }
  
        gajiPokok = split[1] != undefined ? gajiPokok + ',' + split[1] : gajiPokok;
        return prefix == undefined ? gajiPokok : (gajiPokok ? 'Rp. ' + gajiPokok : '');
      }
    </script> --}}

    {{-- <script type="text/javascript">
		
      var bonusInsentif = document.getElementById('bonusInsentif');
      bonusInsentif.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        bonusInsentif.value = formatRupiah(this.value, 'Rp. ');
      });
  
      /* Fungsi formatRupiah */
      function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        bonusInsentif     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
  
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
          separator = sisa ? '.' : '';
          bonusInsentif += separator + ribuan.join('.');
        }
  
        bonusInsentif = split[1] != undefined ? bonusInsentif + ',' + split[1] : bonusInsentif;
        return prefix == undefined ? bonusInsentif : (bonusInsentif ? 'Rp. ' + bonusInsentif : '');
      }
    </script> --}}

    {{-- <script>
        document.getElementById('tanggalAwal').addEventListener('change', function() {
            var inputDate = this.value;
            var formattedDate = formatDate(inputDate);
            this.value = formattedDate;
        });

        function formatDate(date) {
            var dateObj = new Date(date);
            var day = dateObj.getDate();
            var month = dateObj.getMonth() + 1;
            var year = dateObj.getFullYear();

            // Menambahkan angka 0 di depan tanggal dan bulan jika hanya satu digit
            if (day < 10) {
                day = '0' + day;
            }
            if (month < 10) {
                month = '0' + month;
            }

            var formattedDate = year + '-' + month + '-' + day;
            return formattedDate;
        }
    </script> --}}

    @stack('scripts')
    @livewireScripts
</body>
</html>
