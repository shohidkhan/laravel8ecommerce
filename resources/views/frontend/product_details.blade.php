@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/product_responsive.css">

@include('layouts.frontend_partial.collaps_nav')

	<!-- Single Product -->

  <div class="single_product">
	<div class="container">
		<div class="row">

@php
$images=json_decode($single_product->images);
$color=explode(',',$single_product->color);
$size=explode(',',$single_product->size);
@endphp


@php
$review_1=App\Models\Review::where('product_id',$single_product->id)->where('rating',1)->count();
$review_2=App\Models\Review::where('product_id',$single_product->id)->where('rating',2)->count();
$review_3=App\Models\Review::where('product_id',$single_product->id)->where('rating',3)->count();
$review_4=App\Models\Review::where('product_id',$single_product->id)->where('rating',4)->count();
$review_5=App\Models\Review::where('product_id',$single_product->id)->where('rating',5)->count();


$sum_rating=App\Models\Review::where('product_id',$single_product->id)->sum('rating');
$count_rating=App\Models\Review::where('product_id',$single_product->id)->count('rating');



@endphp
			<!-- Images -->
			<div class="col-lg-1 order-lg-1 order-2" >
				<ul class="image_list">
          @foreach($images as $image)
					<li data-image="{{ asset('files/product/')}}/{{$image}}">
						<img src="{{ asset('files/product/')}}/{{$image}}" alt="">
					</li>
          @endforeach
				</ul>
			</div>

			<!-- Selected Image -->
			<div class="col-lg-4 order-lg-2 order-1">
				<div class="image_selected"><img src="{{asset('files/product/')}}/{{$single_product->thumbnail}}" alt=""></div>
			</div>

			<!-- Description -->
			<div class="col-lg-4 order-3">
				<div class="product_description">
					<div class="product_category">{{$single_product->connect_to_category->category_name}} > {{$single_product->connect_to_subcategory->subcategory_name}} > {{$single_product->connect_to_childcategory->childcategory_name}}</div>
					<div class="product_name" style="font-size: 20px;">{{$single_product->name}}</div>

					<div class="product_category"><b> Brand: {{$single_product->connect_to_brand->brand_name}} </b></div>
					<div class="product_category"><b> Stock: {{$single_product->stock_quantity}} </b></div>
          @isset($single_product->unit)
					<div class="product_category"><b> Unit: {{$single_product->unit}}  </b></div>
          @endisset
					 {{-- review star --}}
					 <div>


             @if($sum_rating !=NULL)
                           @if(intval($sum_rating/$count_rating)==5)
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
                         @elseif(intval($sum_rating/$count_rating)>=4 && intval($sum_rating/5) <$count_rating)
                           <span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star "></span>
                         @elseif(intval($sum_rating/$count_rating)>=3 && intval($sum_rating/5) <$count_rating)
                           <span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star "></span>
             							<span class="fa fa-star "></span>
                         @elseif(intval($sum_rating/$count_rating)>=2 && intval($sum_rating/5) <$count_rating)
                           <span class="fa fa-star checked"></span>
             							<span class="fa fa-star checked"></span>
             							<span class="fa fa-star "></span>
             							<span class="fa fa-star "></span>
             							<span class="fa fa-star "></span>
                           @else
                           <span class="fa fa-star checked"></span>
             							<span class="fa fa-star "></span>
             							<span class="fa fa-star "></span>
             							<span class="fa fa-star "></span>
             							<span class="fa fa-star "></span>

                           @endif
                           @endif



					 </div>
					<div><br>

            @if($single_product->discount_price==NULL)
             <div class="" style="margin-top: 35px;">Price:{{$setting->currency}}{{$single_product->selling_price}}</div>
             @else
              <div class="" >
              Price: <del class="text-danger">{{$setting->currency}}{{$single_product->selling_price
              }}</del class="text-danger">
              {{$setting->currency}} {{$single_product->discount_price}}
              </div>
              @endif
					</div>


					<div class="order_info ">




							<div class="form-group">
									<div class="row">
                    @isset($single_product->size)
										<div class="col-lg-6">
											<label>Pick Size: </label>
											<select class="custom-select form-control-sm" name="size" style="min-width: 120px;">
                        <option value="">Size</option>
                        @foreach($size as  $row)
												   <option value="{{$row}}">{{$row}}</option>
                           @endforeach
											</select>
										</div>
                    @endisset
                    @isset($single_product->size)
										<div class="col-lg-6">
											<label>Pick Color: </label>
											<select class="custom-select form-control-sm" name="color" style="min-width: 120px;">
                        <option value="" >color</option>
                        @foreach($color as  $row)
												   <option value="{{$row}}">{{$row}}</option>
                           @endforeach
											</select>
										</div>
                    @endisset
									</div>
								</div>

							<div class="clearfix" style="z-index: 1000;">

								<!-- Product Quantity -->
								<div class="product_quantity clearfix ml-2">
									<span>Quantity: </span>
									<input id="quantity_input" type="text" name="qty" pattern="[1-9]*" min="1" value="1">
									<div class="quantity_buttons">
										<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
										<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
									</div>
								</div>
							</div>

							<div class="button_container">
								<div class="input-group mb-3">
								  <div class="input-group-prepend">



								    <button class="btn btn-outline-info" type="submit"> <span class="loading d-none">....</span> Add to cart</button>


								    <a href="{{route('add.wishlist',$single_product->id)}}" class="btn btn-outline-primary" type="button">Add to wishlist</a>
								  </div>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-3 order-3" style="border-left: 1px solid grey; padding-left: 10px;">
				<strong class="text-muted">Pickup Point of this product</strong><br>
				<i class="fa fa-map"> {{$single_product->connect_to_Pickuppoint->pickup_point_name}} </i><hr><br>
				<strong class="text-muted"> Home Delivery :</strong><br>
				 -> (4-8) days after the order placed.<br>
				 -> Cash on Delivery Available.
				 <hr><br>
				 <strong class="text-muted"> Product Return & Warrenty :</strong><br>
				 -> 7 days return guarranty.<br>
				 -> Warrenty not available.
				 <hr><br>
         @isset($single_product->video)
				 <strong>Product Video : </strong>
				 <iframe width="300" src="https://www.youtube.com/embed/-tKvUktUh5s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
         @endisset
			</div>

		</div><br><br>
		<div class="row">
			<div class="col-lg-12">
			 <div class="card">
			  <div class="card-header">
				<h4>Product details of {{$single_product->name}}</h4>
			  </div>
				<div class="card-body">
{!! $single_product->description !!}
				</div>
			 </div>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12">
			 <div class="card">
			  <div class="card-header">
				<h4>Ratings & Reviews of {{$single_product->name}}</h4>
			  </div>



				<div class="card-body">
					<div class="row">
						<div class="col-lg-3">
							Average Review of  : {{$single_product->name}}<br>
