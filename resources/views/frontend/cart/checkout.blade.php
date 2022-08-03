@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/cart_responsive.css">
@include('layouts.frontend_partial.collaps_nav')

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 ">
          <div class="card">
            <div class="card-header bg-info text-white">
              <strong>Billing Address</strong>
            </div>
            <div class="card-body">
              <form action="{{route('order.place')}}" method="post" id="order-place">
 						  	@csrf
 							<div class="row p-4">
 							  <div class="form-group col-lg-6">
 								<label>Customer Name <span class="text-danger">*</span></label>
 								<input type="text" class="form-control" value="{{Auth::user()->name}}" name="c_name"  >
 							  </div>
 							  <div class="form-group col-lg-6">
 								<label>Customer Phone <span class="text-danger">*</span></label>
 								<input type="text" class="form-control" value="" name="c_phone"  >
								@error('c_phone')
									<span class="text-danger">{{$message}}</span>
								@enderror
 							  </div>
 							  <div class="form-group col-lg-6">
 								<label> Country <span class="text-danger">*</span></label>
 								<input type="text" class="form-control" name="c_country"  >
								@error('c_country')
									<span class="text-danger">{{$message}}</span>
								@enderror
 							  </div>
 							  <div class="form-group col-lg-6">
 								<label>Shipping Address <span class="text-danger">*</span> </label>
 								<input type="text" class="form-control" name="c_address"  >
								@error('c_address')
									<span class="text-danger">{{$message}}</span>
								@enderror
 							  </div>

 							  <div class="form-group col-lg-6">
 								<label>Email Address</label>
 								<input type="text" class="form-control" name="c_email" value="{{Auth::user()->email}}">
								@error('c_email')
									<span class="text-danger">{{$message}}</span>
								@enderror
 							  </div>
 							  <div class="form-group col-lg-6">
 								<label>Zip Code</label>
 								<input type="text" class="form-control" name="c_zipcode" >
								@error('c_zipcode')
									<span class="text-danger">{{$message}}</span>
								@enderror
 							  </div>
 							  <div class="form-group col-lg-6">
 								<label>City Name</label>
 								<input type="text" class="form-control" name="c_city" >
								@error('c_city')
									<span class="text-danger">{{$message}}</span>
								@enderror
 							  </div>
 							  <div class="form-group col-lg-6">
 								<label>Extra Phone</label>
 								<input type="text" class="form-control" name="c_extra_phone"  >
 							  </div>
 								<br>
 							  	   <div class="form-group col-lg-4">
 							  	 	<label>Paypal</label>
 							  	 	<input type="radio"  name="payment_type" value="Paypal">
 							  	   </div>
 							  	   <div class="form-group col-lg-4">
 							  	 	<label>Bkash/Rocket/Nagad </label>
 							  	 	<input type="radio"  name="payment_type" checked="" value="Aamarpay" >
 							  	   </div>
 							  	   <div class="form-group col-lg-4">
 							  	 	<label>Hand Cash</label>
 							  	 	<input type="radio"  name="payment_type" value="Hand Cash" >
 							  	   </div>

 							</div>
 							<div class="form-group pl-2">
 							  	<button type="submit" class="btn btn-info p-2">Order Place</button>
 							</div>

 							<span class="visually-hidden pl-2 d-none progress">Progressing.....</span>

 						  </form>

            </div>
          </div>
				</div>
        <div class="col-lg-4 ">
          <div class="card">


            <div class="card-body">
							<div class="">
								<p>Subtoatal: <span style="float:right">{{Cart::subtotal()}}{{$setting->currency}}</span> </p>
								@if(Session::has('coupon'))
								<p>Coupon: ({{Session::get('coupon')['name']}}) <span style="float:right">{{Session::get('coupon')['discount']}}{{$setting->currency}}</span> <a href="{{route('remove.coupon')}}">X</a> </p>
								@endif
								<p>Tax: <span style="float:right">0{{$setting->currency}}</span> </p>
								<p>Shipping: <span style="float:right">0{{$setting->currency}}</span> </p>
								@if(Session::get('coupon'))
								<p><strong>Total: <span style="float:right">{{Session::get('coupon')['after_discount']}}{{$setting->currency}}</span> </strong></p>
								@else
									<p><strong>Total: <span style="float:right">{{Cart::total()}}{{$setting->currency}}</span> </strong></p>

								@endif
							</div>
							<hr>
							@if(!Session::has('coupon'))
							<div class="card-header mb-3 bg-info text-white">
	              Apply Coupon
	            </div>
              <form class="" action="{{route('apply.coupon')}}" method="post">
								@csrf
                <div class="form-group">
                  <input type="text" class="form-control" name="coupon" placeholder="Apply coupon">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-info">Apply</button>
                </div>
              </form>
							@endif
            </div>
          </div>

          <!-- Order Total -->
          <div class="order_total">
            <div class="order_total_content text-md-right">
              <div class="order_total_title">Order Total:</div>
							@if(Session::get('coupon'))
              <div class="order_total_amount">{{ $setting->currency }}{{ Session::get('coupon')['after_discount'] }}</div>
							@else
							<div class="order_total_amount">{{ $setting->currency }}{{ Cart::total() }}</div>
							@endif
            </div>

            <div class="t">
              <a href="#" class="btn btn-info mt-4">Payment now</a>
            </div>
          </div>
				</div>
			</div>
		</div>
	</div>

@endsection
