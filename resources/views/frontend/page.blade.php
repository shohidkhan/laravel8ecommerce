@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/shop_responsive.css">

@include('layouts.frontend_partial.collaps_nav')


<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">{{$page->page_name}}</h2>
		</div>
	</div>

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
        <div class="col-lg-6 m-auto">
{!! $page->description !!}
        </div>
			</div>
		</div>
	</div>


@endsection