@if($sum_rating !=NULL)
              @if(intval($sum_rating/$count_rating)==5)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
            @elseif(intval($sum_rating/$count_rating)>=4 && intval($sum_rating/5) <$count_rating)
              <span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
            @elseif(intval($sum_rating/$count_rating)>=3 && intval($sum_rating/5) <$count_rating)
              <span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
            @elseif(intval($sum_rating/$count_rating)>=2 && intval($sum_rating/5) <$count_rating)
              <span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
              @else
              <span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>

              @endif
              @endif
{{$sum_rating/$count_rating}}
              <br>

						</div>

						<div class="col-md-3">
							{{-- all review show --}}
							Total Review Of This Product:<br>
						 	 		  <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span> Total {{$review_5}} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span> Total {{$review_4}} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span> Total {{$review_3}} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span> Total {{$review_2}} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span> Total {{$review_1}} </span>
										</div>


						</div>
						<div class="col-lg-6">
							<form action="{{route('review.store')}}" method="post">
                @csrf
							  <div class="form-group">
							    <label for="details">Write Your Review</label>
							    <textarea type="text" class="form-control" name="review" required=""></textarea>
							  </div>
								<input type="hidden" name="product_id" value="{{$single_product->id}}">
							  <div class="form-group ">
							    <label for="review">Write Your Review</label>
							     <select class="custom-select form-control-sm" name="rating" style="min-width: 120px;">
							     	<option disabled="" selected="">Select Your Review</option>
							     	<option value="1">1 star</option>
							     	<option value="2">2 star</option>
							     	<option value="3">3 star</option>
							     	<option value="5">4 star</option>
							     	<option value="5">5 star</option>
							     </select>

							  </div>
                @if(Auth::check())
							  <button type="submit" class="btn btn-sm btn-info"><span class="fa fa-star "></span> submit review</button>
                @else
							   <p>Please at first login to your account for submit a review.</p>
                @endif
							</form>
						</div>
					</div>
						<br>

					{{-- all review of this product --}}
						<strong>All review of {{$single_product->name}}</strong> <hr>
					<div class="row">
            	@foreach($reviews as $row)
							<div class="card col-lg-12 m-2">
						 	 <div class="card-header">
                 {{$row->connect_to_user->name}} ({{date('d F, Y'),strtotime($row->review_date)}})
						 	 </div>
						 	 <div class="card-body">
                 {{$row->review}}
                 <br>
                 @if($row->rating==5)
						 	 		  <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
                    @elseif($row->rating==4)
                    <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star-o"></span>
										</div>
                    @elseif($row->rating==3)
                    <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star-o"></span>
											<span class="fa fa-star-o"></span>
										</div>
                    @elseif($row->rating==2)
                    <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star-o"></span>
											<span class="fa fa-star-o"></span>
											<span class="fa fa-star-o"></span>
										</div>
                    @else
                    <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star-o"></span>
											<span class="fa fa-star-o"></span>
											<span class="fa fa-star-o"></span>
											<span class="fa fa-star-o"></span>
										</div>
                    @endif
						 	 </div>
						 </div>
             @endforeach
					</div>
				</div>


			 </div>
			</div>
		</div>

	 </div>
	</div>
</div>

<!-- Recently Viewed -->


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
            @foreach($related_products as $row)
            <div class="owl-item">
              <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                <div class="viewed_image"><img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt=""></div>
                <div class="viewed_content text-center">
                  @if($row->discount_price ==NULL)
                  <div class="viewed_price">{{$setting->currency}}{{$row->selling_price}}</div>
                  @else
                  <div class="viewed_price">{{$setting->currency}}{{$row->discount_price}}<span>{{$setting->currency}}{{$row->selling_price}}</span></div>
                  @endif
                  <div class="viewed_name"><a href="{{route('product.details',$row->slug)}}">{{$row->name}}</a></div>
                </div>
                <ul class="item_marks">
                  <li class="item_mark item_discount">new</li>
                </ul>
              </div>
            </div>
            @endforeach


        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('frontend')}}/js/product_custom.js"></script>
@endsection
