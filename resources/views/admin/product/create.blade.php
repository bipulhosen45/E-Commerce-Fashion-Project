@push('css')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/dist/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-switch@3.4.0/dist/css/bootstrap3/bootstrap-switch.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.css">

    <style type="text/css">
        .bootstrap-tagsinput .tag {
          background: #428bca;;
          border: 1px solid white;
          padding: 1 6px;
          padding-left: 2px;
          margin-right: 2px;
          color: white;
          border-radius: 4px;
        }
      </style>
@endpush



@extends('admin_layouts.app')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">New Product</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class=" float-sm-right">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addModal"><i class="fa-sharp fa-solid fa-circle-plus"></i> Add
                                Product</button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <form action="{{route('product.store')}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add New Product </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Name</label> <span class="text-danger text-bold">*</span>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" placeholder="Product Name" >

                                            @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Code</label> <span class="text-danger text-bold">*</span>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{old('code')}}" placeholder="Product Code" >

                                            @error('code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category/Subcategory</label> <span class="text-danger text-bold">*</span>
                                            <select class="form-select @error('subcategory_id') is-invalid @enderror" name="subcategory_id" id="subcategory_id" aria-label="Default select example" >
                                                <option selected>Select Category</option>
                                                @foreach ($category as $row)
                                                    @php
                                                        $subcategory = DB::table('subcategories')->where('category_id', $row->id)->get();
                                                    @endphp
                                                    <option disabled style="color: blue" value="{{ $row->id }}">{{ $row->category_name }}</option>
                                                    @foreach ($subcategory as $row)
                                                        <option value="{{ $row->id }}"> ----{{ $row->subcategory_name }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Child Category</label> <span class="text-danger text-bold">*</span>
                                            <select class="form-control" name="childcategory_id" id="childcategory_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Brand</label> <span
                                                class="text-danger text-bold">*</span>
                                                <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror" id="" {{old('brand_id')}} >
                                                    @foreach ($brand as $row)
                                                    <option value="{{$row->id}}">{{$row->brand_name}}</option>
                                                    @endforeach
                                                </select>

                                                @error('brand_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pickup Point</label>
                                            <select name="pickup_point_id" class="form-control" id="" {{old('pickup_point_id')}} >
                                                @foreach ($pickup_point as $row)
                                                <option value="{{$row->id}}">{{$row->pickup_point_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Unit</label> <span class="text-danger text-bold">*</span>
                                            <input type="text" name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" value="{{old('unit')}}" placeholder="Unit">

                                            @error('unit')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="exampleInputEmail1">Tags</label>
                                                    <input type="text" name="tags" class="form-control" value="{{old('tags')}}" multiple data-role="tagsinput" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Purchase Price</label> <span class="text-danger text-bold">*</span>
                                            <input type="number" class="form-control @error('purchase_price') is-invalid @enderror" name="purchase_price" value="{{old('purchase_price')}}">

                                            @error('purchase_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Selling Price</label> <span class="text-danger text-bold">*</span>
                                            <input type="number" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" value="{{old('selling_price')}}">

                                            @error('selling_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Discount Price</label>
                                            <input type="number" class="form-control" name="discount_price" value="{{old('discount_price')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="warehouse">Warehouse</label> <span
                                                class="text-danger text-bold">*</span>
                                            <select name="warehouse" class="form-control" id="">
                                                @foreach ($warehouse as $row)
                                                <option value="{{$row->warehouse_name}}">{{$row->warehouse_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Stock</label> <span class="text-danger text-bold">*</span>
                                            <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" name="stock_quantity" value="{{old('stock_quantity')}}" placeholder="Stock" >

                                            @error('stock_quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Color</label> <span class="text-danger text-bold">*</span>
                                                    <input type="text" class="form-control @error('color') is-invalid @enderror" data-role="tagsinput" value="{{old('color')}}" multiple name="color" >

                                                    @error('color')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Size</label>
                                                    <input type="text" class="form-control" data-role="tagsinput" value="{{old('size')}}" multiple name="size">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="summernote">Product Details</label>
                                        <textarea rows="8" class="form-control @error('description') is-invalid @enderror" id="summernote" name="description" placeholder="Product Details">{{old('description')}}</textarea>

                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="video">Video Embed Code</label>
                                        <input class="form-control" rows="2" id="video" name="video" placeholder="Only code after embed word" {{old('video')}}>
                                        <span class="text-danger">Only code after embed word</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        <!-- Form Element sizes -->
                        <div class="card card-success">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="form-label">Main Thumbnail</label>
                                    <input type="file" name="thumbnail" class="dropify" accept="image/*" data-allowed-file-extensions="jpeg jpg webp png" ata-show-remove="true" data-max-file-size-preview="2M" id="input-file-now" >
                                </div>
                                <div class="form-group">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <div class="card-header">
                                                <h3 class="card-title">More Images (Click Add For More Image)</h3>
                                            </div>
                                            <tr>
                                                <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>
                                                <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
                                            </tr>
                                        </table>
                                </div>


                                <div class="card p-4">
                                    <h6>Featured Product</h6>
                                   <input type="checkbox" name="featured" value="1"  checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                 </div>
            
                                 <div class="card p-4">
                                    <h6>Today Deal</h6>
                                   <input type="checkbox" name="today_deal" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                 </div>
            
                                 <div class="card p-4">
                                    <h6>Slider Product</h6>
                                   <input type="checkbox" name="product_slider" value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                 </div>
            
                                 <div class="card p-4">
                                    <h6>Trendy Product</h6>
                                   <input type="checkbox" name="trendy" value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                 </div>
            
                                 <div class="card p-4">
                                    <h6>Status</h6>
                                   <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                 </div>

                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- /.card -->
                        </div>
                        {{-- <div class="card-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> --}}
                    </div>
                    <button class="btn btn-info mx-2" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend') }}/plugins/jquery/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>

    <script>
      //ajax request send for collect childcategory
      $("#subcategory_id").change(function(){
      var id = $(this).val();
      $.ajax({
           url: "{{ url("/get-child-category/") }}/"+id,
           type: 'get',
           success: function(data) {
                $('select[name="childcategory_id"]').empty();
                   $.each(data, function(key,data){
                      $('select[name="childcategory_id"]').append('<option value="'+ data.id +'">'+ data.childcategory_name +'</option>');
                });
           }
        });
     });
    </script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

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
    <script>
         $(document).ready(function(){      
       var postURL = "<?php echo url('addmore'); ?>";
       var i=1;  


       $('#add').click(function(){  
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa-solid fa-xmark"></i></button></td></tr>');  
       });  

       $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
       });  
     }); 


    </script>
    <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@endpush
