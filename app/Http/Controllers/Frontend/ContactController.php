<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ContactController extends Controller
{
    public function contact()
    {
      return view('frontend.contact');
    }

    //__Contaact send to Admin Panel__//

    public function contactpost(Request $request)
    {
      $data=array();
      $data['f_name']=$request->f_name;
      $data['email']=$request->email;
      $data['phone']=$request->phone;
      $data['message']=$request->message;

      DB::table('contacts')->insert($data);

      $notification=array('messege'=>'Message sent successfully!','alert-type'=>'success');
      return back()->with($notification);
    }
}
