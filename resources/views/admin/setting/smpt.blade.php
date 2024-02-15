@extends('admin.admin_layouts.app')

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
                            <li class="breadcrumb-item active">SMPT Setting</li>
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
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">SMPT Mail Setting</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('smpt.setting.update', $data->id)}}" method="POST" >
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="mailer">Mail Mailer</label>
                                        <input type="text" class="form-control @error('mailer') is-invalid @enderror" value="{{$data->mailer}}" name="mailer" id="mailer" placeholder="Mail Mailer">
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Mail Host</label>
                                        <input type="text" class="form-control @error('host') is-invalid @enderror" value="{{$data->host}}" name="host" id="host" placeholder="Mail Host">
                                    </div>
                                    <div class="form-group">
                                        <label for="port">Mail Port</label>
                                        <input type="text" class="form-control @error('port') is-invalid @enderror" value="{{$data->port}}" name="port" id="port" placeholder="Mail Port">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_name">Mail Username</label>
                                        <input type="text" class="form-control @error('user_name') is-invalid @enderror" value="{{$data->user_name}}" name="user_name" id="user_name" placeholder="User Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mail Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{$data->password}}" name="password" id="password" placeholder="Mail Password">
                                    </div>
                                   
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
