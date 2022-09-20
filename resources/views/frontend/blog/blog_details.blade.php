@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/blog_styles.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/styles/blog_responsive.css">
@include('layouts.frontend_partial.collaps_nav')
<!-- Home -->

<!-- Home -->

<div class="home">
  <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('files/blog/') }}/{{ $blog_details->thumbnail }}" data-speed="0.8"></div>
</div>

<!-- Single Blog Post -->

<div class="single_post">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <h2 class="single_post_title">{{ $blog_details->title }}</h2>
        <div class="single_post_text">
          <p>{!! $blog_details->description !!}</p>

          {{-- <div class="single_post_quote text-center">
            <div class="quote_image"><img src="images/quote.png" alt=""></div>
            <div class="quote_text">Quisque sagittis non ex eget vestibulum. Sed nec ultrices dui. Cras et sagittis erat. Maecenas pulvinar, turpis in dictum tincidunt, dolor nibh lacinia lacus.</div>
            <div class="quote_name">Liam Neeson</div>
          </div> --}}


        </div>
      </div>
    </div>
  </div>
</div>

<!-- Blog Posts -->

<div class="blog">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="blog_posts d-flex flex-row align-items-start justify-content-between">

          <!-- Blog post -->
          {{-- @foreach ($related_blog as  $blog)


            <div class="blog_post">
              <div class="blog_image" style="background-image:url({{ asset('files/blog/') }}/{{ $blog->thumbnail }})"></div>
              <div class="blog_text">{{ $blog->title }}</div>
              <div class="blog_button"><a href="{{ route('blog.details',$blog->slug) }}">Continue Reading</a></div>
            </div>
            @endforeach --}}
          <!-- Blog post -->




        </div>
      </div>
    </div>
  </div>
</div>
@endsection
