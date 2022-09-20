<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Str;
use Image;
use File;
use DataTables;

class BlogController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    //__blog post__//
    public function index(Request $request)
    {

      if($request->ajax()){
        $blog="";
        $query=DB::table('blogs')
        ->leftJoin('blog_categories','blogs.blog_category_id','blog_categories.id');

        // if($request->status==0){
        //   $query->where('blogs.status',0);
        // }
        // if($request->status==1){
        //   $query->where('blogs.status',1);
        // }
      $blog=$query->select('blogs.*','blog_categories.category_name')
        ->get();
        return DataTables::of($blog)
               ->addIndexColumn()


               ->editColumn('status',function($row){
                 if($row->status==1){
                   return '<a href="" data-id="'.$row->id.'" class="deactive_status"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span></a>';
                 }
                 else {
                   return '<a href="" data-id="'.$row->id.'" class="active_status"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span></a>';
                 }
               })

               ->addColumn('action', function($row){
                 $actionbtn='
                 <a href="'.Route('blog.edit',$row->id).'"   class="btn btn-info btn-sm edit">
                   <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                 </a>
                 <a href=""   class="btn btn-primary btn-sm edit" id="edit">
                   <i class="fa fa-eye" aria-hidden="true"></i>
                 </a>
                 <a href="'.Route('blog.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                   <i class="fa fa-trash-o" aria-hidden="true"></i>
                 </a>
                 ';
                 return $actionbtn;
               })
               ->rawColumns(['action','category_name','status'])
               ->make(true);
      }

      $blog_categories=DB::table('blog_categories')->get();
      return view('admin.blog.blog.index',compact('blog_categories'));

    }

    //__blog sotre method__//

    public function store(Request $request)
    {
      $request->validate([
        'blog_category_id'=>'required',
        'title'=>'required',
        'publish_date'=>'required',
        'description'=>'required|min:200',
        'thumbnail'=>'required',
      ]);

      $slug=Str::slug($request->title, '-');
      $data=array();
      $data['blog_category_id']=$request->blog_category_id;
      $data['title']=$request->title;
      $data['tag']=$request->tag;
      $data['publish_date']=$request->publish_date;
      $data['description']=$request->description;
      $data['slug']=$slug;
      $data['status']=$request->status;



      //blog Thumbanail
      if ($request->thumbnail) {
        $thumbnail=$request->thumbnail;
        $thumbnail_name= $slug.'.'.$thumbnail->getClientOriginalExtension();
        $thumbnail_location=base_path('public/files/blog/');
        Image::make($thumbnail)->resize(600,600)->save($thumbnail_location.$thumbnail_name);
        $data['thumbnail']=$thumbnail_name;
      }

      DB::table('blogs')->insert($data);
      $notification=array('messege' => 'Blog Inserted!', 'alert-type' => 'success');
      return back()->with($notification);
    }

    //__deactive_status__//

    public function deactive_status($id)
    {
      DB::table('blogs')->where('id',$id)->update(['status'=>0]);
      return response()->json('deactived Status!');
    }
    //__active_status__//

    public function active_status($id)
    {
      DB::table('blogs')->where('id',$id)->update(['status'=>1]);
      return response()->json('deactived Status!');
    }


    // BLog delete__//

    public function destory($id)
    {
      $blog=DB::table('blogs')->where('id',$id)->first();
      $img_path=base_path('public/files/blog/'.$blog->thumbnail);
      if (file_exists($img_path)) {
           @unlink($img_path);
       }
      DB::table('blogs')->where('id',$id)->delete();
      $notification=array('messege' => 'Blog Deleted!', 'alert-type' => 'success');
      return back()->with($notification);
    }


    //__BLog Edit__//

    public function edit($id)
    {
      $blog=DB::table('blogs')->where('id',$id)->first();
      $blog_categories=DB::table('blog_categories')->get();
      return view('admin.blog.blog.edit',compact('blog_categories','blog'));
    }

    //__blog Update__//

    public function update(Request $request)
    {

      $request->validate([
        'blog_category_id'=>'required',
        'title'=>'required',
        'publish_date'=>'required',
        'description'=>'required|min:200',
      ]);

      $slug=Str::slug($request->title, '-');
      $data=array();
      $data['blog_category_id']=$request->blog_category_id;
      $data['title']=$request->title;
      $data['tag']=$request->tag;
      $data['publish_date']=$request->publish_date;
      $data['description']=$request->description;
      $data['slug']=$slug;
      if ($request->thumbnail) {
        $image_location=base_path('public/files/blog/').$request->old_img;
        if(File::exists($image_location)){
          unlink($image_location);

          $thumbnail=$request->thumbnail;
          $thumbnail_name= $slug.'.'.$thumbnail->getClientOriginalExtension();
          $thumbnail_location=base_path('public/files/blog/');
          Image::make($thumbnail)->resize(600,600)->save($thumbnail_location.$thumbnail_name);
          $data['thumbnail']=$thumbnail_name;
          DB::table('blogs')->where('id',$request->blog_id)->update($data);
          $notification=array('messege' => 'Blog updated!', 'alert-type' => 'success');
          return back()->with($notification);
        }
      }
      else {
        $data['thumbnail']=$request->old_img;
        DB::table('blogs')->where('id',$request->blog_id)->update($data);
        $notification=array('messege' => 'Blog updated!', 'alert-type' => 'success');
        return back()->with($notification);
      }

    }
}
