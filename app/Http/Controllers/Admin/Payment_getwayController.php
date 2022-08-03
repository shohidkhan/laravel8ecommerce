<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class Payment_getwayController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function payment_getway()
  {
    $aamarpay=DB::table('payment_gatways')->first();
    $surjopay=DB::table('payment_gatways')->skip(1)->first();
    $sslecommerz=DB::table('payment_gatways')->skip(2)->first();
    return view('admin.payment_gatway.edit',compact('aamarpay','surjopay','sslecommerz'));
  }

  public function updateaamrpay(Request $request)
  {
    $data=array();
    $data['store_id']=$request->store_id;
    $data['signature_key']=$request->signature_key;
    $data['status']=$request->status;
    DB::table('payment_gatways')->where('id',$request->id)->update($data);
    return back();
  }

  public function updatsurjopay(Request $request)
  {
    $data=array();
    $data['store_id']=$request->store_id;
    $data['signature_key']=$request->signature_key;
    $data['status']=$request->status;
    DB::table('payment_gatways')->where('id',$request->id)->update($data);
    return back();
  }
}
