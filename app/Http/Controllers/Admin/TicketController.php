<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Image;
use App\Models\Ticket;
use App\Models\Reply_ticket;

class TicketController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $ticket="";
      $query=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id');

      if($request->date){
        $query->where('tickets.date',$request->date);
      }
      if ($request->type=='Technical') {
        $query->where('tickets.service',$request->type);
     }
     if ($request->type=='Payment') {
        $query->where('tickets.service',$request->type);
     }
     if ($request->type=='Affiliate') {
        $query->where('tickets.service',$request->type);
     }
     if ($request->type=='Return') {
        $query->where('tickets.service',$request->type);
     }
     if ($request->type=='Refund') {
        $query->where('tickets.service',$request->type);
     }

      if($request->status==0){
        $query->where('tickets.status',0);
      }
      if($request->status==1){
        $query->where('tickets.status',1);
      }
      if($request->status==2){
        $query->where('tickets.status',2);
      }
    $ticket=$query->select('tickets.*','users.name')->get();
      return DataTables::of($ticket)
             ->addIndexColumn()
             ->editColumn('status',function($row){
               if($row->status==1){
                 return '<span class="badge badge-success">Running</span>';
               }
               elseif($row->status==2){
                 return '<span class="badge badge-danger">close</span>';
               }
               else {
                 return '<span class="badge badge-warning">Pending</span>';
               }
             })

             ->addColumn('action', function($row){
               $actionbtn='
               <a href="'.Route('admin.ticket.show',[$row->id]).'"   class="btn btn-info btn-sm edit">
                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
               </a>
               <a href="'.Route('admin.ticket.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                 <i class="fa fa-trash-o" aria-hidden="true"></i>
               </a>
               ';
               return $actionbtn;
             })
             ->rawColumns(['action','status','date'])
             ->make(true);
    }

    return view('admin.ticket.index');
  }

  //__TICKET SHOW
  public function ticketshow($id)
  {
    // $ticket=Ticket::findOrFail($id)->first();
    $ticket=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id')->select('tickets.*','users.name')->where('tickets.id',$id)->first();
    return view('admin.ticket.ticket_show',compact('ticket'));
  }

  //__  ADMIN_REPLY
  public function reply(Request $request)
  {
    $request->validate([
      'message'=>'required',
    ]);
    $return_from_db=Reply_ticket::create([
      'user_id'=>0,
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
    DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>1]);
    $notification=array('messege'=>'Ticket replied successfully!','alert-type'=>'success');

    return back()->with($notification);
  }

  public function closeticket($id)
  {
    DB::table('tickets')->where('id',$id)->update(['status'=>2]);
    $notification=array('messege'=>'Ticket closed successfully!','alert-type'=>'success');

    return redirect()->route('ticket.index')->with($notification);
  }

  public function destory($id)
  {
    DB::table('tickets')->where('id',$id)->delete();
    $notification=array('messege'=>'Ticket deleted!','alert-type'=>'success');

    return back()->with($notification);
  }
}
