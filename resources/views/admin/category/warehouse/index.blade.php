@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   
@endpush

@extends('admin_layouts.app')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Warehouse</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class=" float-sm-right">
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addModal"><i class="fa-sharp fa-solid fa-circle-plus"></i> Add
                                Warehouse</button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Warehouse DataTable List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm ytable">
                        <thead>
                            <tr>
                                <th>SL/No.</th>
                                <th>Warehouse Name</th>
                                <th>Warehouse Address</th>
                                <th>Warehouse Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>

                        <tfoot>
                            <tr>
                                <th>SL/No.</th>
                                <th>Warehouse Name</th>
                                <th>Warehouse Address</th>
                                <th>Warehouse Phone</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.content-header -->


    {{-- Warehouse insert modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Warehouse</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('warehouse.store')}}" method="POST" id="add-form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="warehouse_name" class="form-label">Warehouse name</label>
                            <input type="text" class="form-control" name="warehouse_name" id="warehouse_name"
                                required placeholder="Warehouse name">
                        </div>
                    
                        <div class="mb-3">
                            <label for="warehouse_address" class="form-label">Warehouse Address</label>
                            <input type="text" class="form-control" name="warehouse_address" id="warehouse_address"
                                required placeholder="Warehouse Address">
                        </div>
                    
                        <div class="mb-3">
                            <label for="warehouse_phone" class="form-label">Warehouse Phone</label>
                            <input type="number" class="form-control" name="warehouse_phone" id="warehouse_phone"
                                required placeholder="Warehouse phone">
                            <small id="emailHelp" class="form-text text-muted">This is your Warehouse</small>
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span class="d-none loader"><i class="fas fa-spinner"></i> loading.... </span> <span class="submit_btn">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Warehouse edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Warehouse</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    {{-- Category edit ajax --}}
    <script type="text/javascript">
        $(function warehouse() {
            var table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('warehouse.index') }}",
                columns: [{
                        data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {   data: 'warehouse_name', name: 'warehouse_name' },
                    {   data: 'warehouse_address', name: 'warehouse_address' },
                    {   data: 'warehouse_phone', name: 'warehouse_phone' },
                    {   data: 'action', name: 'action', orderable: true, searchable: true },
                ]
            });
        });


     
        // -- warehouse edit ajax --
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            // alert(id);
            $.get("warehouse/edit/"+id, function(data) {
                $("#modal_body").html(data);
            });
        });

           // -- form submit ajax --
           $('#add-form').on('submit', function() {
            $('.loader').removeClass('d-none');
            $('.submit_btn').addClass('d-none');
        });
    </script>
  

      <!-- DataTables  & Plugins -->
      <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/jszip/jszip.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/pdfmake/pdfmake.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/pdfmake/vfs_fonts.js"></script>
      <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      <script>
          $(function() {
              $("#example1").DataTable({
                  "responsive": true,
                  "lengthChange": false,
                  "autoWidth": false,
                  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
              $('#example2').DataTable({
                  "paging": true,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false,
                  "responsive": true,
              });
          });
      </script>
@endpush

