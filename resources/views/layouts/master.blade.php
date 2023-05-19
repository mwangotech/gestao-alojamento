<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIGALO .::. @yield('title')</title>
      
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('/assets/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/assets/css/adminlte.min.css')}}">
    </head>
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">
    

        <!-- Navbar -->
        @include('common.navbar')
        <!-- Main Sidebar Container -->       
        @include('common.aside')
        <!-- Content Area -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('common.header')
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Main Footer -->
        @include('common.footer')
    </div>
    <!-- ./wrapper -->
    
    <!-- REQUIRED SCRIPTS -->
    
    <!-- jQuery -->
    <script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{asset('/assets/js/adminlte.min.js')}}"></script>
    </body>
</html>
