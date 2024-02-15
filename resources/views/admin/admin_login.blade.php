@extends('admin_layouts.admin')

@section('admin_content')
    <div class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ url('/') }}" class="h1"><b>Admin</b>OneTech</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Admin Login Panel</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email" id="email" name="email" :value="old('email')" autofocus
                                autocomplete="username" :value="__('Email')">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="current-password" :value="__('Password')">
                            <div class="input-group-append">
                                <div class="input-group-text"> <span class="fas fa-lock"></span></div>
                            </div>
                        </div>
                            @error('password')
                                <span class="alert alert-danger ">{{ $message }}</span>
                            @enderror
                            
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember_me" name="remember">
                                    <label for="remember_me">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </form>

                    <!-- /.social-auth-links -->

                    <p class="mb-1">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                Forgot your password
                            </a>
                        @endif
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->
    </div>
@endsection
