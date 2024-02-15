@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
     <!--Dropify-->
     {{-- <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/dist/css/dropify.min.css"> --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"/>
    @endpush
    
    @extends('admin_layouts.app')
    
    @section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Contact</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Contact Message</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="" class="table table-bordered table-striped table-sm ytable">
                        <thead>
                            <tr>
                                <th>SL/No.</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($contact as $key=>$row)
                            <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->message}}</td>
                            <td>
                                @if($row->status ==1)
                                <span class="badge badge-success">Reply</span>
                                @else
                                <span class="badge badge-danger">Not Reply</span>
                                @endif 
                                
                            </td>
                            <td>
                                <a href="{{route('admin.contact.show', $row->id)}}" class="btn btn-info btn-sm mx-1 my-1"><i class="fa-solid fa-comment-dots"></i></a>
                                        
                                <a href="" data-id="{{$row->id}}" class="btn btn-warning btn-sm mx-1 my-1 edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-solid fa-pen-to-square"></i></i></a>

                                <a href="{{route('contact.delete', $row->id)}}" class="btn btn-danger btn-sm mx-1 my-1 delete" id=""><i class="fa-sharp fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>SL/No.</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
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
    <!-- /.content-header -->

{{-- Brand insert modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Brand</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="brand_name" class="form-label @error('brand_name') is-invalid @enderror">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" id="" required>
                            @error('brand_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brand_logo" class="form-label">Brand logo</label>
                            <input type="file" class="form-control dropify" data-height="140" data-show-loader="false" data-show-errors="true" data-allowed-file-extensions="jpeg jpg webp png" data-show-remove="true" data-max-file-size-preview="2M" name="brand_logo" id="input-file-now" required>
                            <small id="emailHelp" class="form-text text-muted">This is your brand logo</small>
                            @error('brand_logo')
                               <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="front_page" class="form-label">Home Page</label>
                            <select name="front_page" class="form-control" id="">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span class="d-none">loading....... </span>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Childcategory edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Brand</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
        messages: {
            'default': 'click Here',
            'replace': 'Drag and drop to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong.'
        }
    });
    </script>
    {{-- Category edit ajax --}}
    <script type="text/javascript">
        $(function childcategory() {
            var table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('brand.index') }}",
                columns: [{
                        data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {   data: 'brand_name', name: 'brand_name' },
                    {   data: 'front_page', name: 'front_page' },
                    {   data: 'brand_logo', name: 'brand_logo', render: function(data, type, full, meta){
                        return "<img src=\""+data+"\" height=\"40\" width=\"70\" />";
                    } },
                    {   data: 'action', name: 'action', orderable: true, searchable: true },
                ]
            });
        });


        // -- Category edit ajax --
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            // alert(id);
            $.get("brand/edit/" + id, function(data) {
                $("#modal_body").html(data);
            });
        });
    </script>
<!--Dropify-->


  
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
