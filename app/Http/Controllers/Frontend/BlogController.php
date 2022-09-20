<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class BlogController extends Controller
{
    //__All Blogs are here__//
    public function blogs()
    {
      $blogs=DB::table('blogs')->where('status',1)->orderBy('id','desc')->paginate(5);
      return view('frontend.blog.blog',compact('blogs'));
    }

    //____BLog Details__//

    public function blog_details($slug)
    {
      $blog_details=DB::table('blogs')->where('slug',$slug)->first();

      // $related_blogs=DB::table('blogs')->where('status',1)->where('blog_category_id',$blog_details->blog_category_id)->take(5)->get()

      return view('frontend.blog.blog_details',compact('blog_details'));
    }
}
