<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Auth;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function admin(){
    return view('admin.home');
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
