<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ChildcategoryController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  //index method
  public function index(Request $request){
      if ($request->ajax()) {
        $data=DB::table('childcategories')->leftJoin('categories','childcategories.category_id','categories.id')->leftJoin('subcategories','childcategories.subcategory_id','subcategories.id')
        ->select('categories.category_name','subcategories.subcategory_name','childcategories.*')->get();

        return  DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                  $actionbtn='
                  <a href="'.Route('childcategory.edit',[$row->id]).'"   class="btn btn-info btn-sm edit" id="edit">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a>
                  <a href="'.Route('childcategory.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </a>
                  ';
                  return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
      }
      $categories=DB::table('categories')->get();
      return view('admin.category.childcategory.index',compact('categories'));
  }
//Insert method
  public function store(Request $request){
    $cat_id=Subcategory::where('id',$request->subcategory_id)->first();
    //$cat_id=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
    $data=array();
    $data['childcategory_name']=$request->childcategory_name;
    $data['category_id']=$cat_id->category_id;
    $data['subcategory_id']=$request->subcategory_id;
    $data['childcategory_slug']=Str::slug($request->childcategory_name, '-');
    $data['created_at']=Carbon::now();

    DB::table('childcategories')->insert($data);
    $notification = array('messege' =>'Child-category Inserted!','alert-type'=>'success' );
    return back()->with($notification);

  }
//Edit Method
  public function edit($id){
    $childcategories=DB::table('childcategories')->where('id',$id)->first();
    $categories=DB::table('categories')->get();
    return view('admin.category.childcategory.edit',compact('childcategories','categories'));
  }
  // update  method
  public function update(Request $request){
    $cat_id=Subcategory::where('id',$request->subcategory_id)->first();
    $data=array();
    $data['childcategory_name']=$request->childcategory_name;
    $data['category_id']=$cat_id->category_id;
    $data['subcategory_id']=$request->subcategory_id;
    $data['childcategory_slug']=Str::slug($request->childcategory_name, '-');
    DB::table('childcategories')->where('id',$request->childcategory_id)->update($data);
    $notification = array('messege' =>'Child-category updated!','alert-type'=>'success' );
    return redirect()->route('childcategory.index')->with($notification);
  }
  //delete method
  public function destory($id){
    DB::table('childcategories')->where('id',$id)->delete();
    $notification = array('messege' =>'Child-category deleted!','alert-type'=>'success' );
    return back()->with($notification);
  }
}
