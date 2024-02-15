<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | OneTech</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    {{-- <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend') }}/dist/css/adminlte.min.css">
    <!-- sweetalert2 notification -->
    {{-- <link rel="stylesheet" href="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.min.css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">

    <!--Toastr notification -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/toastr/toastr.min.css">
    <!--Bootstrap 5 notification -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- required css file -->
        @stack('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div> --}}

        <!-- Navbar -->
        @guest
        @else
            @include('admin_layouts.partial.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('admin_layouts.partial.sidebar')
        @endguest
        <!-- Content Wrapper. Contains page content -->
        @yield('admin_content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="{{ asset('backend') }}/plugins/jquery/jquery.min.js"></script> --}}
    <script src="{{ asset('backend') }}/plugins/jquery/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!--Toastr notification -->
    <script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script>

    <!--sweetalert2 notification -->
    {{-- <script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


    <!-- overlayScrollbars -->
    <script src="{{ asset('backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend') }}/dist/js/adminlte.js"></script>

    <!-- PAGE {{ asset('backend') }}/PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('backend') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('backend') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('backend') }}/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('backend') }}/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('backend') }}/dist/js/pages/dashboard2.js"></script>
     <!-- required js file -->

     @stack('js')

    <script type="text/javascript">
        // $(document).ready(function() {
            $(document).on('click', '.delete', function(event){
                event.preventDefault();
                var link =  $(this).attr("href");
                swal({
                    title: "Are you sure you want to delete?",
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    type: "warning",
                    buttons: ["Cancel","Yes!"],
                    dangerMode: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    }else{
                        swal("Safe Data!");
                    }
                });
            });
        // });
    </script>

    <script>
        @if (Session::has('message'))
            var type = '{{ Session::get('allert-type', 'info') }}'
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>

</html>
