<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
class PageController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  //Page Index method
  public function index(){
    $data=DB::table('pages')->get();
    return view('admin.setting.page.index',compact('data'));
  }
  //page Create
  public function create(){
    return view('admin.setting.page.create',);
  }

  //page Store Method
  public function  store(Request $request){
    $data=array();
    $data['page_position']=$request->page_position;
    $data['page_name']=$request->page_name;
    $data['page_slug']=Str::slug($request->page_name, '-');
    $data['page_title']=$request->page_title;
    $data['description']=$request->description;
    DB::table('pages')->insert($data);
    $notification=array('messege'=>'A page Added Successfully!','alert-type'=>'success');
    return redirect()->route('page.index')->with($notification);
  }
//page Edit
  public function edit($id){
    $data=DB::table('pages')->where('id',$id)->first();
    return view('admin.setting.page.edit',compact('data'));
  }
  //page Update
  public function update(Request $request,$id){
    $data=array();
    $data['page_position']=$request->page_position;
    $data['page_name']=$request->page_name;
    $data['page_slug']=Str::slug($request->page_name, '-');
    $data['page_title']=$request->page_title;
    $data['description']=$request->description;
    DB::table('pages')->where('id',$id)->update($data);
    $notification=array('messege'=>'A page updated Successfully!','alert-type'=>'success');
    return redirect()->route('page.index')->with($notification);
  }
  //page delete
  public function destory($id){
    DB::table('pages')->where('id',$id)->delete();
    $notification=array('messege'=>'A page deleted Successfully!','alert-type'=>'success');
    return back()->with($notification);
  }
}
