@push('css')
      <!-- summernote -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/summernote/summernote-bs4.min.css">
@endpush

@extends('admin_layouts.app')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Page Create</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row d-flex justify-content-center">
                    <!-- left column -->
                    <div class="col-md-10">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create a new page</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('page.store')}}" method="POST" >
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="page_position">Page Position</label>
                                        <select name="page_position" class="form-control @error('page_position') is-invalid @enderror" id="page_position">
                                            <option value="">Select Page Position</option>
                                            <option value="1">Line One</option>
                                            <option value="2">Line Two</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="page_name">Page Name</label>
                                        <input type="text" class="form-control @error('page_name') is-invalid @enderror" name="page_name" id="page_name" placeholder="Page Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="page_title">Page Title</label>
                                        <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" id="page_title" placeholder="Page Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="page_description">Page Description</label>
                                        <textarea name="page_description" class="form-control" id="summernote"></textarea>
                                        <small class="text-muted">This data will show on your webpage</small>
                                    </div>
                                    
                                   
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create Page</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('js')
<!-- Summernote -->
<script src="{{asset('backend')}}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function () {
      // Summernote
      $('#summernote').summernote()
    })
  </script>
@endpush