<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use DB;

class IndexController extends Controller
{
    public function index()
    {
      $category=Category::all();
      $bannerProduct=Product::where('status',1)->where('product_slider',1)->first();
      $featured_products=Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(8)->get();
      $popular_products=Product::where('status',1)->orderBy('product_views','DESC')->limit(8)->get();
      $trendy_products=Product::where('status',1)->where('trendy',1)->orderBy('id','asc')->limit(6)->get();

      return view('frontend.index',compact('category','popular_products','bannerProduct','featured_products','trendy_products',));
    }
    public function productDetails($slug)
    {

      $single_product=Product::where('slug',$slug)->first();
      Product::where('slug',$slug)->increment('product_views');
      $related_products=Product::where('subcategory_id',$single_product->subcategory_id)->orderBy('id','desc')->take(10)->get();
      $reviews=Review::where('product_id',$single_product->id)->orderBy('id','desc')->get();
    return view('frontend.product_details',compact('single_product','related_products','reviews'));
    }
    public function productQuickView($id)
    {
      echo $id;
      $product=Product::where('id',$id)->first();

      //return view('frontend.product_quick_view',compact('product'));
      return response()->json($product);
    }
}
