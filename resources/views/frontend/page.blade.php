@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('fronted') }}/styles/shop_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('fronted') }}/styles/shop_responsive.css">
@endpush
@section('fronted_content')
    @include('layouts.front_partial.collaps_nav')

    <!-- Home -->

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
        <div class="home_overlay"></div>
        <div class="home_content d-flex flex-column align-items-center justify-content-center">
            <h2 class="home_title">{{ $page->page_title}}</h2>
        </div>
    </div>
    <!-- Shop -->
    <div class="shop">
        <div class="container">
            <div class="row">
                {!! $page->page_description !!}
            </div>
        </div>
    </div>
<hr class="">
<hr class="">

    
  

    @push('js')
        <script src="{{ asset('fronted') }}/js/shop_custom.js"></script>
    @endpush
@endsection
