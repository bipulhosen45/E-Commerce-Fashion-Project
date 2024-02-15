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
                        <h1 class="m-0">Pickup Point</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class=" float-sm-right">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addModal"><i class="fa-sharp fa-solid fa-circle-plus"></i> Add Pickup
                                Point</button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pickup Point List Here</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered table-striped table-sm ytable">
                        <thead>
                            <tr>
                                <th>SL/No.</th>
                                <th>Pickup Point Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Another Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>SL/No.</th>
                                <th>Pickup Point Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Another Phone</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    <form action="" method="delete" id="deleted_form">
                        @csrf @method('DELETE')
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.content-header -->


    {{-- coupon insert modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Pickup Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pickuppoint.store') }}" method="POST" id="add_form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pickup_point_name" class="form-label">Pickup Point Name</label> <span class="text-danger text-bold">*</span>
                            <input type="text" name="pickup_point_name" id="" class="form-control"
                                placeholder="Pickup Point Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="pickup_point_address" class="form-label">Address</label> <span class="text-danger text-bold">*</span>
                            <textarea name="pickup_point_address" id="" class="form-control" cols="30" rows="2"
                                placeholder="Pickup Point Address"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pickup_point_phone" class="form-label">Phone</label> <span class="text-danger text-bold">*</span>
                            <input type="number" class="form-control" name="pickup_point_phone" id="pickup_point_phone"
                                placeholder="Coupon Pickup Point Phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="pickup_point_phone_two" class="form-label">Another Phone</label>
                            <input type="number" class="form-control" name="pickup_point_phone_two"
                                id="pickup_point_phone_two" placeholder="Pickup Point Phone Two">
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-danger btn_close" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-primary"><span class="loading d-none">Loading...</span>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- coupon edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pickup Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')


    @push('js')
        {{-- Coupon yaira database ajax --}}
        <script type="text/javascript">
            $(function pickuppoint() {
                table = $('.ytable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pickuppoint.index') }}",
                    columns: [{
                            data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {   data: 'pickup_point_name', name: 'pickup_point_name'},
                        { data: 'pickup_point_address',
                            name: 'pickup_point_address'
                        },
                        {
                            data: 'pickup_point_phone',
                            name: 'pickup_point_phone'
                        },
                        {
                            data: 'pickup_point_phone_two',
                            name: 'pickup_point_phone_two'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            });

            //Coupon store ajax call
            $('#add_form').submit(function(e) {
                e.preventDefault();
                $('.loading').removeClass('d-none');
                var url = $(this).attr('action');
                var request = $(this).serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    async: false,
                    data: request,
                    success: function(data) {
                        toastr.success(data);
                        $('#add_form')[0].reset();
                        $('.loading').addClass('d-none');
                        $('#addModal').modal('hide');
                        table.ajax.reload();
                    }
                });
            });
            //Coupon store ajax call end

            // -- coupon edit ajax show--
               $('body').on('click', '.edit', function() {
                    let id = $(this).data('id');
                    // alert(id);
                    $.get("pickup-point/edit/" + id, function(data) {
                        $("#modal_body").html(data);
                    });
                });






            //    // -- form submit ajax --
            //    $('#add-form').on('submit', function() {
            //     $('.loader').removeClass('d-none');
            //     $('.submit_btn').addClass('d-none');
            // });


            // Ajax request for delete method on page not reload
            $(document).ready(function() {
                $(document).on('click', '#delete_pickuppoint', function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    $("#deleted_form").attr('action', url);
                    // alert(id);
                    swal({
                        title: "Are you sure you want to delete?",
                        icon: "warning",
                        type: "warning",
                        buttons: ["Cancel", "Yes!"],
                        dangerMode: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then((willDelete) => {
                        if (willDelete) {
                            $("#deleted_form").submit();
                        } else {
                            swal("Safe Data!");
                        }
                    });
                    //Data passed through here 
                    $('#deleted_form').submit(function(e) {
                        e.preventDefault();
                        var url = $(this).attr('action');
                        var request = $(this).serialize();
                        $.ajax({
                            url: url,
                            type: 'post',
                            async: false,
                            data: request,
                            success: function(data) {
                                $('#deleted_form')[0].reset();
                                toastr.success(data);
                                table.ajax.reload();
                            }
                        });
                    });
                });
            });
            // Ajax request for delete method on page not reload end
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
        <!-- /DataTables  & Plugins -->
    @endpush
