<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use DB;

class CategoryController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function index(){
      //$categories=Category::all();
      $categories=DB::table('categories')->get();
      return view('admin.category.category.index',compact('categories'));
    }

    public function store(Request $request){
      $request->validate([
        'category_name'=>'required|unique:categories|max:255',
        'home_page'=>'required',
      ]);
      $data=array();
      $data['category_name']=$request->category_name;
      $data['home_page']=$request->home_page;
      $data['category_slug']=Str::slug($request->category_name, '-');
      DB::table('categories')->insert($data);
      $notification=array('messege'=>'Category Added Successfully!','alert-type'=>'success');
      return back()->with($notification);

    }
    ///Edit get_class_methods
    public function edit($id){
      //$data=DB::table('categories')->where('id',$id)->first();
       $data=Category::findorfail($id);
        return view('admin.category.category.edit',compact('data'));
    }
    public function update(Request $request){

      Category::find($request->id)->update([
        'category_name'=>$request->category_name,
        'home_page'=>$request->home_page,
        'category_slug'=>Str::slug($request->category_name, '-'),
      ]);
      $notification=array('messege'=>'Category Updated Successfully!','alert-type'=>'success');
      return redirect()->route('category.index')->with($notification);
    }

    public function destory($id){
      //Category::find($id)->delete();
        DB::table('categories')->where('id',$id)->delete();
        $notification=array('messege'=>'Category Deleted Successfully!','alert-type'=>'success');
        return  back()->with($notification);
    }
    public function getchildcategory($id)
    {
      $data=DB::table('childcategories')->where('subcategory_id',$id)->get();
      return response()->json($data);
    }
}
