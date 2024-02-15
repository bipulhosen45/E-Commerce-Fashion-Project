@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@extends('admin_layouts.app')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Campaign</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class=" float-sm-right">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addModal"><i class="fa-sharp fa-solid fa-circle-plus"></i> Add Campaign</button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Campaign List Here</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered table-striped table-sm ytable">
                        <thead>
                            <tr>
                                <th>SL/No.</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Discount(%)</th>
                                <th>image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                        <tfoot>
                            <tr>
                              <th>SL/No.</th>
                              <th>Title</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Discount(%)</th>
                              <th>image</th>
                              <th>Status</th>
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


{{-- category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Campaign</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('campaign.store') }}" method="Post" enctype="multipart/form-data" id="add-form">
      @csrf
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-8">
              <div class="form-group">
                <label for="brand-name">Campaign Title <span class="text-danger">*</span> </label>
                <input type="text" class="form-control"  name="title" required="">
                <small id="emailHelp" class="form-text text-muted">This is campaign title/name </small>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="start-date">Start Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control"  name="start_date" required="">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="End-date">End Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control"  name="end_date" required="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="start-date">Status<span class="text-danger">*</span></label>
                    <select class="form-control" name="status">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="End-date">Discount (%) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control"  name="discount" required="">
                    <small id="emailHelp" class="form-text text-danger">Discount percentage are apply for all prodcut selling price</small>
    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label for="image">Campaign Logo <span class="text-danger">*</span></label>
                <input type="file" class="dropify" data-height="140" id="input-file-now" name="image" required="">
                <small id="emailHelp" class="form-text text-muted">This is your campaign banner </small>
              </div> 
            </div>
          </div>
            
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none"> loading..... </span>  Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="modal_body">
         
     </div>	
    </div>
  </div>
</div>

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

        {{-- campagn yaira database ajax --}}
<script type="text/javascript">
  $(function campaign() {
      table = $('.ytable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('campaign.index') }}",
          columns: [
              { data: 'DT_RowIndex', name: 'DT_RowIndex'},
              { data: 'title', name: 'title'},
              { data: 'start_date', name: 'start_date'},
              { data: 'end_date', name: 'end_date'},
              { data: 'discount', name: 'discount'},
              {data:'image',name:'image', render: function(data, type ,full,meta){
                return "<img src=\"" +data+ "\"  height=\"30\" />";
              }},
              { data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: true, searchable: true},
          ]
      });
  });

       // -- Category edit ajax --
       $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            // alert(id);
            $.get("campaign/edit/" + id, function(data) {
                $("#modal_body").html(data);
            });
        });

  //campaign store ajax call
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
</script>

<script type="text/javascript">
	$('.dropify').dropify({
    messages: {
        'default': 'Clcik Here',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
});
</script>
<script>
            // Ajax request for delete method on page not reload
$(document).ready(function(){
	$(document).on('click', '#delete_campaign',function(e){
     e.preventDefault();
     var url = $(this).attr('href');
     $("#deleted_form").attr('action',url);
        swal({
          title: "Are you sure?",
          text: "Are you sure delete this file!",
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
