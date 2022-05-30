<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
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

  public function addwishlist($id)
  {
    $check_wishlist=DB::table('wishlists')->where('product_id',$id)->where('user_id',Auth::id())->first();
    if($check_wishlist){
      $notification= array('messege' =>'You have already added  this product on your wishlist!' , 'alert-type'=>'error');
      return back()->with($notification);
    }
    else {
      $data=array();
      $data['user_id']=Auth::id();
      $data['product_id']=$id;
      DB::table('wishlists')->insert($data);
      $notification= array('messege' =>'You have  added this product on wishlist!' , 'alert-type'=>'success');
      return back()->with($notification);
    }
  }
}
