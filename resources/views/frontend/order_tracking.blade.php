@extends('layouts.app')
@section('fronted_content')
@include('layouts.front_partial.collaps_nav')

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('public/frontend') }}/images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Track Your Order Now</h2>
		</div>
	</div>

	<div class="shop mt-5 mb-5">
		<div class="container">
			<div class="row justify-content-center">
			<div class="col-lg-1"></div>	
			   <div class="card col-lg-8 p-4">
			   	   <form action="{{ route('check.order') }}" method="post">
			   	   	@csrf
			   	   	<div class="form-group">
			   	   		<label>Order ID</label>
			   	   		<input type="text" name="order_id" class="form-control" placeholder="write your order id" required><br>
			   	   		<button class="btn btn-info">Track Now</button>
			   	   	</div>
			   	   </form>
			   </div>	
			 
			</div>
		</div>
	</div>
	<hr>
@endsection