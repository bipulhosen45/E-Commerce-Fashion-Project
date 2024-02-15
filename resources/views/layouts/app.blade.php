<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/styles/bootstrap4/bootstrap.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/plugins/fontawesome-free-5.0.1\css/fontawesome-all.css"> --}}

<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/styles/responsive.css">

<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/styles/product_responsive.css">
<!--Toastr notification -->
{{-- <script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>

@stack('css')

<!--sweetalert2 notification -->
{{-- <script src="{{ asset('backend') }}/plugins/sweetalert2/sweetalert2.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</head>

<body>

<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-row">
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/phone.png" alt=""></div>{{ $setting->phone_one }}</div>
                        <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/mail.png" alt=""></div><a href="mailto:{{ $setting->main_email }}">{{ $setting->main_email }}</a></div>
                        <div class="top_bar_content ml-auto">
                           
                            @if(Auth::check())
                            <div class="top_bar_menu">
                                <ul class="standard_dropdown top_bar_dropdown" >
                                    <li>
                                        <a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
                                        <ul style="width:200px;">
                                            <li><a href="{{ route('home') }}">Profile</a></li>
                                            <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                                        </ul>
                                    </li>
                                  
                                </ul>
                            </div>
                            @endif

                            @guest
                            <div class="top_bar_menu">
                                <ul class="standard_dropdown top_bar_dropdown">
                                    <li>
                                        <a href="#">Login<i class="fas fa-chevron-down"></i></a>
                                        <ul style="width:300px; margin-left: -115px;" class="p-4 rounded">
                                           <div>
                                            <strong>Login your account</strong><br>
                                            <br>
                                               <form action="{{ route('login') }}" method="post">
                                                @csrf
                                                   <div class="form-group">
                                                       <label>Email Address</label>
                                                       <input type="email" class="form-control form-control-sm" name="email" autocomplete="off" required="">
                                                   </div>
                                                   <div class="form-group">
                                                       <label>Password</label>
                                                       <input type="password" class="form-control form-control-sm" name="password" required="">
                                                   </div>
                                                   <div class="form-group row">
                                                       <div class="offset-md-2">
                                                           <div class="form-check">
                                                               <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                               <label class="form-check-label" for="remember">
                                                                   {{ __('Remember Me') }}
                                                               </label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <button type="submit" class="btn btn-sm btn-info">Login</button>
                                                   </div>
                                               </form>
                                               <div class="social-auth-links text-center mt-2 mb-3">
                                                <a href="#" class="btn btn-block btn-sm btn-primary" style="width: 100%; height: 40px;">
                                                  <p class="justify-content-center text-light mt-1" style="margin-top: ">
                                                    <i class="fa fa-facebook"></i> Sign in using Facebook
                                                </p>
                                                </a>
                                                <a href="{{route('social.oauth', 'google')}}" class="btn btn-block btn-sm btn-danger" style="width: 100%; height: 40px;">
                                                    <p class="justify-content-center text-light mt-1" style="margin-top: ">
                                                        <i class="fa fa-google-plus"></i> Sign in using Google+
                                                    </p>
                                                </a>
                                              </div>

                                           </div>
                                        </ul>
                                    </li>
                                    <li>
                                    <a href="{{ route('register') }}">Register</a>
                                    </li>
                                </ul>
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>      
        </div>

		<!-- Header Main -->

            <div class="header_main">
                <div class="container">
                    <div class="row">
    
                        <!-- Logo -->
                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                            <div class="logo_container">
                                <div class="logo"><a href="{{url('/')}}">OneTech</a></div>
                            </div>
                        </div>
    
                        <!-- Search -->
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form action="#" class="header_search_form clearfix">
                                            <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
                                            <div class="custom_dropdown">
                                                <div class="custom_dropdown_list">
                                                    <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                    <i class="fas fa-chevron-down"></i>
                                                    <ul class="custom_list clc">
                                                        <li><a class="clc" href="#">All Categories</a></li>
                                                        <li><a class="clc" href="#">Computers</a></li>
                                                        <li><a class="clc" href="#">Laptops</a></li>
                                                        <li><a class="clc" href="#">Cameras</a></li>
                                                        <li><a class="clc" href="#">Hardware</a></li>
                                                        <li><a class="clc" href="#">Smartphones</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('fronted')}}/images/search.png" alt=""></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        @php
                            $wishlist=DB::table('wishlist')->where('user_id',Auth::id())->count();
                        @endphp

                        <!-- Wishlist -->
                        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                            <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                    <div class="wishlist_icon"><img src="{{asset('fronted')}}/images/heart.png" alt=""></div>
                                    <div class="wishlist_content">
                                        <div class="wishlist_text"><a href="{{route('wishlist')}}">Wishlist</a></div>
                                        <div class="wishlist_count">{{ $wishlist }}</div>
                                    </div>
                                </div>
    
                                <!-- Cart -->
                                <div class="cart">
                                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                        <div class="cart_icon">
                                            <img src="{{asset('fronted')}}/images/cart.png" alt="">
                                            <div class="cart_count"><span>{{ Cart::count() }}</span></div>
                                        </div>
                                        <div class="cart_content">
                                            <div class="cart_text"><a href="{{route('cart')}}">Cart</a></div>
                                            <div class="cart_price">{{$setting->currency}} {{ Cart::total() }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Navigation -->

          

            <!-- Menu -->

            @yield('navbar')
    
        </header>
        
        @yield('fronted_content')
        <!-- Footer -->
    @php
        $page_one = DB::table('pages')->where('page_position', 1)->get();
        $page_two = DB::table('pages')->where('page_position', 2)->get();
    @endphp
        <footer class="footer">
            <div class="container">
                <div class="row">
    
                    <div class="col-lg-3 footer_col">
                        <div class="footer_column footer_contact">
                            <div class="logo_container">
                                <div class="logo"><a href="{{url('/')}}">
                                    <img src="{{asset($setting->favicon)}}" width="300" height="100" alt=""></a></div>
                            </div>
                            <div class="footer_title">Got Question? Call Us 24/7</div>
                            <div class="footer_phone">{{$setting->phone_one}}</div>
                            <div class="footer_contact_text">
                                <p>{{$setting->address}}</p>
                            </div>
                            <div class="footer_social">
                                <ul>
                                    <li><a href="{{$setting->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{$setting->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="{{$setting->linkedin}}" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="{{$setting->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="{{$setting->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-lg-2 offset-lg-2">
                        <div class="footer_column">
                            <div class="footer_title">Find it Fast</div>
                            <ul class="footer_list">
                                @foreach ($page_one as $row)
                                <li><a href="{{route('view.page', $row->page_slug)}}">{{$row->page_name}}</a></li>
                                @endforeach
                            </ul>
                            {{-- <div class="footer_subtitle">Gadgets</div>
                            <ul class="footer_list">
                                <li><a href="#">Car Electronics</a></li>
                            </ul> --}}
                        </div>
                    </div>
    
                    <div class="col-lg-2">
                        <div class="footer_column">
                            <ul class="footer_list footer_list_2">
                                @foreach ($page_two as $row)
                                <li><a href="{{route('view.page', $row->page_slug)}}">{{$row->page_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
    
                    <div class="col-lg-2">
                        <div class="footer_column">
                            <div class="footer_title">Customer Care</div>
                            <ul class="footer_list">
                                <li><a href="{{route('home')}}">My Account</a></li>
                                <li><a href="{{route('order.tracking')}}">Order Tracking</a></li>
                                <li><a href="{{route('wishlist')}}">Wish List</a></li>
                                <li><a href="{{ route('blog') }}">Our Blog</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                <li><a href="#">Become a vendor</a></li>
                            </ul>
                        </div>
                    </div>
    
                </div>
            </div>
        </footer>
    
        <!-- Copyright -->
    
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col">
                        
                        <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                            <div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#"  target="_blank"></a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </div>
                            <div class="logos ml-sm-auto">
                                <ul class="logos_list">
                                    <li><a href="#"><img src="{{asset('fronted')}}/images/logos_1.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('fronted')}}/images/logos_2.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('fronted')}}/images/logos_3.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('fronted')}}/images/logos_4.png" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @stack('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="{{asset('fronted')}}/js/jquery-3.3.1.min.js"></script> --}}
    <script src="{{asset('fronted')}}/styles/bootstrap4/popper.js"></script>
    <script src="{{asset('fronted')}}/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="{{asset('fronted')}}/plugins/greensock/TweenMax.min.js"></script>
    <script src="{{asset('fronted')}}/plugins/greensock/TimelineMax.min.js"></script>
    <script src="{{asset('fronted')}}/plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="{{asset('fronted')}}/plugins/greensock/animation.gsap.min.js"></script>
    <script src="{{asset('fronted')}}/plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="{{asset('fronted')}}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="{{asset('fronted')}}/plugins/slick-1.8.0/slick.js"></script>
    <script src="{{asset('fronted')}}/plugins/easing/easing.js"></script>
    <script src="{{asset('fronted')}}/js/custom.js"></script>
    <script src="{{asset('fronted')}}/js/product_custom.js"></script>
    <!--Toastr notification -->
    {{-- <script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script> --}}

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!--sweetalert2 notification -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
           @if (Session::has('message'))
               var type = '{{ Session::get('allert-type', 'info') }}'
               switch (type) {
                   case 'info':
                       toastr.info("{{ Session::get('message') }}");
                       break;
                   case 'success':
                       toastr.success("{{ Session::get('message') }}");
                       break;
                   case 'warning':
                       toastr.warning("{{ Session::get('message') }}");
                       break;
                   case 'error':
                       toastr.error("{{ Session::get('message') }}");
                       break;
               }
           @endif
    </script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=65bc88412bb34700194aa4aa&product=inline-share-buttons' async='async'></script>

  
    </body>
    
    </html>