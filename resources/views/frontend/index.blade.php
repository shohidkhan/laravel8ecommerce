@extends('layouts.app')
@section('navbar')
@include('layouts.frontend_partial.main_nav')
@endsection
@section('content')
<style type="text/css">
    .checked {
  color: orange;
}
</style>

<!-- Banner -->

<div class="banner">
  <div class="banner_background" style="background-image:url({{asset('frontend')}}/images/banner_background.jpg)"></div>
  <div class="container fill_height">
    <div class="row fill_height">
      <div class="banner_product_image"><img src="{{asset('files/product')}}/{{$bannerProduct->thumbnail}}" alt=""></div>
      <div class="col-lg-5 offset-lg-4 fill_height">
        <div class="banner_content">
          <h1 class="banner_text">{{$bannerProduct->name}}</h1>
          @if($bannerProduct->discount_price==NULL)
            <div class="banner_price">{{$setting->currency}}{{$bannerProduct->selling_price}}</div>

          @else
        <div class="banner_price"><span>{{$setting->currency}}{{$bannerProduct->selling_price}}</span>{{$setting->currency}}{{$bannerProduct->discount_price}}</div>
          @endif
          <div class="banner_product_name">{{$bannerProduct->connect_to_brand->brand_name}}</div>
          <div class="button banner_button"><a href="{{route('product.details',$bannerProduct->slug)}}">Shop Now</a></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Campaign -->
@isset($campaign)
  @php
    $today=strtotime(date('Y-m-d'));
    $end_date=strtotime($campaign->end_date);
  @endphp
  @if ($today <= $end_date)


    <div class="characteristics">
       <div class="container">
           <div class="row">
               <div class="col-lg-2"></div>
               <div class="col-lg-8">
                   <strong style="text-align: center;">{{ $campaign->title }}</strong>
                   <a href="{{ route('frontend.campaign.products',$campaign->id) }}"> <img src="{{ asset('files/campaign/') }}/{{$campaign->image}}" style="width:100%;"> </a>
               </div><br>

           </div>
       </div>
   </div>
     @endif
   @endisset


<!-- Characteristics -->

<div class="characteristics">
    <div class="container">
        <div class="row">
          @foreach($brand as $row)
            <div class="col-lg-1 col-md-6 char_col" style="border:1px solid grey; padding:5px;">
                <div class="brands_item">
                   <a href="{{route('brandwise.product',$row->id)}}" title="{{$row->brand_name}}">
                    <img src="{{asset('files/brand/')}}/{{$row->brand_logo}}" alt="{{$row->brand_name}}" height="100%" width="100%">
                   </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<!-- Deals of the week -->

