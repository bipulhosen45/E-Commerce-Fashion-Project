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
                            <li class="breadcrumb-item active">Payment Gateway Setting</li>
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
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Aamarpay Payment Gateway</h3>
                            </div>
                            <form action="{{route('aamarpay.update')}}" method="POST" >
                                @csrf
                                <input type="hidden" name="id" id="" value="{{$aamarpay->id}}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="store_id">StoreID</label>
                                        <input type="text" class="form-control" name="store_id" value="{{$aamarpay->store_id}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="signature_key">Signature Key</label>
                                        <input type="text" class="form-control" name="signature_key" value="{{$aamarpay->signature_key}}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="status" value="1" @if ($aamarpay->status==1) checked @endif>
                                        <label for="status">Live Server</label>
                                        <small class="d-block">(If ceckbox are not checked it workingfor sandbox only)</small>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Surjopay Payment Gateway</h3>
                            </div>
                            <form action="{{route('surjopay.update')}}" method="POST" >
                                @csrf
                                <input type="hidden" name="id" id="" value="{{$surjopay->id}}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="store_id">StoreID</label>
                                        <input type="text" class="form-control" name="store_id" value="{{$surjopay->store_id}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="signature_key">Signature Key</label>
                                        <input type="text" class="form-control" name="signature_key" value="{{$surjopay->signature_key}}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="status" value="1" @if ($surjopay->status==1) checked @endif>
                                        <label for="status">Live Server</label>
                                        <small class="d-block">(If ceckbox are not checked it workingfor sandbox only)</small>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">SSL Payment Gateway</h3>
                            </div>
                            <form action="{{route('ssl.update')}}" method="POST" >
                                @csrf
                                <input type="hidden" name="id" id="" value="{{$ssl->id}}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="store_id">StoreID</label>
                                        <input type="text" class="form-control" name="store_id" value="{{$ssl->store_id}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="signature_key">Signature Key</label>
                                        <input type="text" class="form-control" name="signature_key" value="{{$ssl->signature_key}}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="status" value="1" @if ($ssl->status==1) checked @endif>
                                        <label for="status">Live Server</label>
                                        <small class="d-block">(If ceckbox are not checked it workingfor sandbox only)</small>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
