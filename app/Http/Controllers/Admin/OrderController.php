<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class OrderController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  //Order index
  public function index(Request $request)
  {
    if($request->ajax()){
      $product="";
      $query=DB::table('orders')->orderBy('id','desc');
      // if($request->payment_type){
      //   $query->where('products.category_id',$request->category_id);
      // }
      // if($request->warehouse_id){
      //   $query->where('products.warehouse_id',$request->warehouse_id);
      // }
      // if($request->brand_id)
      // {
      //   $query->where('products.brand_id',$request->brand_id);
      // }
      if($request->date){
        $order_date=date('d-m-Y',strtotime($request->date));
        $query->where('orders.date',$order_date);
      }
      if($request->payment_type){
        $query->where('orders.payment_type',$request->payment_type);
      }
      if($request->status==0){
        $query->where('orders.status',0);
      }
      if($request->status==1){
        $query->where('orders.status',1);
      }
      if($request->status==2){
        $query->where('orders.status',2);
      }
      if($request->status==3){
        $query->where('orders.status',3);
      }
      if($request->status==4){
        $query->where('orders.status',4);
      }
      if($request->status==5){
        $query->where('orders.status',5);
      }
    $product=$query->get();
      return DataTables::of($product)
             ->addIndexColumn()


             ->editColumn('status',function($row){
               if($row->status==0){
                 return '<span class="badge badge-danger">pending</span>';
               }
               elseif($row->status==1){
                 return ' <span class="badge badge-primary">order recieved</span>';
               }
               elseif($row->status==2){
                 return ' <span class="badge badge-info">order shipped</span>';
               }
               elseif($row->status==3){
                 return ' <span class="badge badge-success">order completed</span>';
               }
               elseif($row->status==4){
                 return ' <span class="badge badge-warning">order return</span>';
               }
               elseif($row->status==5){
                 return ' <span class="badge badge-danger">order cancel</span>';
               }

             })

             ->addColumn('action', function($row){
               $actionbtn='
               <a href="'.Route('order.edit',[$row->id]).'"   class="btn btn-info btn-sm edit">
                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
               </a>
               <a href="'.Route('order.view',[$row->id]).'"   class="btn btn-primary btn-sm edit" id="edit">
                 <i class="fa fa-eye" aria-hidden="true"></i>
               </a>
               <a href="'.Route('order.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                 <i class="fa fa-trash-o" aria-hidden="true"></i>
               </a>
               ';
               return $actionbtn;
             })
             ->rawColumns(['action','status'])
             ->make(true);
    }

    return view('admin.order.index');
  }

  //_admin order edit
  public function edit($id)
  {
    $order=DB::table('orders')->where('id',$id)->first();
    return view('admin.order.edit',compact('order'));
  }

  //_update status

  public function updatestatus(Request $request)
  {
    $data=array();
    $data['c_name']=$request->c_name;
    $data['c_phone']=$request->c_phone;
    $data['c_address']=$request->c_address;
    $data['status']=$request->status;
    DB::table('orders')->where('id',$request->id)->update($data);
    $notification=array('messege'=>'orders status updated Successfully!','alert-type'=>'success');
    return redirect()->route('order.index')->with($notification);
  }

  //_order_view

  public function orderview($id)
  {
    $order=DB::table('orders')->where('id',$id)->first();
    $order_details=DB::table('order_details')->where('order_id',$id)->get();
    return view('admin.order.view_order',compact('order','order_details'));
  }

  //_order_delete_from_admin_panel

  public function destory($id)
  {
    $order=DB::table('orders')->where('id',$id)->delete();
    $order_details=DB::table('order_details')->where('order_id',$id)->delete();
    $notification=array('messege'=>'orders  deleted Successfully!','alert-type'=>'success');
    return back()->with($notification);
  }
}
