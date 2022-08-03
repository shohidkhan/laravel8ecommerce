<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\WebsiteReview;
use Auth;
use DB;
class ReviewController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function store(Request $request)
  {
    $request->validate([
      'review'=>'required',
      'rating'=>'required',
    ]);
$check_review=Review::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();
if($check_review){
  $notification= array('messege' =>'You have reviewed on this product' , 'alert-type'=>'error');
  return back()->with($notification);
}
    Review::insert([
      'user_id'=>Auth::id(),
      'product_id'=>$request->product_id,
      'review'=>$request->review,
      'rating'=>$request->rating,
      'review_date'=>date('d-m-Y'),
      'review_month'=>date('F'),
      'review_year'=>date('Y'),
    ]);
    $notification= array('messege' =>'Thank you For given on this product' , 'alert-type'=>'success');
    return back()->with($notification);


  }

  //write review of Website

  public function WriteReviewWebsite()
  {
    return view('user.review_write');
  }
  //Store website review
  public function storeReviewWebsite(Request $request)
  {
    $check=DB::table('website_reviews')->where('user_id',Auth::id())->first();
    if($check){
      $notification= array('messege' =>'Review Already Exits!' , 'alert-type'=>'error');
      return back()->with($notification);
    }
    else{
      WebsiteReview::insert([
        'user_id'=>Auth::id(),
        'name'=>$request->name,
        'review'=>$request->review,
        'rating'=>$request->rating,
        'review_date'=>date('d,F Y'),
        'status'=>0,
      ]);
      $notification= array('messege' =>'Thank you For given on our Website!' , 'alert-type'=>'success');
      return back()->with($notification);
    }
  }


}
