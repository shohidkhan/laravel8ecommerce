<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cart;
use DB;
use Session;

class CheckoutController extends Controller
{
    //CheckoutController
    public function checkout()
    {
      if(Auth::check()){
        $content=Cart::content();
        return view('frontend.cart.checkout',compact('content'));
      }
      else{

        $notification= array('messege' =>'Please Login your account to added this product on wishlist!' , 'alert-type'=>'error');
        return redirect()->route('login')->with($notification);
      }

    }
    //Apply Coupon
    public function applycoupon(Request $request)
    {
      $check_coupon=DB::table('coupons')->where('coupon_code',$request->coupon)->first();
      if($check_coupon){
        if(date('Y-m-d',strtotime(date('Y-m-d')))<= date('Y-m-d',strtotime($check_coupon->validity_date))){

          Session::put('coupon',[
            'name'=>$check_coupon->coupon_code,
            'discount'=>$check_coupon->coupon_amount,
            'after_discount'=>Cart::subtotal()-$check_coupon->coupon_amount,
          ]);
          $notification= array('messege' =>'Coupon added succussfully' , 'alert-type'=>'success');
          return back()->with($notification);
        }
        else{
          $notification= array('messege' =>'Coupon code has been expired!' , 'alert-type'=>'error');
          return back()->with($notification);
        }
      }
      else {

        $notification= array('messege' =>'Invalid Coupon !' , 'alert-type'=>'error');
        return back()->with($notification);
      }

    }

    public function removecoupon()
    {
      Session::forget('coupon');
      $notification= array('messege' =>'Coupon Removed !' , 'alert-type'=>'success');
      return back()->with($notification);
    }
}
