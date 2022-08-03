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
						<div class="cart_title">Shopping Cart</div>
						  <div class="cart_items">
							<ul class="cart_list">

                @foreach($content as $row)
								@php

								$product=DB::table('products')->where('id',$row->id)->first();
								$colors=explode(',',$product->color);
								$sizes=explode(',',$product->size);
								@endphp
								<form  action="{{route('cart.update',$row->rowId)}}" method="post">
									@csrf
								<li class="cart_item clearfix">
									<div class="cart_item_image">
									 	<img src="{{asset('files/product/')}}/{{$row->options->thumbnail}}" alt="">
									</div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_text">{{$row->name}}</div>
										</div>
										<div class="cart_item_color cart_info_col">
											@if($row->options->size !=NULL)
											<div class="cart_item_text">
												<select class="custom-select form-control-sm size" name="size" style="min-width: 100px;" data-id="">
													@foreach($sizes as $size)
                          <option value="{{$size}}" @if($row->options->size==$size) Selected @endif>{{$size}}</option>
													@endforeach
      											</select>
											</div>
											@endif
											<input type="hidden" name="rowId" value="{{$row->rowId}}">
											<input type="hidden" name="thumbnail" value="{{$row->options->thumbnail}}">
										</div>

										<div class="cart_item_color cart_info_col">
											@if($row->options->color !=NULL)
											<div class="cart_item_text">
												<select class="custom-select form-control-sm color" data-id="" name="color" style="min-width: 100px;">
													@foreach($colors as $color)
                          <option value="{{$color}}" @if($row->options->color == $color) Selected @endif>{{$color}}</option>
													@endforeach
												</select>
											</div>
											@endif
										</div>


										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_text">
												<input type="number" class="form-control-sm qty" name="qty" style="min-width: 70px;"  value="{{$row->qty}}" min="1" required="">

										    </div>
										</div>

										<div class="cart_item_price cart_info_col">

											<div class="cart_item_text">{{$setting->currency}}{{$row->price}} X {{$row->qty}} </div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_text">{{$setting->currency}}{{$row->price * $row->qty}}</div>

										</div>
										<div class="cart_item_total cart_info_col">

											<div class="cart_item_text text-danger">
												<a href="{{route('cartproduct.remove',$row->rowId)}}" data-id="" id="removeProduct"> X</a>
											</div>
										</div>
									</div>
								</li>
                @endforeach


							</ul>
						</div>


						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<div class="order_total_amount">{{ $setting->currency }}{{ Cart::total() }}</div>
							</div>
						</div>

						<div class="cart_btn d-flex">
							<div class="cart_update" style="width:50%">
								<button type="submit" class="button cart_button_checkou btn btn-primary mt-5
								" >Update Cart</button>
							</div>
						</form>
							<div class="cart_buttons " style="width:50%">
								<a href="{{route('cart.empty')}}" class="button cart_button_clear btn-danger">Empty Cart</a>
								<a href="{{route('checkout')}}" class="button cart_button_checkout">Checkout</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
