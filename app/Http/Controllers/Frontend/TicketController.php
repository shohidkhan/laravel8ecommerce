<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Reply_ticket;
use Auth;
use Image;
class TicketController extends Controller
{

    //OPEN TICKET
    public function openticket()
    {
      $ticket=Ticket::where('user_id',Auth::id())->take(10)->get();
      return view('user.ticket',compact('ticket'));
    }

    //NEW TICKET
    public function newticket()
    {
      return view('user.new_ticket');
    }
    //STORE TICKET
    public function storeticket(Request $request)
    {
      $return_from_db=Ticket::create([
        'user_id'=>Auth::id(),
        'subject'=>$request->subject,
        'service'=>$request->service,
        'priority'=>$request->priority,
        'message'=>$request->message,
        'status'=>0,
        'date'=>date('Y-m-d'),
      ]);

      if($request->image){
        $uploaded_photo=$request->file('image');
        $photo_name=$return_from_db->id.'.'.$uploaded_photo->extension();
        $photo_location=base_path('public/files/ticket/'.$photo_name);
        Image::make($uploaded_photo)->resize(600,350)->save($photo_location);

        Ticket::find($return_from_db->id)->update([
        'image'=>$photo_name,
      ]);
      }

      $notification=array('messege'=>'Ticket submited successfully!','alert-type'=>'success');

      return redirect()->route('open.ticket')->with($notification);
    }
    //SHOW TICKET
    public function showticket($id)
    {
      $ticket=Ticket::where('id',$id)->first();
      return view('user.show_ticket',compact('ticket'));
    }


    //__REPLY_TICKET
    public function reply(Request $request)
    {
      $request->validate([
        'message'=>'required',
      ]);
      $return_from_db=Reply_ticket::create([
        'user_id'=>Auth::id(),
        'ticket_id'=>$request->ticket_id,
        'message'=>$request->message,
        'date'=>date('Y-m-d'),
      ]);
      if($request->image){
        $uploaded_photo=$request->file('image');
        $photo_name=$return_from_db->id.'.'.$uploaded_photo->extension();
        $photo_location=base_path('public/files/reply/'.$photo_name);
        Image::make($uploaded_photo)->resize(600,350)->save($photo_location);

        Reply_ticket::find($return_from_db->id)->update([
        'image'=>$photo_name,
      ]);
      }
      $notification=array('messege'=>'Ticket replied successfully!','alert-type'=>'success');

      return back()->with($notification);
    }
}
