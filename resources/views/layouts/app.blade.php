<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/bootstrap4/bootstrap.min.css">
    <link href="{{asset('frontend')}}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/animate.css">
    <!-- Toastr css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/plugins/slick-1.8.0/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/responsive.css">


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
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/phone.png" alt=""></div>+38 068 005 3570</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#">Language<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">English</a></li>
											<li><a href="#">Bangla</a></li>

										</ul>
									</li>
									<li>
										<a href="#">Currency<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">USD</a></li>
											<li><a href="#">Taka</a></li>
										</ul>
									</li>
								</ul>
							</div>



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
                                          <a href="{{route('login')}}">Login<i class="fas fa-chevron-down"></i></a>

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
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>
@php
$wishlists=DB::table('wishlists')->where('user_id',Auth::id())->count();
@endphp
					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="images/heart.png" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{route('wishlist')}}">Wishlist</a></div>
									<div class="wishlist_count">{{$wishlists}}</div>
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{asset('frontend')}}/images/cart.png" alt="">
										<div class="cart_count"><span class="cart_qty">{{Cart::count()}}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{route('cart')}}">Cart</a></div>
										<div class="cart_price">{{$setting->currency}} <span class="cart_total">{{Cart::total()}}</span> </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->


@yield('navbar')
	</header>

@yield('content')
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
            <form action="{{route('newsletter.store')}}" method="post" class="newsletter_form">
@csrf
              <input type="email" class="newsletter_input" name="email" required="required" placeholder="Enter your email address">
              <button class="newsletter_button">Subscribe</button>
            </form>
            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#"> <img src="{{asset('files/setting/')}}/{{$setting->logo}}" alt=""> </a></div>
						</div>
						<div class="footer_title">Got Question? Call Us 24/7</div>
						<div class="footer_phone">+38 068 005 3570</div>
						<div class="footer_contact_text">
							<p>17 Princess Road, London</p>
							<p>Grester London NW18JR, UK</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="{{$setting->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="{{$setting->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
								<li><a href="{{$setting->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>

							</ul>
						</div>
					</div>
				</div>

        @php
        $pages_one= DB::table('pages')->where('page_position',1)->get();
        $pages_two= DB::table('pages')->where('page_position',2)->get();
        @endphp
				<div class="col-lg-2 offset-lg-2">
					<div class="footer_column">
						<div class="footer_title">Important Links</div>
						<ul class="footer_list">
              @foreach( $pages_one as $row)
							<li><a href="{{route('page.details',$row->page_slug)}}">{{$row->page_name}}</a></li>
							@endforeach

					</div>
				</div>
@php
$category = DB::table('categories')->get();
@endphp
				<div class="col-lg-2">
          <div class="footer_title">Categories</div>
					<div class="footer_column">
						<ul class="footer_list footer_list_2">
              @foreach( $category as $row)
							<li><a href="{{route('categorywise.product',$row->id)}}">{{$row->category_name}}</a></li>
							@endforeach
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Customer Care</div>
						<ul class="footer_list">
							<li><a href="#">My Account</a></li>
							<li><a href="{{route('order.tracking')}}">Order Tracking</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Our Blog</a></li>
							<li><a href="#">Contact Us</a></li>
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="images/logos_1.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_2.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_3.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_4.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{asset('frontend')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset('frontend')}}/styles/bootstrap4/popper.js"></script>
<script src="{{asset('frontend')}}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{asset('frontend')}}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{asset('frontend')}}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{asset('frontend')}}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{asset('frontend')}}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{asset('frontend')}}/plugins/easing/easing.js"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{asset('frontend')}}/js/custom.js"></script>
<script src="{{asset('frontend')}}/js/product_custom.js"></script>

<script>
    @if(Session::has('messege'))
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
          case 'info':
               toastr.info("{{ Session::get('messege') }}");
               break;
          case 'success':
              toastr.success("{{ Session::get('messege') }}");
              break;
          case 'warning':
             toastr.warning("{{ Session::get('messege') }}");
              break;
          case 'error':
              toastr.error("{{ Session::get('messege') }}");
              break;
            }
    @endif
  </script>
</body>

</html>
