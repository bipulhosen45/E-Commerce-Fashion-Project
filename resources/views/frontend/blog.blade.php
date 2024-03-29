@extends('layouts.app')
@section('fronted_content')
<link rel="stylesheet" type="text/css" href="{{ asset('fronted') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('fronted') }}/styles/blog_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('fronted') }}/styles/blog_responsive.css">
@include('layouts.front_partial.collaps_nav')

<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('fronted') }}/images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Our Blog</h2>
		</div>
	</div>

	<!-- Blog -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
						@foreach ($blog as $row)
						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url({{ asset('fronted') }}/images/blog_1.jpg)"></div>
							<div class="blog_text">{{$row->title}}</div>
							<div class="blog_button"><a href="{{route('blog.details', $row->slug)}}">Continue Reading</a></div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->


	<hr>
@endsection