@extends('layouts.app')
@section('fronted_content')
<link rel="stylesheet" type="text/css" href="{{ asset('fronted') }}/styles/blog_single_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('fronted') }}/styles/blog_single_responsive.css">
@include('layouts.front_partial.collaps_nav')

<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('fronted') }}/images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Blog Details</h2>
		</div>
	</div>

	<!-- Single Blog Post -->

	<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title">{{$blog->title}}</div>
                    {{-- <span>{{$blog->blog_categories->category_name}}</span> --}}
                    <span>{{$blog->blog_name}}</span>
					<div class="single_post_text">
                        <div><img src="{{asset('fronted')}}/images/quote.png" width="100%" height="180px" alt=""></div>
						<p class="mt-4" style="text-align: justify">{{$blog->description}}</p>

						<div class="single_post_quote text-center">
							<div class="quote_image"><img src="{{asset('fronted')}}/images/quote.png" alt=""></div>
							<div class="quote_text">Quisque sagittis non ex eget vestibulum. Sed nec ultrices dui. Cras et sagittis erat. Maecenas pulvinar, turpis in dictum tincidunt, dolor nibh lacinia lacus.</div>
							{{-- <div class="quote_name">{{$blog->user_id}}</div> --}}
                            <p><a href=""></a>{{$blog->tag}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blog Posts -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url({{asset('fronted')}}/images/blog_4.jpg)"></div>
							<div class="blog_text">Etiam leo nibh, consectetur nec orci et, tempus tempus ex</div>
							<div class="blog_button"><a href="">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url({{asset('fronted')}}/images/blog_5.jpg)"></div>
							<div class="blog_text">Sed viverra pellentesque dictum. Aenean ligula justo, viverra in lacus porttitor</div>
							<div class="blog_button"><a href="">Continue Reading</a></div>
						</div>

						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url({{asset('fronted')}}/images/blog_6.jpg)"></div>
							<div class="blog_text">In nisl tortor, tempus nec ex vitae, bibendum rutrum mi. Integer tempus nisi</div>
							<div class="blog_button"><a href="">Continue Reading</a></div>
						</div>

					</div>
				</div>	
			</div>
		</div>
	</div>


<script src="{{asset('fronted')}}/js/blog_single_custom.js"></script>
@endsection