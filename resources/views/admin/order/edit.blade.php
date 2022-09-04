@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('order.index')}}">orders</a></li>
              <li class="breadcrumb-item active">Orders Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 m-auto">
            <div class="card">
              <div class="card-header">
                Edit Order
              </div>
              <div class="card-body">
                <form action="{{route('update.status',$order->id)}}" method="post">
                  @csrf
                  <div class="form-group">
                    <label>Name</label>
                    <input type="hidden" name="id" value="{{$order->id}}">

                    <input type="text" name="c_name" class="form-control" value="{{$order->c_name}}">

                  </div>
                  <div class="form-group">
                    <label>Phone</label>

                    <input type="text" name="c_phone" class="form-control" value="{{$order->c_phone}}">

                  </div>
                  <div class="form-group">
                    <label>Address</label>

                    <input type="text" name="c_address" class="form-control" value="{{$order->c_address}}">

                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" id="status">
                     <option value="">All</option>
                         <option value="0" @if($order->status==0) selected @endif>Pending</option>
                         <option value="1" @if($order->status==1) selected @endif>Recieve</option>
                         <option value="2" @if($order->status==2) selected @endif>Shipped</option>
                         <option value="3" @if($order->status==3) selected @endif>Completed</option>
                         <option value="4" @if($order->status==4) selected @endif>Return</option>
                         <option value="5" @if($order->status==5) selected @endif>Cancel</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
