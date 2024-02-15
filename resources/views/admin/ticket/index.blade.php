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
                    <h1 class="m-0">Ticket List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Ticket List</h3>
            </div>
            <div class=" row p-2 mt-2">
                <div class="form-group col-3">
                  <label>Ticket Type</label>
                  <select class="form-control submitable" name="type" id="type">
                    <option value="">All</option>
                    <option value="Technical">Technical</option>
                        <option value="Payment">Payment</option>
                        <option value="Affiliate">Affiliate</option>
                        <option value="Return">Return</option>
                        <option value="Refund">Refund</option> 
                  </select>
                </div>
                <div class="form-group col-3">
                  <label>Status</label>
                  <select class="form-control submitable" name="status" id="status">
                        <option value="0">Pending</option>
                        <option value="1">Replied</option>
                        <option value="2">Closed</option>
                  </select>
                </div>
                <div class="form-group col-3">
                    <label>Date</label>
              		  <input type="date" name="date" id="date" class="form-control submitable_input">
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                        <tr>
                          <th>SL/NO.</th>
                          <th>User</th>
                          <th>Subject</th>
                          <th>Service</th>
                          <th>Priority</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody> 

                    </tbody>

                    <tfoot>
                      <tr>
                        <th>SL/NO.</th>
                        <th>User</th>
                        <th>Subject</th>
                        <th>Service</th>
                        <th>Priority</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                </table>

                <form id="deleted_form" action="" method="post">
                  @method('DELETE')
                  @csrf
              </form>
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
    $(function tickets() {
        table = $('.ytable').DataTable({
        "processing":true,
        "serverSide":true,
        "searching":true,
        "ajax":{
        "url": "{{ route('ticket.index') }}", 
        "data": function(e) {
        e.type =$("#type").val();
        e.status =$("#status").val();
        e.date =$("#date").val();
    }
  },
            columns: [
                {   data: 'DT_RowIndex', name: 'DT_RowIndex' },
                {   data: 'name', name: 'name' },
                {   data: 'subject', name: 'subject' },
                {   data: 'service', name: 'service' },
                {   data: 'priority', name: 'priority' },
                {   data: 'date', name: 'date' },
                {   data: 'status', name: 'status' },
                {   data: 'action', name: 'action', orderable: true, searchable: true },
            ]
        });
    });


</script>

<script>
      $(document).ready(function(){
	      $(document).on('click', '#delete_ticket',function(e){
            e.preventDefault();
            var url = $(this).attr('href'); 
            $("#deleted_form").attr('action',url); 
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
              if (willDelete) {
                 $("#deleted_form").submit();
              } else {
                 swal("Your imaginary file is safe!");
              }
            });
         });

        //data passed through here
        $('#deleted_form').submit(function(e){
          e.preventDefault();
          var url = $(this).attr('action');
          var request =$(this).serialize();
          $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
              toastr.success(data);
              $('#deleted_form')[0].reset();
               table.ajax.reload();
            }
          });
        });
    });

  



	//submitable class call for every change
  $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });

  $(document).on('change','.submitable_input', function(){
    $('.ytable').DataTable().ajax.reload();
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
