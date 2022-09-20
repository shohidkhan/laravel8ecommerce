@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/blog_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/blog_responsive.css">
@include('layouts.frontend_partial.collaps_nav')
<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Technological Blog</h2>
		</div>
	</div>

	<!-- Blog -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">

						<!-- Blog post -->
            @foreach ($blogs as  $blog)


						<div class="blog_post">
							<div class="blog_image" style="background-image:url({{ asset('files/blog/') }}/{{ $blog->thumbnail }})"></div>
							<div class="blog_text">{{ $blog->title }}</div>
							<div class="blog_button"><a href="{{ route('blog.details',$blog->slug) }}">Continue Reading</a></div>
						</div>
              @endforeach


					</div>
				</div>

			</div>
		</div>
	</div>
@endsection
