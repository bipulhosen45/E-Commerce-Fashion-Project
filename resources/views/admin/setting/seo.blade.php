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
                            <li class="breadcrumb-item active">OnPage SEO</li>
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
                                <h3 class="card-title">Your SEO Setting</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('seo.setting.update', $data->id)}}" method="POST" >
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" value="{{$data->meta_title}}" name="meta_title" id="meta_title" placeholder="Meta Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_author">Meta Author</label>
                                        <input type="text" class="form-control @error('meta_author') is-invalid @enderror" value="{{$data->meta_author}}" name="meta_author" id="meta_author" placeholder="Meta Author">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">Meta Tag</label>
                                        <input type="text" class="form-control @error('meta_tags') is-invalid @enderror" value="{{$data->meta_tags}}" name="meta_tags" id="meta_tags" placeholder="Meta Tag">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keyword</label>
                                        <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror" value="{{$data->meta_keyword}}" name="meta_keyword" id="meta_keyword" placeholder="Meta Keyword">
                                        <small class="text-muted">Example: ecommerce,online shop, online market </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" cols="30" rows="3" placeholder="Meta Description">{{$data->meta_description}}</textarea>
                                    </div>

                                    <strong  class="text-center d-flex justify-content-center text-green"> ---- Other Options ---- </strong><br>

                                    <div class="form-group">
                                        <label for="google_verification">Google Verification</label>
                                        <input type="text" class="form-control @error('google_verification') is-invalid @enderror" value="{{$data->google_verification}}" name="google_verification" id="google_verification" placeholder="Google Verification">
                                        <small class="text-muted">Put here only verification code</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="alexa_verification">Alexa Verification</label>
                                        <input type="text" class="form-control @error('alexa_verification') is-invalid @enderror" value="{{$data->alexa_verification}}" name="alexa_verification" id="alexa_verification" placeholder="Alexa Verification">
                                        <small class="text-muted">Put here only verification code</small>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="google_analytics">Google Analytics</label>
                                        <input type="text" class="form-control @error('google_analytics') is-invalid @enderror" value="{{$data->google_analytics}}" name="google_analytics" id="google_analytics" placeholder="Google Analytics">
                                    </div>
                                    <div class="form-group">
                                        <label for="google_adsence">Google Adsence</label>
                                        <input type="text" class="form-control @error('google_adsence') is-invalid @enderror" value="{{$data->google_adsence}}" name="google_adsence" id="google_adsence" placeholder="Google Adsence">
                                    </div>

                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                   
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