<div class="deals_featured">
  <div class="container">
    <div class="row">
      <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

        <!-- Deals -->

        <div class="deals">
          <div class="deals_title">Deals of the Week</div>
          <div class="deals_slider_container">

            <!-- Deals Slider -->
            <div class="owl-carousel owl-theme deals_slider">

              <!-- Deals Item -->
              @foreach($todayDeal as $row)
              <div class="owl-item deals_item">
                <div class="deals_image"><img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt=""></div>
                <div class="deals_content">
                  <div class="deals_info_line d-flex flex-row justify-content-start">
                    <div class="deals_item_category"><a href="#">{{$row->connect_to_category->category_name}}</a></div>
                    @if($row->discount_price==NULL)
                    <div class="deals_item_price_a ml-auto">{{ $setting->currency }}{{ $row->selling_price }}</div>
                  @else
                    <div class="deals_item_price_a ml-auto">{{ $setting->currency }} {{ $row->discount_price }}</div>
                  @endif

                  </div>
                  <div class="deals_info_line d-flex flex-row justify-content-start">
                    <div class="deals_item_name">{{$row->name}}</div>
                  </div>
                  <div class="available">
                    <div class="available_line d-flex flex-row justify-content-start">
                      <div class="available_title">Available: <span>{{$row->stock_quantity}}</span></div>
                      <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                    </div>
                    <div class="available_bar"><span style="width:17%"></span></div>
                  </div>
                  <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                    <div class="deals_timer_title_container">
                      <div class="deals_timer_title">Hurry Up</div>
                      <div class="deals_timer_subtitle">Offer ends in:</div>
                    </div>
                    <div class="deals_timer_content ml-auto">
                      <div class="deals_timer_box clearfix" data-target-time="">
                        <div class="deals_timer_unit">
                          <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                          <span>hours</span>
                        </div>
                        <div class="deals_timer_unit">
                          <div id="deals_timer1_min" class="deals_timer_min"></div>
                          <span>mins</span>
                        </div>
                        <div class="deals_timer_unit">
                          <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                          <span>secs</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

            </div>

          </div>

          <div class="deals_slider_nav_container">
            <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
            <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
          </div>
        </div>

        <!-- Featured -->
        <div class="featured">
          <div class="tabbed_container">
            <div class="tabs">
              <ul class="clearfix">
                <li class="active">Featured</li>
                <li>Most Popular</li>
              </ul>
              <div class="tabs_line"><span></span></div>
            </div>

            <!-- Product Panel -->
            <div class="product_panel panel active">
              <div class="featured_slider  ">
                @foreach($featured_products as $row)
                <!-- Slider Item -->
                <div class="featured_slider_item " >
                  <div class="border_active"></div>
                  <div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt=""></div>
                    <div class="product_content">
                      @if($row->discount_price == NULL)
                      <div class="product_price">{{$setting->currency}}{{$row->selling_price}}</div>
                      @else
                      <div class="product_price"> <del class="text-danger">{{$setting->currency}}{{$row->selling_price}}</del> <span>{{$setting->currency}}{{$row->discount_price}}</span> </div>
                      @endif
                      <div class="product_name"><div><a href="{{route('product.details',$row->slug)}}">{{$row->name}}</a></div></div>
                      <div class="product_extras">


                        <a href="{{route('product.details',$row->slug)}}" class="product_cart_button">Add to Cart</a>
                      </div>
                    </div>
                    <a href="{{route('add.wishlist',$row->id)}}" >
                    <div class="product_fav">

                        <i class="fas fa-heart"></i>

                    </div>
                      </a>
                    <ul class="product_marks">
                      <li class="product_mark product_discount"></li>
                      <li class="product_mark product_new">new</li>
                    </ul>
                  </div>
                </div>


                @endforeach


              </div>

              <div class="featured_slider_dots_cover"></div>
            </div>




            <!-- Product Panel -->

            <div class="product_panel panel">
              <div class="featured_slider slider">
                @foreach($popular_products as $row)
                <!-- Slider Item -->
                <!-- Slider Item -->
                <div class="featured_slider_item">
                  <div class="border_active"></div>
                  <div class="product_item d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt=""></div>
                    <div class="product_content">
                      @if($row->discount_price == NULL)
                      <div class="product_price">{{$setting->currency}}{{$row->selling_price}}</div>
                      @else
                      <div class="product_price"> <del class="text-danger">{{$setting->currency}}{{$row->selling_price}}</del> <span>{{$setting->currency}}{{$row->discount_price}}</span> </div>
                      @endif
                      <div class="product_name"><div><a href="{{route('product.details',$row->slug)}}">{{$row->name}}</a></div></div>
                      <div class="product_extras">


                        <button class="product_cart_button">Add to Cart</button>
                      </div>
                    </div>
                    <a href="{{route('add.wishlist',$row->id)}}" >
                    <div class="product_fav">

                        <i class="fas fa-heart"></i>

                    </div>
                      </a>
                    <ul class="product_marks">
                      <li class="product_mark product_discount"></li>
                      <li class="product_mark product_new">new</li>
                    </ul>
                  </div>
                </div>



                @endforeach

              </div>
              <div class="featured_slider_dots_cover"></div>
            </div>



          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Popular Categories -->

<div class="popular_categories">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="popular_categories_content">
          <div class="popular_categories_title">Popular Categories</div>
          <div class="popular_categories_slider_nav">
            <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
            <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
          </div>
          <div class="popular_categories_link"><a href="#">full catalog</a></div>
        </div>
      </div>

      <!-- Popular Categories Slider -->

      <div class="col-lg-9">
        <div class="popular_categories_slider_container">
          <div class="owl-carousel owl-theme popular_categories_slider">

            <!-- Popular Categories Item -->
            @foreach($category as $row)
            <div class="owl-item">
              <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                <div class="popular_category_image"><img src="images/popular_1.png" alt=""></div>
                <div class="popular_category_text">
                  <a href="{{route('categorywise.product',$row->id)}}">{{$row->category_name}}</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Banner -->

