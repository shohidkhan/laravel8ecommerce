<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Image;
use File;

class BrandController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(Request $request){

    if($request->ajax()){
        $data=DB::table('brands')->get();
        return DataTables::of($data)
              ->addIndexColumn()
              ->editColumn('front_page',function($row){
                if($row->front_page==1){
                  return '<a href=""> <span class="badge badge-success">Home page</span></a>';
                }
                else {
                  return '<a href=""> <span class="badge badge-danger">Not home page</span></a>';
                }
              })
              ->addColumn('action',function($row){
                $actionbtn=
                '
                <a href="'.Route('brand.edit',[$row->id]).'"   class="btn btn-info btn-sm edit" id="edit">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <a href="'.Route('brand.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
                ';
                return $actionbtn;
              })
              ->rawColumns(['action','front_page'])
              ->make(true);
    }



    return view('admin.category.brand.index');
  }


  //Brand Store method
  public function store(Request $request){
    $request->validate([
      'brand_name'=>'required|unique:brands|max:255',
    ]);
    $slug=Str::slug($request->brand_name, '-');
    $data=array();
    $data['brand_name']=$request->brand_name;
    $data['front_page']=$request->front_page;
    $data['brand_slug']=Str::slug($request->brand_name, '-');
    //image Insert
    $photo=$request->brand_logo;
    $photo_name= $slug.'.'.$photo->getClientOriginalExtension();
    $Image_location=base_path('public/files/brand/');
    Image::make($photo)->resize(240,120)->save($Image_location.$photo_name);
    $data['brand_logo']=$photo_name;
    DB::table('brands')->insert($data);
    $notification=array('messege'=>'Brand Inserted!','alert-type'=>'success');
    return back()->with($notification);
  }
  //Brand destory method
  public function destory($id){
    $data=DB::table('brands')->where('id',$id)->first();
    $Image_location=base_path('public/files/brand/').$data->brand_logo;
    if(File::exists($Image_location)){
      unlink($Image_location);
    }
    DB::table('brands')->where('id',$id)->delete();
    $notification=array('messege'=>'Brand Deleted!','alert-type'=>'success');

    return back()->with($notification);
  }
  public function edit($id){
    $data=DB::table('brands')->where('id',$id)->first();
    return view('admin.category.brand.edit',compact('data'));
  }
  // Brand Update Method
  public function update(Request $request){
    $data=array();
    $data['brand_name']=$request->brand_name;
    $data['front_page']=$request->front_page;
    $data['brand_slug']=Str::slug($request->brand_name, '-');

    if($request->brand_logo){
      $Image_location=base_path('public/files/brand/').$request->old_logo;
      if(File::exists($Image_location)){
        unlink($Image_location);
        $slug=Str::slug($request->brand_name, '-');
        $photo=$request->brand_logo;
        $photo_name= $slug.'.'.$photo->getClientOriginalExtension();
        $Image_location=base_path('public/files/brand/');
        Image::make($photo)->resize(240,120)->save($Image_location.$photo_name);
        $data['brand_logo']=$photo_name;
        DB::table('brands')->where('id',$request->brand_id)->update($data);
        $notification=array('messege'=>'Brand Updated!','alert-type'=>'success');
        return redirect()->route('brand.index')->with($notification);
      }
    }
    else {
      $data['brand_logo']=$request->old_logo;
      DB::table('brands')->where('id',$request->brand_id)->update($data);
      $notification=array('messege'=>'Brand Updated!','alert-type'=>'success');
      return redirect()->route('brand.index')->with($notification);
    }
  }
}
