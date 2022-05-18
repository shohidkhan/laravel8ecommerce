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
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Pick-up-point</li>
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
                Edit Pickup point
              </div>
              <div class="card-body">
                <form class="" action="{{route('pickuppoint.update',$data->id)}}" method="post">
                  @csrf

                  <div class="form-group">
                    <label for="">Pickup point Name</label>
                    <input type="text" class="form-control" value="{{$data->pickup_point_name}}"  name="pickup_point_name" required>
                    @error('pickup_point_name')
                    {{$message}}
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Pickup point Address</label>
                    <input type="text" class="form-control" value="{{$data->pickup_point_address}}"  name="pickup_point_address" required>
                    @error('pickup_point_address')
                    {{$message}}
                    @enderror
                  </div>
                  <div>
                    <label for="">Phone</label>
                    <input type="text" class="form-control" value="{{$data->phone}}"  name="phone" required>
                    @error('phone')
                    {{$message}}
                    @enderror
                  </div>
                  <div>
                    <label for="">Another Phone</label>
                    <input type="text" class="form-control" name="phone_two" value="{{$data->phone_two}}"  name="phone" required>
                    @error('phone_two')
                    {{$message}}
                    @enderror
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      </section>
  </div>
  @endsection
