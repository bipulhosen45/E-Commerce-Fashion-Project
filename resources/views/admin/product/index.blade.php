 @push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @endpush
    
    @extends('admin_layouts.app')
    
    @section('admin_content')
    @include('sweetalert::alert')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class=" float-sm-right">
                            <a href="{{route('product.create')}}" type="button" class="btn btn-info btn-sm"><i class="fa-sharp fa-solid fa-circle-plus"> </i> Add Product</a>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Product List</h3>
                </div>
                <div class=" row p-2 mt-2">
                    <div class="form-group col-3">
                        <label for="" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-control submitable">
                            <option value="">All</option>
                            @foreach ($category as $row)
                                <option value="{{$row->id}}">{{$row->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="" class="form-label">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control submitable">
                            <option value="">All</option>
                            @foreach ($brand as $row)
                                <option value="{{$row->id}}">{{$row->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="" class="form-label">Warehouse</label>
                        <select name="warehouse" id="warehouse" class="form-control submitable">
                            <option value="">All</option>
                            @foreach ($warehouse as $row)
                                <option value="{{$row->warehouse_name}}">{{$row->warehouse_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control submitable">
                            <option value="1">All</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered table-striped table-sm ytable">
                        <thead>
                            <tr>
                                <th>SL/No.</th>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Brand</th>
                                <th>Featured</th>
                                <th>Today Deal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>SL/No.</th>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Brand</th>
                                <th>Featured</th>
                                <th>Today Deal</th>
                                <th>Status</th>
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
   
@endsection

@push('js')
    {{-- Category edit ajax --}}
    <script type="text/javascript">
        $(function products() {
                table = $('.ytable').DataTable({
                // processing: true,
                // serverSide: true,
                // ajax: "{{ route('product.index') }}",
			"processing":true,
            "serverSide":true,
            "searching":true,
            "ajax":{
            "url": "{{ route('product.index') }}", 
            "data": function(e) {
            e.category_id =$("#category_id").val();
            e.brand_id =$("#brand_id").val();
            e.status =$("#status").val();
            e.warehouse =$("#warehouse").val();
        }
      },
                // ajax: "{{ route('product.index') }}",
                columns: [
                    {   data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {   data: 'thumbnail', name: 'thumbnail' },
                    {   data: 'name', name: 'name' },
                    {   data: 'code', name: 'code' },
                    {   data: 'category_name', name: 'category_name' },
                    {   data: 'subcategory_name', name: 'subcategory_name' },
                    {   data: 'brand_name', name: 'brand_name' },
                    {   data: 'featured', name: 'featured' },
                    {   data: 'today_deal', name: 'today_deal' },
                    {   data: 'status', name: 'status' },
                    {   data: 'action', name: 'action', orderable: true, searchable: true },
                ]
            });
        });

   // -- deactive featured ajax show--
            $('body').on('click', '.deactive_featured', function() {
                    var id = $(this).data('id');
                    // alert(id);
                    var url="{{url('product/not-featured')}}/"+id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data){
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });
   // -- active featured ajax show--
            $('body').on('click', '.active_featured', function() {
                    var id = $(this).data('id');
                    // alert(id);
                    var url="{{url('product/active-featured')}}/"+id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data){
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });

// submitable class call for every change
$(document).on('change', '.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
});
   
  
    </script>

    {{-- -- deactive today_deal ajax show-- --}}
<script>
    $('body').on('click', '.deactive_deal', function() {
                    var id = $(this).data('id');
                    // alert(id);
                    var url="{{url('product/not-today-deal')}}/"+id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data){
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });
   // -- active today_deal ajax show--
            $('body').on('click', '.active_deal', function() {
                    var id = $(this).data('id');
                    // alert(id);
                    var url="{{url('product/active-today-deal')}}/"+id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data){
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });
</script>
{{-- -- deactive status ajax show-- --}}
<script>
     $('body').on('click', '.deactive_status', function() {
                    var id = $(this).data('id');
                    // alert(id);
                    var url="{{url('product/not-status')}}/"+id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data){
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
                });
   // -- active status ajax show--
            $('body').on('click', '.active_status', function() {
                    var id = $(this).data('id');
                    // alert(id);
                    var url="{{url('product/active-status')}}/"+id;
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function(data){
                            toastr.success(data);
                            table.ajax.reload();
                        }
                    });
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