<!-- <div class="banner_2">
  <div class="banner_2_background" style="background-image:url(images/banner_2_background.jpg)"></div>
  <div class="banner_2_container">
    <div class="banner_2_dots"></div>
    <!-- Banner 2 Slider -

    <div class="owl-carousel owl-theme banner_2_slider">

      <div class="owl-item">
        <div class="banner_2_item">
          <div class="container fill_height">
            <div class="row fill_height">
              <div class="col-lg-4 col-md-6 fill_height">
                <div class="banner_2_content">
                  <div class="banner_2_category">Laptops</div>
                  <div class="banner_2_title">MacBook Air 13</div>
                  <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                  <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                  <div class="button banner_2_button"><a href="#">Explore</a></div>
                </div>

              </div>
              <div class="col-lg-8 col-md-6 fill_height">
                <div class="banner_2_image_container">
                  <div class="banner_2_image"><img src="images/banner_2_product.png" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="owl-item">
        <div class="banner_2_item">
          <div class="container fill_height">
            <div class="row fill_height">
              <div class="col-lg-4 col-md-6 fill_height">
                <div class="banner_2_content">
                  <div class="banner_2_category">Laptops</div>
                  <div class="banner_2_title">MacBook Air 13</div>
                  <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                  <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                  <div class="button banner_2_button"><a href="#">Explore</a></div>
                </div>

              </div>
              <div class="col-lg-8 col-md-6 fill_height">
                <div class="banner_2_image_container">
                  <div class="banner_2_image"><img src="images/banner_2_product.png" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="owl-item">
        <div class="banner_2_item">
          <div class="container fill_height">
            <div class="row fill_height">
              <div class="col-lg-4 col-md-6 fill_height">
                <div class="banner_2_content">
                  <div class="banner_2_category">Laptops</div>
                  <div class="banner_2_title">MacBook Air 13</div>
                  <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                  <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                  <div class="button banner_2_button"><a href="#">Explore</a></div>
                </div>

              </div>
              <div class="col-lg-8 col-md-6 fill_height">
                <div class="banner_2_image_container">
                  <div class="banner_2_image"><img src="images/banner_2_product.png" alt=""></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> -->

@foreach($home_category as $row)

@php
$cat_products=App\Models\Product::where('category_id',$row->id)->orderBy('id','desc')->limit(24)->get();
@endphp
<div class="new_arrivals">
       <div class="container">
           <div class="row">
               <div class="col">
                   <div class="tabbed_container">
                       <div class="tabs clearfix tabs-right">
                           <div class="new_arrivals_title">{{$row->category_name}}</div>
                           <ul class="clearfix">
                               <li class=""><a href=""> view more </a></li>
                           </ul>
                           <div class="tabs_line"><span></span></div>
                       </div>
                       <div class="row">
                           <div class="col-lg-12" style="z-index:1;">
                               <!-- Product Panel -->
                               <div class="product_panel panel active">
                                   <div class="arrivals_slider slider">

                                       <!-- Slider Item -->
                                       @foreach($cat_products as $row)
                                       <div class="arrivals_slider_item">
                                           <div class="border_active"></div>
                                           <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                               <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt="" height="100%" width="55%"></div>
                                               <div class="product_content">

                                                 @if($row->discount_price==Null)
                                                 <div class="product_price discount"> {{$setting->currency}} {{$row->selling_price}}</div>
                                                @else
                                                <div class="product_price discount"> <del>{{$setting->currency}}{{$row->selling_price}}</del> {{$setting->currency}} {{$row->discount_price}}</div>
                                                @endif


                                                   <div class="product_name"><div><a href="">{{ $row->name }}</a></div></div>
                                                   <div class="product_extras">

                                                       <button class="product_cart_button">Add to Cart</button>
                                                   </div>
                                               </div>
                                               <a href="">
                                                  <div class="product_fav">
                                                     <i class="fas fa-heart"></i>
                                                  </div>
                                               </a>

                                           </div>
                                       </div>
                                       @endforeach
                                   </div>
                                   <div class="arrivals_slider_dots_cover"></div>
                               </div>
                       </div>
                      </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endforeach



<!-- Adverts -->

