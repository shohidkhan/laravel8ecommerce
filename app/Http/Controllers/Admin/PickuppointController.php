<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
class PickuppointController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(Request $request){
    if($request->ajax()){
      $data=DB::table('pickuppoints')->get();
       return DataTables::of($data)
              ->addIndexColumn()
              ->addColumn('action',function($row){
                $actionbtn='
                <a href="'.Route('pickuppoint.edit',[$row->id]).'"   class="btn btn-info btn-sm edit" id="edit">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <a href="'.Route('pickuppoint.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
                ';
                return $actionbtn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }
    return view('admin.pickup_point.index');
  }

  //Pick up point Store
   public function store(Request $request)
  {
    $request->validate([
      'pickup_point_name'=>'required',
      'pickup_point_address'=>'required',
      'phone'=>'required',
    ]);

    $data=array();
    $data['pickup_point_name']=$request->pickup_point_name;
    $data['pickup_point_address']=$request->pickup_point_address;
    $data['phone']=$request->phone;
    $data['phone_two']=$request->phone_two;
    DB::table('pickuppoints')->insert($data);
    $notification = array('messege' =>'Pickup-point Added!','alert-type'=>'success' );
    return back()->with($notification);
  }
  //Pickup point delete
  public function destory($id)
  {
    DB::table('pickuppoints')->where('id',$id)->delete();
    $notification = array('messege' =>'Pickup-point deleted!','alert-type'=>'success' );
    return back()->with($notification);
  }
  //Pickup Point Edit
  public function edit($id)
  {
    $data=DB::table('pickuppoints')->where('id',$id)->first();
    return view ('admin.pickup_point.edit',compact('data'));
  }
  //update Pick up
  public function update(Request $request,$id)
  {
    $data=array();
    $data['pickup_point_name']=$request->pickup_point_name;
    $data['pickup_point_address']=$request->pickup_point_address;
    $data['phone']=$request->phone;
    $data['phone_two']=$request->phone_two;
    DB::table('pickuppoints')->where('id',$id)->update($data);
    $notification = array('messege' =>'Pickup-point Updated!','alert-type'=>'success' );
    return redirect()->route('pickuppoint.index')->with($notification);
  }
}
