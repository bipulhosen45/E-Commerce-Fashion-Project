@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/dist/css/dropify.min.css">
    
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
                        <h1 class="m-0">Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class=" float-sm-right">
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#categoryModal"><i class="fa-sharp fa-solid fa-circle-plus"> </i> Add Category</button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category list </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>SL/No.</th>
                                <th>Category Name</th>
                                <th>Category Slug</th>
                                <th>Icon</th>
                                <th>Home Page</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->category_name }}</td>
                                    <td>{{ $row->category_slug }}</td>
                                    <td>
                                        <img src="{{asset('backend/files/category/'.$row->icon)}}" width="30" height="30" alt="">
                                    </td>
                                    <td>
                                        @if($row->home_page==1)
                                          <span class="badge badge-success">Yes</span>
                                          @else
                                          <span class="badge badge-danger">No</span>
                                          @endif 
                                     </td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm mx-1 my-1"><i class="fa-solid fa-eye"></i></a>
                                        
                                        <a href="" data-id="{{$row->id}}" class="btn btn-warning btn-sm mx-1 my-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-solid fa-pen-to-square"></i></i></a>

                                        <a href="{{route('category.delete', $row->id)}}" class="btn btn-danger btn-sm mx-1 my-1 delete" id=""><i class="fa-sharp fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>SL/No.</th>
                                <th>Category Name</th>
                                <th>Category Slug</th>
                                <th>Icon</th>
                                <th>Home Page</th>
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

    {{-- category edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal_body">
        
            </div>
        </div>
    </div>
</div>

@endsection

{{-- category insert modal --}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category name</label>
                        <input type="text" class="form-control" name="category_name" id="category_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Category Icon</label>
                        <input type="file" class="form-control dropify" name="icon" id="icon" required>
                    </div>
                    <div class="mb-3">
                        <label for="home_page" class="form-label">Home Page</label>
                        <select name="home_page" class="form-control" id="">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    </div>
</div>


@push('js')



   {{-- Category edit ajax --}}
   <script type="text/javascript">
	$('body').on('click','.edit', function(){
		let cat_id=$(this).data('id');
		$.get("category/edit/"+cat_id, function(data){
			 $("#modal_body").html(data);
		});
	});

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
  <script>
        $('.dropify').dropify({
            messages: {
                'default': 'click Here',
                'replace': 'Drag and drop to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong.'
            }
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
