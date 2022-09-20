<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;

class RoleController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $data=DB::table('users')->where('is_admin',1)->where('role_admin',1)->get();
    return view('admin.user_role.index',compact('data'));
  }

  public function create()
  {
    return view('admin.user_role.create');
  }


  public function store(Request $req)
  {
    $req->validate([
      'email'=>'required|unique:users',
      'password'=>'required|min:6',
      'name'=>'required',
    ]);


    $data=array();
    $data['name']=$req->name;
    $data['email']=$req->email;
    $data['password']=Hash::make($req->password);
    $data['category']=$req->category;
    $data['product']=$req->product;
    $data['offer']=$req->offer;
    $data['blog']=$req->blog;
    $data['contact']=$req->contact;
    $data['report']=$req->report;
    $data['pickuppoint']=$req->pickuppoint;
    $data['setting']=$req->setting;
    $data['order']=$req->order;
    $data['ticket']=$req->ticket;
    $data['userrole']=$req->userrole;
    $data['is_admin']=1;
    $data['role_admin']=1;

    DB::table('users')->insert($data);
    $notification=array('messege'=>'User Role Created Successfully!','alert-type'=>'success');
    return back()->with($notification);
  }


public function edit($id)
{
  $data=DB::table('users')->where('id',$id)->first();
  return view('admin.user_role.edit',compact('data'));
}

public function update(Request $req)
{
  $data=array();
  $data['name']=$req->name;
  $data['email']=$req->email;
  $data['category']=$req->category;
  $data['product']=$req->product;
  $data['offer']=$req->offer;
  $data['blog']=$req->blog;
  $data['contact']=$req->contact;
  $data['report']=$req->report;
  $data['pickuppoint']=$req->pickuppoint;
  $data['setting']=$req->setting;
  $data['order']=$req->order;
  $data['ticket']=$req->ticket;
  $data['userrole']=$req->userrole;

  DB::table('users')->where('id',$req->id)->update($data);
  $notification=array('messege'=>'User Role updated Successfully!','alert-type'=>'success');
  return back()->with($notification);
}


  public function destroy($id)
  {
    DB::table('users')->where('id',$id)->delete();  $notification=array('messege'=>'User Role deleted Successfully!','alert-type'=>'success');
      return back()->with($notification);
  }
}
