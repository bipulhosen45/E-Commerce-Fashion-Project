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
            <h1 class="m-0">All Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
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
                <h3 class="card-title">All Order List </h3>
              </div><br>
              <div class="row p-2">
              	<div class="form-group col-3">
              		<label>Payment Type</label>
              		 <select class="form-control submitable" name="payment_type" id="payment_type">
              		 	<option value="">All</option>
              		 	<option value="Hand Cash">Hand Cash</option>
  						<option value="Aamarpay">Aamarpay</option>
  						<option value="Paypal">Paypal</option>  
              		 </select>
              	</div>
              	<div class="form-group col-3">
              		<label>Date</label>
              		 <input type="date" name="date" id="date" class="form-control submitable_input">
              	</div>
              	<div class="form-group col-3">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option >All</option>
              		 	    <option value="0">Pending</option>
  							<option value="1">Recieved</option>
  							<option value="2">Shipped</option>
  							<option value="3">Completed</option>
  							<option value="4">Return</option>
  							<option value="5">Canccel</option>
              		 </select>
              	</div>
                <div class="col-3 ">
                    <button class="btn btn-info print float-right mr-4"><span class="loader d-none">Loading......</span>Print</button>
                </div>
              </div>
              
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                        <thead>
                            <tr>
                                <th>SL/NO.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Subtotal ({{ $setting->currency }})</th>
                                <th>Total ({{ $setting->currency }})</th>
                                <th>Payment Type</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    <tbody>

                  
                    </tbody>
                  </table>
                  <form action="" method="delete" id="deleted_form">
                    @csrf @method('DELETE')
                </form>
                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>
{{-- Print js file --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">

	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		      "serverSide":true,
		      "searching":true,
		      "ajax":{
		        "url": "{{ route('report.order.index') }}", 
		        "data":function(e) { 
		          e.status =$("#status").val();
		          e.date =$("#date").val();
		          e.payment_type =$("#payment_type").val();
		        }
		      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'c_name'  ,name:'c_name'},
				{data:'c_phone'  ,name:'c_phone'},
				{data:'c_email'  ,name:'c_email'},
				{data:'subtotal',name:'subtotal'},
				{data:'total',name:'total'},
				{data:'payment_type',name:'payment_type'},
				{data:'date',name:'date'},
				{data:'status',name:'status'},
			]
		});
	});

	//submitable class call for every change
  $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });
  $(document).on('blur','.submitable_input', function(){
      $('.ytable').DataTable().ajax.reload();
  });

 

</script>
@endsection

@push('js')
<script src="{{asset('fronted')}}/others/jasonday-printThis-23be1f8/printThis.js"></script>
<script>
    $('.print').on('click', function (e) {
    e.preventDefault();
    $('.loader').removeClass('d-none');
    $.ajax({
        url:"{{ route('report.order.print') }}",
        type:'get',
        data: {status : $('#status').val(), date: $('#date').val() , payment_type: $('#payment_type').val()},
        success:function(data){
            $('.loader').addClass('d-none');
            $(data).printThis({
                debug: false,                   
                importCSS: true,                
                importStyle: true,                               
                removeInline: false, 
                printDelay: 500,
                header : null,   
                footer : null,
            });
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
