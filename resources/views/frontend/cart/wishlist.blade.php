@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('fronted')}}/styles/cart_responsive.css">
<style>
    .custom_css{
        width: 100px !important;
    }
    .close_item{
       padding-top: 0% !important;
    }
</style>

@section('fronted_content')
@include('layouts.front_partial.collaps_nav')


<div class="cart_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 ">
                <div class="cart_container">
                    <div class="cart_title">Your Wishlist Item</div>
                      <div class="cart_items">
                        <ul class="cart_list">

                            @foreach($wishlist as $row)
                            
                            <li class="cart_item clearfix">
                                
                                <div class="cart_item_image mt-3">
                                     <img src="{{ asset('backend/files/product/'.$row->thumbnail) }}" width="70%" height="70%" alt="">
                                </div>
                                <div class=" d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_text">{{ $row->name }}</div>
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_text">
                                            {{$row->date}}
                                        </div>
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <a href="{{ route('product.details', $row->slug) }}" class="cart_item_text btn btn-primary text-white">Add to Cart</a>
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <a href="{{ route('wishlistproduct.delete', $row->id) }}" class="cart_item_text btn btn-outline-danger"><i class="fa-solid fa-xmark"></i></a>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                            
                        </ul>
                    </div>
                    <div class="cart_buttons">
                        <a href="{{ route('clear.wishlist') }}" class="cart_button_clear btn-lg btn btn-outline-danger">Clear Wishlist</a>
                        <a href="{{ url('/') }}" class="cart_button_clear btn-lg btn btn-primary text-white">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

