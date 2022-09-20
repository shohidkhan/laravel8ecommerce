<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Review;
use DB;

class IndexController extends Controller
{
    public function index()
    {
      $category=Category::orderBy('category_name','ASC')->get();
      $bannerProduct=Product::where('status',1)->where('product_slider',1)->first();
      $featured_products=Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(8)->get();
      $popular_products=Product::where('status',1)->orderBy('product_views','DESC')->limit(8)->get();
      $trendy_products=Product::where('status',1)->where('trendy',1)->orderBy('id','asc')->limit(6)->get();
      $home_category=Category::where('home_page',1)->get();
      $brand=Brand::where('front_page',1)->limit(24)->get();
      $random_products=Product::where('status',1)->inRandomOrder()->limit(6)->get();
      $todayDeal=Product::where('status',1)->where('today_deal',1)->orderBy('id','desc')->limit(6)->get();
      $review=DB::table('website_reviews')->where('status',1)->orderBy('id','DESC')->limit(12)->get();
      $campaign=DB::table('campaigns')->where('status',1)->orderBy('id','desc')->first();

      return view('frontend.index',compact('category','popular_products','bannerProduct','featured_products','trendy_products','home_category','brand','random_products','todayDeal','review','campaign'));
    }
    public function productDetails($slug)
    {

      $single_product=Product::where('slug',$slug)->first();
      Product::where('slug',$slug)->increment('product_views');
      $related_products=Product::where('subcategory_id',$single_product->subcategory_id)->orderBy('id','desc')->take(10)->get();
      $reviews=Review::where('product_id',$single_product->id)->orderBy('id','desc')->get();
      // Share button 1

    return view('frontend.product_details',compact('single_product','related_products','reviews'));
    }
    public function productQuickView($id)
    {

      $product=Product::where('id',$id)->first();

      //return view('frontend.product_quick_view',compact('product'));
      return response()->json($product);
    }

    //categorywise products
    public function CategoryWiseProduct($id)
    {
      $category=DB::table('categories')->where('id',$id)->first();
      $subcategory=DB::table('subcategories')->where('category_id',$id)->get();
      $category_wise_products=DB::table('products')->where('category_id',$id)->paginate(10);
      $brands=DB::table('brands')->get();
      $random_products=Product::where('status',1)->inRandomOrder()->limit(6)->get();
      return view('frontend.category_product',compact('category','category_wise_products','brands','subcategory','random_products'));
    }

    public function SubcategoryWiseProduct($id)
    {
      $childcategory=DB::table('childcategories')->where('subcategory_id',$id)->get();
      $subcategory=DB::table('subcategories')->where('id',$id)->first();
      $subcategory_wise_products=DB::table('products')->where('subcategory_id',$id)->paginate(10);
      $brands=DB::table('brands')->get();
      $random_products=Product::where('status',1)->inRandomOrder()->limit(6)->get();
      return view('frontend.subcategory_product',compact('childcategory','subcategory_wise_products','brands','subcategory','random_products'));
    }
    public function ChildcategoryWiseProduct($id)
    {
      $category=DB::table('categories')->get();
      $childcategory=DB::table('childcategories')->where('id',$id)->first();
      $childcategory_wise_products=DB::table('products')->where('childcategory_id',$id)->paginate(10);
      $brands=DB::table('brands')->get();
      $random_products=Product::where('status',1)->inRandomOrder()->limit(6)->get();
      return view('frontend.childcategory_product',compact('category','childcategory','childcategory_wise_products','brands','random_products'));
    }

    //Brand Wise Product
    public function brandwiseProduct($id)
    {
      $category=DB::table('categories')->get();
      $brand=DB::table('brands')->where('id',$id)->first();
      $brand_wise_products=DB::table('products')->where('brand_id',$id)->paginate(10);
      $brands=DB::table('brands')->get();
      $random_products=Product::where('status',1)->inRandomOrder()->limit(6)->get();
      return view('frontend.brandwise_product',compact('category','brand_wise_products','brands','random_products','brand'));
    }



    //page details
    public function page_details($slug)
    {
      $page=DB::table('pages')->where('page_slug',$slug)->first();
      return view('frontend.page',compact('page'));
    }
    //newsletter Store
    public function newsletterStore(Request $request)
    {
      $check=DB::table('news_letters')->where('email',$request->email)->first();
      if($check){
        $notification=array('messege'=>'The Email Already Exits.','alert-type'=>'error');
        return back()->with($notification);
      }
      else{
        $data= array();
        $data['email']=$request->email;
        $check=DB::table('news_letters')->insert($data);
        $notification=array('messege'=>'Thanks For Subscribes us','alert-type'=>'success');
        return back()->with($notification);
      }

    }



    public function campaigns_products($id)
    {
      $campaign_products=DB::table('campaign_products')
      ->leftJoin('products','campaign_products.product_id','products.id')
      ->select('campaign_products.*','products.thumbnail','products.name','products.code','products.selling_price','products.slug')
      ->where('campaign_id',$id)
      ->paginate(20);
      return view('frontend.campaign_products',compact('campaign_products'));
    }


    public function campaign_product_details($slug)
    {
      $single_product=Product::where('slug',$slug)->first();
      Product::where('slug',$slug)->increment('product_views');
      $product_price=DB::table('campaign_products')->where('product_id',$single_product->id)->first();
      $related_products=DB::table('campaign_products')
      ->leftJoin('products','campaign_products.product_id','products.id')
      ->select('campaign_products.*','products.*')
      ->inRandomOrder(12)->get();
      $reviews=Review::where('product_id',$single_product->id)->orderBy('id','desc')->get();

      return view('frontend.campaign_details',compact('single_product','related_products','reviews','product_price'));
    }
}
