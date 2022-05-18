<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class WarehouseController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request){
    if($request->ajax()){
      $data=DB::table('warehouses')->get();
      return DataTables::of($data)
              ->addIndexColumn()
              ->addColumn('action',function($row){
                $actionbtn=
                '
                <a href="'.Route('warehouse.edit',[$row->id]).'"   class="btn btn-info btn-sm edit" id="edit">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <a href="'.Route('warehouse.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
                ';
                return $actionbtn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }
    return view('admin.category.warehouse.index');
  }

  //Warehouse store
  public function store(Request $request){
    $request->validate([
      'warehouse_name'=>'required',
      'warehouse_address'=>'required',
      'warehouse_phone'=>'required|numeric',
    ]);

    $data=array();
    $data['warehouse_name']=$request->warehouse_name;
    $data['warehouse_address']=$request->warehouse_address;
    $data['warehouse_phone']=$request->warehouse_phone;
    DB::table('warehouses')->insert($data);
    $notification=array('messege'=>'Warehouse Added Successfully!','alert-type'=>'success');
    return back()->with($notification);
  }
  //wareHosue delete
  public function destory($id){
    DB::table('warehouses')->where('id',$id)->delete();
    $notification=array('messege'=>'Warehouse Deleted Successfully!','alert-type'=>'success');
    return back()->with($notification);
  }
  //wareHosue edit
  public function edit($id){
    $data=DB::table('warehouses')->where('id',$id)->first();
    return view('admin.category.warehouse.edit',compact('data'));
  }
  //wareHosue edit
  public function update(Request $request,$id){
    $data=array();
    $data['warehouse_name']=$request->warehouse_name;
    $data['warehouse_address']=$request->warehouse_address;
    $data['warehouse_phone']=$request->warehouse_phone;
    DB::table('warehouses')->where('id',$id)->update($data);
    $notification=array('messege'=>'Warehouse updated Successfully!','alert-type'=>'success');
    return redirect()->route('warehouse.index')->with($notification);
  }
}
