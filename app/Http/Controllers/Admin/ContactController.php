<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mail;
use App\Mail\ContactMail;
class ContactController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $contacts=DB::table('contacts')->orderBy('id','desc')->get();
    return view('admin.contact.index',compact('contacts'));
  }


  //__View single Contact__//
   public function contact_view($id)
   {
     $single_contact=DB::table('contacts')->where('id',$id)->first();
     return view('admin.contact.view',compact('single_contact'));
   }

   //__contact_send_mail__//
   public function contact_send_mail($email)
   {
     $details=[
       'title'=>'thanks for contact with us.',
       'body'=>'How we can help you, please let us know.',
     ];
     DB::table('contacts')->where('email',$email)->update(['status'=>1]);
     Mail::to($email)->send(new ContactMail($details));
     $notification=array('messege' => 'Successfully send  mail to user!', 'alert-type' => 'success');
     return back()->with($notification);
   }
}
