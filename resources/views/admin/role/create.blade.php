@extends('admin_layouts.app')
@section('admin_content')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-switch@3.4.0/dist/css/bootstrap3/bootstrap-switch.min.css">
@endpush


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Add role</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('store.role') }}" method="post" >
        @csrf
       	<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Role</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInputEmail1">Employee Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}"  required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInputPassword1">Employee Email <span class="text-danger">*</span> </label>
                      <input type="email" class="form-control" value="{{ old('email') }}" name="email" required="">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInputPassword1">Password <span class="text-danger">*</span> </label>
                      <input type="password" class="form-control" value="{{ old('password') }}" name="password" required="">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-3">
                        <h6 class="mb-3 mt-3">User Role</h6>
                       <input type="checkbox" name="userrole" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                    <div class="col-3">
                      <h6 class="mb-3 mt-3">Category</h6>
                     <input type="checkbox" name="category" value="1"  checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                   </div>

                    <div class="col-3">
                        <h6 class="mb-3 mt-3">Product</h6>
                       <input type="checkbox" name="product" value="1"  checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                    <div class="col-3">
                        <h6 class="mb-3 mt-3">Offer</h6>
                       <input type="checkbox" name="offer" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                   
                  </div>

                  <div class="row">
                  	<div class="col-3">
                        <h6 class="mb-3 mt-3">Pickuppoint</h6>
                       <input type="checkbox" name="pickup" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                    <div class="col-3">
                        <h6 class="mb-3 mt-3">Tickets</h6>
                       <input type="checkbox" name="ticket" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                    <div class="col-3">
                        <h6 class="mb-3 mt-3">Contact</h6>
                       <input type="checkbox" name="contact" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                    <div class="col-3">
                        <h6 class="mb-3 mt-3">Report</h6>
                       <input type="checkbox" name="report" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-3">
                        <h6 class="mb-3 mt-3">Setting</h6>
                       <input type="checkbox" name="setting" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                    <div class="col-3">
                        <h6 class="mb-3 mt-3">blog</h6>
                       <input type="checkbox" name="blog" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>
                    <div class="col-3">
                      <h6 class="mb-3 mt-3">Order</h6>
                     <input type="checkbox" name="order" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                  </div>
                  </div>
                    
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <button class="btn btn-info btn-lg ml-2" type="submit">Submit</button>
           </div>
            <!-- /.card -->

           
         </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@push('js')
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
 <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@endpush

@endsection