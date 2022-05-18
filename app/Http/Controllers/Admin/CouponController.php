<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
class CouponController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request){
    if($request->ajax()){
      $data=DB::table('coupons')->get();
      return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
              $actionbtn=
              '
              <a href="'.Route('coupon.edit',[$row->id]).'"   class="btn btn-info btn-sm edit" id="edit">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
              <a href="'.Route('coupon.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </a>
              ';
              return $actionbtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    return view('admin.offer.coupon.index');
  }

  public function store(Request $request){
    $request->validate([
      'coupon_code'=>'required',
      'validity_date'=>'required',
      'type'=>'required',
      'coupon_amount'=>'required',
      'status'=>'required',
    ]);
    $data=array();
    $data['coupon_code']=$request->coupon_code;
    $data['validity_date']=$request->validity_date;
    $data['type']=$request->type;
    $data['coupon_amount']=$request->coupon_amount;
    $data['status']=$request->status;

    DB::table('coupons')->insert($data);
    $notification=array('messege'=>'Coupon Added Successfully!','alert-type'=>'success');
    return back()->with($notification);
  }
  public function destory($id){
    DB::table('coupons')->where('id',$id)->delete();
    $notification=array('messege'=>'Coupon deleted Successfully!','alert-type'=>'success');
    return back()->with($notification);
  }
  public function  edit($id){
    $data=DB::table('coupons')->where('id',$id)->first();
    return view('admin.offer.coupon.edit',compact('data'));
  }
  public function update(Request $request,$id){
    $data=array();
    $data['coupon_code']=$request->coupon_code;
    $data['validity_date']=$request->validity_date;
    $data['type']=$request->type;
    $data['coupon_amount']=$request->coupon_amount;
    $data['status']=$request->status;
    DB::table('coupons')->where('id',$id)->update($data);
    $notification=array('messege'=>'Coupon updated Successfully!','alert-type'=>'success');
    return redirect()->route('coupon.index')->with($notification);
  }
}
