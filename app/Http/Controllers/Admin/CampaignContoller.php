<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
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
                    ->addColumn('action',function($row){
                      $actionbtn=
                      '
                      <a href=""   class="btn btn-info btn-sm edit" id="edit">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </a>
                      <a href="" id="delete" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                      </a>
                      ';
                      return $actionbtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    return view('admin.offer.campaign.index');
  }
}
