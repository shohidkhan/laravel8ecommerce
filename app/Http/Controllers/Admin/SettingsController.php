<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class SettingsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  //Seo View Method
    public function seo(){
      $data=DB::table('seos')->first();
      return view('admin.setting.seo',compact('data'));
    }
    // Seo Update Method
    public function seoupdate(Request $request, $id){
      $data=array();
      $data['meta_title']=$request->meta_title;
      $data['meta_author']=$request->meta_author;
      $data['meta_tag']=$request->meta_tag;
      $data['meta_description']=$request->meta_description;
      $data['google_verification']=$request->google_verification;
      $data['google_analytics']=$request->google_analytics;
      $data['alexa_verification']=$request->alexa_verification;
      $data['google_adsenses']=$request->google_adsenses;
      DB::table('seos')->where('id',$id)->update($data);
      $notification=array('messege'=>'Seo Settings Successfully!','alert-type'=>'success');
      return back()->with($notification);
    }

    //Smtp View Method
    public function smtp(){
      $data=DB::table('smtps')->first();
      return view('admin.setting.smtp',compact('data'));
    }
    //Smtp Update Method
    public function smtpupdate(Request $request,$id){
      $data=array();
      $data['mailer']=$request->mailer;
      $data['host']=$request->host;
      $data['port']=$request->port;
      $data['username']=$request->username;
      $data['password']=$request->password;
      DB::table('smtps')->where('id',$id)->update($data);
      $notification=array('messege'=>'Smtp Settings updated Successfully!','alert-type'=>'success');
      return back()->with($notification);
    }

    //Website setting get_class_methods
    public function websitesetting(){
      $data=DB::table('settings')->first();
      return view('admin.setting.website_setting',compact('data'));
    }
    //Website setting update
    public function websiteupdate(Request $request,$id){
      $data=array();
      $data['currency']=$request->currency;
      $data['phone_one']=$request->phone_one;
      $data['phone_two']=$request->phone_two;
      $data['main_email']=$request->main_email;
      $data['support_email']=$request->support_email;
      $data['address']=$request->address;
      $data['facebook']=$request->facebook;
      $data['twitter']=$request->twitter;
      $data['instagram']=$request->instagram;
      $data['linkedin']=$request->linkedin;
      $data['youtube']=$request->youtube;
      //Logo Image
      if($request->logo){
        $logo=$request->logo;
        $logo_name= uniqid().'.'.$logo->getClientOriginalExtension();
        $Image_location=base_path('public/files/setting/');
        Image::make($logo)->resize(320,120)->save($Image_location.$logo_name);
        $data['logo']=$logo_name;
      }
      else{
        $data['logo']=$request->old_logo;
      }
      //Favicon
      if($request->favicon){
        $favicon=$request->favicon;
        $favicon_name= uniqid().'.'.$favicon->getClientOriginalExtension();
        $Image_location=base_path('public/files/setting/');
        Image::make($favicon)->resize(32,32)->save($Image_location.$favicon_name);
        $data['favicon']=$favicon_name;
      }
      else{
        $data['favicon']=$request->old_favicon;
      }
      DB::table('settings')->where('id',$id)->update($data);
      $notification=array('messege'=>'Website Settings updated Successfully!','alert-type'=>'success');
      return back()->with($notification);
    }
}
