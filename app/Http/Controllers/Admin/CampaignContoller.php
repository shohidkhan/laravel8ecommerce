<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;
use File;

class CampaignContoller extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $data=DB::table('campaigns')->get();

      return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                      if($row->status==1){
                        return '<a href=""> <span class="badge badge-success">active</span></a>';
                      }
                      else {
                        return '<a href=""> <span class="badge badge-danger">deactive</span></a>';
                      }
                    })
                    ->addColumn('action',function($row){
                      $actionbtn=
                      '
                      <a href="'.Route('campaign.edit',[$row->id]).'"   class="btn btn-info btn-sm edit" id="edit">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </a>
                      <a href="'.Route('campaign.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                      </a>
                      ';
                      return $actionbtn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
    }

    return view('admin.offer.campaign.index');
  }
  public function store(Request $request)
  {
    $request->validate([
      'title'=>'required|unique:campaigns',
      'start_date'=>'required',
      'end_date'=>'required',
      'image'=>'required',
      'discount'=>'required',
      'status'=>'required',
    ]);

    $data=array();
    $data['title']=$request->title;
    $data['start_date']=$request->start_date;
    $data['end_date']=$request->end_date;
    $data['discount']=$request->discount;
    $data['status']=$request->status;
    $data['month']=date('F');
    $data['year']=date('Y');
    $slug=Str::slug($request->title, '-');


    $photo=$request->image;
    $photo_name= $slug.'.'.$photo->getClientOriginalExtension();
    $Image_location=base_path('public/files/campaign/');
    Image::make($photo)->resize(600,90)->save($Image_location.$photo_name);
    $data['image']=$photo_name;
    DB::table('campaigns')->insert($data);
    $notification=array('messege'=>'campaigns Inserted!','alert-type'=>'success');
    return back()->with($notification);
  }
  public function destory($id)
  {
    $data=DB::table('campaigns')->where('id',$id)->first();
    $Image_location=base_path('public/files/campaign/').$data->image;
    if(File::exists($Image_location)){
      unlink($Image_location);
    }
    DB::table('campaigns')->where('id',$id)->delete();
    $notification=array('messege'=>'campaigns Deleted!','alert-type'=>'success');

    return back()->with($notification);
  }

  public function edit($id){
    $data=DB::table('campaigns')->where('id',$id)->first();
    return view('admin.offer.campaign.edit',compact('data'));
  }





  public function update(Request $request){
    $data=array();
    $data['title']=$request->title;
    $data['start_date']=$request->start_date;
    $data['end_date']=$request->end_date;
    $data['discount']=$request->discount;
    $data['status']=$request->status;

    if($request->image){
      $Image_location=base_path('public/files/campaign/').$request->old_image;
      if(File::exists($Image_location)){
        unlink($Image_location);
        $slug=Str::slug($request->title,'-');
        $photo=$request->image;
        $photo_name= $slug.'.'.$photo->getClientOriginalExtension();
        $Image_location=base_path('public/files/campaign/');
        Image::make($photo)->resize(600,90)->save($Image_location.$photo_name);
        $data['image']=$photo_name;
        DB::table('campaigns')->where('id',$request->brand_id)->update($data);
        $notification=array('messege'=>'Campaign Updated!','alert-type'=>'success');
        return redirect()->route('campaign.index')->with($notification);
      }
    }
    else {
      $data['image']=$request->old_image;
      DB::table('campaigns')->where('id',$request->campaign_id)->update($data);
      $notification=array('messege'=>'Campaign Updated!','alert-type'=>'success');
      return redirect()->route('campaign.index')->with($notification);
    }
  }
}
