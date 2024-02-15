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
                        <h1 class="m-0">All Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class=" float-sm-right">
                            <a href="{{route('page.create')}}" type="button" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-circle-plus"> </i> Add Page</a>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Page List Here</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>SL/No.</th>
                                <th>Page Name</th>
                                <th>Page Title</th>
                                {{-- <th>Page des</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($page as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->page_name }}</td>
                                    <td>{{ $row->page_title }}</td>
                                    {{-- <td>{{ strip_tags($row->page_description) }}</td> --}}
                                    <td>
                                        <a href="" class="btn btn-info btn-sm mx-1 my-1"><i class="fa-solid fa-eye"></i></a>
                                        
                                        <a href="{{route('page.edit', $row->id)}}" class="btn btn-warning btn-sm mx-1 my-1"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <a href="{{route('page.delete', $row->id)}}" class="btn btn-danger btn-sm mx-1 my-1 delete" id=""><i class="fa-sharp fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>SL/No.</th>
                                <th>Page Name</th>
                                <th>Page Title</th>
                                {{-- <th>Page des</th> --}}
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
@endsection

@push('js')

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
