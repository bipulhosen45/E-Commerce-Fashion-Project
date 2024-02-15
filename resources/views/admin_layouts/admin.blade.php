

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | OneTech</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend')}}/dist/css/adminlte.min.css">
      <!--Toastr notification -->
      <link rel="stylesheet" href="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.min.css">
      <!--sweetalert2 notification -->
      <script src="https:///cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"></script>
</head>
<body>
  @yield('admin_content')





<!-- jQuery -->
<script src="{{asset('backend')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend')}}/dist/js/adminlte.min.js"></script>
<!--Toastr notification -->
<script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!--sweetalert2 notification -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>

<script>
  $(document).on('click', '#delete', function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      swal({
              title: 'Are you sure you want to delete?',
              text: 'Once Delete, This will be permanently Delete?',
              icon: 'warning',
              buttons: 'true',
              dangerMode: 'true',
          })
          .then((willDelete) => {
              if (willDelete) {
                  window.location.href = link;
              } else {
                  swal('Safe Data!');
              }
          });
  });
</script>

{{-- before logout showing alert --}}
<script>
  $(document).on('click', '#logout', function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      swal({
              title: 'Are you you want to logout?',
              text: '',
              icon: 'warning',
              buttons: 'true',
              dangerMode: 'true',
          })
          .then((willDelete) => {
              if (willDelete) {
                  window.location.href = link;
              } else {
                  swal('Not Logout!');
              }
          });
  });
</script>
<script>
  @if (Session::has('message'))
      var type = "{{ session::get('alert-type', 'info') }}"
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

