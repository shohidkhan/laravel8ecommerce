<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
class SubcategoryController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(){

    $data=DB::table('subcategories')->leftJoin('categories','subcategories.category_id','categories.id')
    	      ->select('subcategories.*','categories.category_name')->get();

    //$category=Category::all();
    $category=DB::table('categories')->get();
    //$subcategories=DB::table('subcategories')->get();
    return  view('admin.category.subcategory.index',compact('category','data'));
  }

//insert Methodx
  public function store(Request $request){
    $request->validate([
      'subcategory_name'=>'required|max:255',
    ]);
    $data=array();
    $data['category_id']=$request->category_id;
    $data['subcategory_name']=$request->subcategory_name;
    $data['subcategory_slug']=Str::slug($request->subcategory_name, '-');
    $data['created_at']=Carbon::now();
    DB::table('subcategories')->insert($data);
    $notification=array('messege'=>'Subcategory Added Successfully!','alert-type'=>'success');
    return back()->with($notification);

  }
  //Destroy method
  public function destory($id){
    DB::table('subcategories')->where('id',$id)->delete();
    $notification= array('messege' =>'Subcategory Deleted Successfully!' , 'alert-type'=>'success');
    return back()->with($notification);
  }
  //Edit Method
  public function edit($id){
    $data=DB::table('subcategories')->where('id',$id)->first();
    $category=DB::table('categories')->get();
    return view('admin.category.subcategory.edit',compact('data','category'));
  }
  //Update method
  public function update(Request $request){
      // Subcategory::where('id',$request->id)->update([
      //   'category_id'=>$request->category_id,
      //   'subcategory_name'=>$request->subcategory_name,
      //   'subcategory_slug'=>Str::slug($request->subcategory_name, '-'),
      // ]);
      $data=array();
      $data['category_id']=$request->category_id;
      $data['subcategory_name']=$request->subcategory_name;
      $data['subcategory_slug']=Str::slug($request->subcategory_name, '-');
      DB::table('subcategories')->where('id',$request->id)->update($data);

      $notification = array('messege' =>'Subcategory Updated' ,'alert-type'=>'success' );
      return  redirect()->route('subcategory.index')->with($notification);
  }
}
