<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Auth;
use Hash;

class ProfileSettingController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }



  public function ProfileSetting()
  {
    return view('user.setting');
  }


  //customerPasswordChange
  public function customerPasswordChange(Request $request)
  {
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
      return redirect()->route('login')->with($notification);
    }
    else{
      $notification=array('messege'=>'Old password is invalid','alert-type'=>'error');
      return back()->with($notification);
    }
  }
}
