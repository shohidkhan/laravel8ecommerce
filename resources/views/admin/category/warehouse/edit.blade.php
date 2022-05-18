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
              <li class="breadcrumb-item"><a href="{{route('warehouse.index')}}">Warehouse</a></li>
              <li class="breadcrumb-item active">Edit warehouse</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card">
             <div class="card-header">Edit Warehouse</div>
             <div class="card-body">
               <form class="" action="{{route('warehouse.update',$data->id)}}" method="post">
                 @csrf
                 <div class="form-group">
                   <label for="">Warehouse Name</label>
                   <input type="text" class="form-control" value="{{$data->warehouse_name}}"  name="warehouse_name" required>
                   @error('warehouse_name')
                   {{$message}}
                   @enderror
                 </div>
                 <div class="form-group">
                   <label for="">Warehouse Address</label>
                   <input type="text" value="{{$data->warehouse_address}}" class="form-control"  name="warehouse_address" required>
                   @error('warehouse_address')
                   {{$message}}
                   @enderror
                 </div>
                 <div class="form-group">
                   <label for="">Warehouse Phone</label>
                   <input type="text" class="form-control" value="{{$data->warehouse_phone}}"  name="warehouse_phone" required>
                   @error('warehouse_phone')
                   {{$message}}
                   @enderror
                 </div>
               </div>
               <div class="modal-footer">

                 <button type="submit" class="btn btn-primary">update</button>
               </div>
               </form>
             </div>
        </div>
      </div>
    </section>
</div>
    @endsection
