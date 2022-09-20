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
			<h2 class="home_title">Campaign Products</h2>
		</div>
	</div>

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">


				<div class="col-lg-12">

					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{count($campaign_products)}}</span> products found</div>
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
              @foreach($campaign_products as $row)
							<div class="product_item is_new col-lg-3">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt=""></div>
								<div class="product_content">


                  <div class="product_price">
                    {{$setting->currency}}{{$row->price}}
                  </div>

									<div class="product_name"><div><a href="{{route('campaign.product.details',$row->slug)}}" tabindex="0">{{$row->name}}</a></div></div>
								</div>
							</div>
              @endforeach

						</div>

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							{{ $campaign_products->links() }}
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>



@endsection
