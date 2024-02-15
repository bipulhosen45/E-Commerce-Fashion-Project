@extends('admin_layouts.app')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    
@endpush

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Products For Campaign</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('campaign.product.list',$campaign_id) }}" class="btn btn-primary"> Product List</a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Products For Campaign</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th>SL/No.</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                      <th>SL/No.</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>

                   @foreach($products as $key=>$row) 
                   @php 
                     $exist=DB::table('campaign_product')->where('campaign_id',$campaign_id)->where('product_id',$row->id)->first();
                   @endphp	
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $row->name }}</td>
                      <td><img src="{{ asset('backend/files/product/'.$row->thumbnail) }}" height="32" width="32"></td>
                      <td>{{ $row->code }}</td>
                      <td>{{ $row->category_name }}</td>
                      <td>{{ $row->brand_name }}</td>
                      <td>{{ $row->selling_price }}</td>
                      <td>
                      	@if($exist)
                      	@else
                      	<a href="{{ route('add.product.to.campaign',[$row->id,$campaign_id]) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-circle-plus"></i></a>
                      	@endif
                      </td>
                    </tr>
                   @endforeach	
                    </tbody>
                  </table>
                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@push('js')
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
@endsection

