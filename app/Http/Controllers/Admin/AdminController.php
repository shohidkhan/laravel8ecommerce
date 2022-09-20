<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Auth;
use App\Models\User;
use Hash;
use DB;

class AdminController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function admin(){

    $coustomers=DB::table('users')->where('is_admin','0')->orWhere('is_admin',NULL)->orderBy('id','desc')->paginate(10);

    $latest_order=DB::table('orders')->orderBy('id','DESC')->paginate(10);
     $most_views=DB::table('products')->orderBy('product_views','DESC')->where('status',1)->limit(8)->get();
     $total_product=DB::table('products')->count();
     $active_product=DB::table('products')->where('status',1)->count();

    return view('admin.home',compact('coustomers','latest_order','most_views','total_product','active_product'));
  }
  // Admin Custom Logout
  public function logout(){
    Auth::logout();
    $notification= array('messege' =>'You are logged out!' ,'alert-type'=>'success' );
    return  redirect()->route('admin.login')->with($notification);
  }
  //Email Cahnge
  public function emailchange(){
    return view('admin.profile.email_change');
  }
  //Email Update method
  public function emailupdate(Request $request){
    User::where('id',$request->user_id)->Update([
      'email'=>$request->new_email,
    ]);
    $notification=array('messege'=>'Email Updated','alert-type'=>'success');
    return back()->with($notification);
}
  //Password change vi
  public function passwordchange(){
    return view('admin.profile.password_change');
  }

  //password Update
  public function passwordupdate(Request $request){
    $request->validate([
      'old_password'=>'required',
      'password'=>'required|confirmed|min:6',
      'password_confirmation'=>'required',
    ]);
    $old_pass=$request->old_password;
    $db_pass=Auth::user()->password;
    $new_pass=$request->password;
    if(Hash::check($old_pass,$db_pass)){
      $user=User::find(Auth::id());
      $user->password=Hash::make($request->password);
      $user->save();
      Auth::logout();
      $notification=array('messege'=>'password has changed','alert-type'=>'success');
      return redirect()->route('admin.login')->with($notification);
    }
    else{
      $notification=array('messege'=>'Old password is invalid','alert-type'=>'error');
      return back()->with($notification);
    }
  }
}
