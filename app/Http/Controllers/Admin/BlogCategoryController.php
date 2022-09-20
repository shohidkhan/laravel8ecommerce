<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
class BlogCategoryController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function index()
    {
        $blog_categories=BlogCategory::all();
        return view('admin.blog.category.index',compact('blog_categories'));
    }

    //__BLog category post__//

    public function store(Request $request)
    {
        $request->validate([
            'category_name'=>'required|unique:categories|max:255',
          ]);

          BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug'=>Str::slug($request->category_name, '-'),
          ]);
          $notification=array('messege'=>'Blog Category Added Successfully!','alert-type'=>'success');
          return back()->with($notification);
    }

    //__Blog Edit Page__//
    public function edit($id)
    {
      $data=BlogCategory::find($id)->first();
      return view('admin.blog.category.edit',compact('data'));
    }

    //__Blog update__//
    public function update(Request $request)
    {
      BlogCategory::find($request->id)->update([
        'category_name' => $request->category_name,
        'category_slug'=>Str::slug($request->category_name, '-'),
      ]);

      $notification=array('messege'=>'Blog Category updated Successfully!','alert-type'=>'success');
      return back()->with($notification);

    }

    // ___BLog category delete__//
    public function destory($id)
    {
      BlogCategory::find($id)->delete();
      $notification=array('messege'=>'Blog Category Deleted Successfully!','alert-type'=>'success');
      return back()->with($notification);
    }
}
