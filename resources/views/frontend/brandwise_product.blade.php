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
			<h2 class="home_title">{{$brand->brand_name}}</h2>
		</div>
	</div>

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Categories</div>
							<ul class="sidebar_categories">
                @foreach($category as $row)
								<li><a href="{{route('categorywise.product',$row->id)}}">{{$row->category_name}}</a></li>
								@endforeach
							</ul>
						</div>
						<div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div>
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle color_subtitle">Color</div>
							<ul class="colors_list">
								<li class="color"><a href="#" style="background: #b19c83;"></a></li>
								<li class="color"><a href="#" style="background: #000000;"></a></li>
								<li class="color"><a href="#" style="background: #999999;"></a></li>
								<li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
								<li class="color"><a href="#" style="background: #df3b3b;"></a></li>
								<li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
							</ul>
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Brands</div>
							<ul class="brands_list">
                @foreach($brands as $row)
								<li class="brand"><a href="{{route('brandwise.product',$row->id)}}">{{$row->brand_name}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>

				</div>

				<div class="col-lg-9">

					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{count($brand_wise_products)}}</span> products found</div>
							<div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>

						<div class="product_grid row">
							<div class="product_grid_border"></div>

							<!-- Product Item -->
              @foreach($brand_wise_products as $row)
							<div class="product_item is_new col-lg-3">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt=""></div>
								<div class="product_content">
                  @if($row->discount_price==NULL)
									<div class="product_price">{{$setting->currency}}{{$row->selling_price}}</div>
                  @else
                  <div class="product_price">
                    {{$setting->currency}}{{$row->discount_price}}   <del>{{$row->selling_price}}</del> </div>
                  @endif
									<div class="product_name"><div><a href="{{route('product.details',$row->slug)}}" tabindex="0">{{$row->name}}</a></div></div>
								</div>
                <a href="{{route('add.wishlist',$row->id)}}">
  								<div class="product_fav">  <i class="fas fa-heart"></i></div>
                </a>
								<ul class="product_marks">
									<li class="product_mark product_new">new</li>
								</ul>
							</div>
              @endforeach

						</div>

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							{{ $brand_wise_products->links() }}
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Recently Viewed</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">

						<!-- Recently Viewed Slider -->

						<div class="owl-carousel owl-theme viewed_slider">

							<!-- Recently Viewed Item -->
              @foreach($random_products as $row)
							<div class="owl-item">
								<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt=""></div>
									<div class="viewed_content text-center">
                    @if($row->discount_price==NULL)
                    <div class="product_price">{{$setting->currency}}{{$row->selling_price}}</div>
                    @else
                    <div class="product_price">
                      {{$setting->currency}}{{$row->discount_price}}   <del>{{$row->selling_price}}</del> </div>
                    @endif
										<div class="viewed_name"><a href="{{route('product.details',$row->slug)}}">{{$row->name}}</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">-25%</li>
										<li class="item_mark item_new">new</li>
									</ul>
								</div>
							</div>
              @endforeach
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Brands -->

	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="brands_slider_container">

						<!-- Brands Slider -->

						<div class="owl-carousel owl-theme brands_slider">
              @foreach($brands as $row)
  							<div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center">
                  <a href="{{route('brandwise.product',$row->id)}}">
                    <img src="{{asset('files/brand/')}}/{{$row->brand_logo}}" width="100" alt="">
                  </a>
                </div></div>
						  @endforeach

						</div>

						<!-- Brands Slider Navigation -->
						<div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
