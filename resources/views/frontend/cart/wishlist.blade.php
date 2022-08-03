@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">
@include('layouts.frontend_partial.collaps_nav')

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 ">
					<div class="cart_container">
						<div class="cart_title">Wishlists</div>
						  <div class="cart_items">
							<ul class="cart_list">

                @foreach($wishlist as $row)


								<li class="cart_item clearfix">
									<div class="cart_item_image">
									 	<img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt="">
									</div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_text">{{$row->name}}</div>
										</div>

                    <div class="cart_item_quantity cart_info_col">
											<div class="cart_item_text">
                        {{$row->date}}
										  </div>
										</div>

										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_text">
                          <a href="{{route('product.details',$row->slug)}}" class="btn btn-primary">Add To Cart</a>
										  </div>
										</div>


										<div class="cart_item_total cart_info_col">
											<div class="cart_item_text text-danger">
												<a href="{{route('wishlistproduct.remove',$row->id)}}" data-id="" id="removeProduct"> X</a>
											</div>
										</div>
									</div>
								</li>
                @endforeach


							</ul>
						</div>



							<div class="cart_buttons ">
								<a href="{{route('wishlist.empty')}}" class="button cart_button_clear btn-danger">Empty Wishlist</a>
								<a href="{{url('/')}}" class="button cart_button_checkout">Back To Home</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
