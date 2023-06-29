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

        <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
        <!-- JQUERY UI -->
        <link rel="stylesheet" href="{{asset('/assets/plugins/jquery-ui/jquery-ui.min.css')}}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{asset('/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{asset('/assets/plugins/toastr/toastr.min.css')}}">

        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/assets/css/adminlte.min.css')}}">

        <!-- DevExtrem CSS -->
        <link rel="stylesheet" href="{{asset('/assets/plugins/devextreme_v21_2_6/dx.light.css')}}">
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
    <script src="{{asset('/assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{asset('/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('/assets/plugins/toastr/toastr.min.js')}}"></script>
    <!-- DevExtrem JS -->
    <script type="text/javascript" src="{{asset('/assets/plugins/devextreme_v21_2_6/dx.all.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/assets/js/adminlte.min.js')}}"></script>
    <script src="{{asset('/assets/js/common.js?v1.0.0.3')}}"></script> 
    <script>

        function format_AOA(num) {
            return new Intl.NumberFormat('pt-AO', { minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(num);
        }
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $(".table-list").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $(".table-home").DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script> 
    <script>
    $(function () {
        $.ajax({
            type: "GET",
            url: '/me?route={{ Route::currentRouteName() }}',
            data: {}
        }).done(function(user) {
            //console.log(user);
            if(user.menu_itens) {
                $itens = "";
                $.each(user.menu_itens, function( index, menu ) {
                    $itens += buildItens(menu)
                });
            }
            $('#dinamic-side-menu').append($itens);
        });
        
        function buildItens(menu, callback="") {
            if(menu.tipo == 'collapse') {
                if(menu.tem_filho_activo) {
                    callback+="<li class='nav-item menu-open'>";
                } else {
                    callback+="<li class='nav-item'>";
                }
                if(menu.activo) {
                    callback+="<a href='"+menu.link+"' class='nav-link active'>";
                } else {
                    callback+="<a href='"+menu.link+"' class='nav-link'>";
                }
                callback+="<i class='nav-icon "+menu.icone+"'></i>";
                callback+="<p>"+menu.nome+"";
                callback+="<i class='right fas fa-angle-left'></i>";
                callback+="</p>";
                callback+="</a>";
                if(menu.childs.length > 0) {
                    callback+="<ul class='nav nav-treeview'>";
                    $.each(menu.childs, function(index, submenu) {
                        callback += buildItens(submenu)
                    });
                    callback+="</ul>";
                }
                callback+="</li>";
            } else {
                callback+="<li class='nav-item'>";
                if(menu.activo) {
                    callback+="<a href='"+menu.link+"' class='nav-link active'>";
                } else {
                    callback+="<a href='"+menu.link+"' class='nav-link'>";
                }
                callback+="<i class='nav-icon "+menu.icone+"'></i>";
                callback+="<p>"+menu.nome+"</p>";
                callback+="</a>";
                callback+="</li>";
            }
            return callback;
        }
    });
    </script>
    @yield('footer-scripts')
    </body>
</html>