<div class="adverts">
  <div class="container">
    <div class="row">

      <div class="col-lg-4 advert_col">

        <!-- Advert Item -->

        <div class="advert d-flex flex-row align-items-center justify-content-start">
          <div class="advert_content">
            <div class="advert_title"><a href="#">Trends 2018</a></div>
            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
          </div>
          <div class="ml-auto"><div class="advert_image"><img src="images/adv_1.png" alt=""></div></div>
        </div>
      </div>

      <div class="col-lg-4 advert_col">

        <!-- Advert Item -->

        <div class="advert d-flex flex-row align-items-center justify-content-start">
          <div class="advert_content">
            <div class="advert_subtitle">Trends 2018</div>
            <div class="advert_title_2"><a href="#">Sale -45%</a></div>
            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
          </div>
          <div class="ml-auto"><div class="advert_image"><img src="images/adv_2.png" alt=""></div></div>
        </div>
      </div>

      <div class="col-lg-4 advert_col">

        <!-- Advert Item -->

        <div class="advert d-flex flex-row align-items-center justify-content-start">
          <div class="advert_content">
            <div class="advert_title"><a href="#">Trends 2018</a></div>
            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
          </div>
          <div class="ml-auto"><div class="advert_image"><img src="images/adv_3.png" alt=""></div></div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Trends -->

<div class="trends">
  <div class="trends_background" style="background-image:url(images/trends_background.jpg)"></div>
  <div class="trends_overlay"></div>
  <div class="container">
    <div class="row">

      <!-- Trends Content -->
      <div class="col-lg-3">
        <div class="trends_container">
          <h2 class="trends_title">Trends 2018</h2>
          <div class="trends_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p></div>
          <div class="trends_slider_nav">
            <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
            <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
          </div>
        </div>
      </div>

      <!-- Trends Slider -->
      <div class="col-lg-9">
        <div class="trends_slider_container">

          <!-- Trends Slider -->

          <div class="owl-carousel owl-theme trends_slider">
            @foreach($trendy_products as $row)
            <!-- Trends Slider Item -->
            <div class="owl-item">
              <div class="trends_item is_new">
                <div class="trends_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt=""></div>
                <div class="trends_content">
                  <div class="trends_category"><a href="#">{{$row->connect_to_category->category_name}}</a></div>
                  <div class="trends_info clearfix">
                    <div class="trends_name"><a href="product.html">{{$row->name}}</a></div>
                    @if($row->discount_price==NULL)
                    <div class="trends_price">{{$setting->currency}}{{$row->selling_price}}</div>
                    @else
                    <div class="trends_price">
                      <del class="text-danger">{{$setting->currency}}{{$row->selling_price}}</del> <span>{{$setting->currency}}{{$row->discount_price}}</span>
                    </div>
                    @endif
                  </div>
                </div>
                <ul class="trends_marks">
                  <li class="trends_mark trends_discount">new</li>
                </ul>
                <a href="{{route('add.wishlist',$row->id)}}">
                  <div class="trends_fav"><i class="fas fa-heart"></i></div>
                </a>
              </div>
            </div>
            @endforeach


          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Reviews -->

<div class="reviews">
  <div class="container">
    <div class="row">
      <div class="col">

        <div class="reviews_title_container">
          <h3 class="reviews_title">Latest Reviews</h3>
          <div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
        </div>

        <div class="reviews_slider_container">

          <div class="owl-carousel owl-theme reviews_slider">
            @foreach($review as $row)
            <div class="owl-item">
              <div class="review d-flex flex-row align-items-start justify-content-start">
                <div><div class="review_image"><img src="{{asset('files/dummy.jpg')}}" alt=""></div></div>
                <div class="review_content">
                  <div class="review_name">{{$row->name}}</div>
                  <div class="review_rating_container">
                    <div class="rating_r rating_r_4 review_rating">
                      @if($row->rating == 5)
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      @elseif($row->rating == 4)
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star "></span>
                      @elseif($row->rating == 3)
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star "></span>
                      <span class="fa fa-star "></span>
                      @elseif($row->rating == 2)
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
                    </div>
                    <div class="review_time">{{$row->review_date}}</div>
                  </div>
                  <div class="review_text"><p>{{$row->review}}</p></div>
                </div>
              </div>
            </div>
            @endforeach

          </div>
          <div class="reviews_dots"></div>
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
              <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                <div class="viewed_image">
                  <img src="{{asset('files/product/')}}/{{$row->thumbnail}}" alt="{{$row->name}}" >
                </div>
                <div class="viewed_content text-center">
                  @if($row->discount_price==Null)
                  <div class="viewed_price">span>{{$setting->currency}}{{$row->selling_price}}</span></div>
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
</div>










@endsection
