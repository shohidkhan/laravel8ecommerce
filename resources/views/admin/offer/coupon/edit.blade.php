@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Coupon</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"> + Add New</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
     <div class="container-fluid">
       <div class="row">
         <div class="col-lg-6 m-auto">
           <div class="card">
             <div class="card-header">
               Edit Coupon
             </div>
             <div class="card-body">
               <form action="{{route('coupon.update',$data->id)}}" method="post">
                	@csrf
                <div class="modal-body">
                    <div class="form-group">
                      <label for="coupon_code">Coupon Code </label>
                      <input type="text" class="form-control" value="{{$data->coupon_code}}"  name="coupon_code" >
                      <span class="text-danger">
                        @error('coupon_code')
                        {{$message}}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="coupon_code">Coupon Type </label>
                      <select class="form-control" name="type" >
                      	<option value="1" @if ($data->type ==1) selected @endif>Fixed</option>
                      	<option value="2" @if ($data->type ==2) selected @endif>Percentage</option>
                      </select>
                      <span class="text-danger">
                        @error('type')
                        {{$message}}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="coupon_amount">Amount </label>
                      <input type="text" class="form-control"  name="coupon_amount" value="{{$data->coupon_amount}}">

                      <span class="text-danger">
                        @error('coupon_amount')
                        {{$message}}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="valid_date">Valid Date</label>
                      <input type="date" class="form-control"  name="validity_date" value="{{$data->validity_date}}">

                      <span class="text-danger">
                        @error('validity_date')
                        {{$message}}
                        @enderror
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="coupon_code">Coupon Status </label>
                      <select class="form-control" name="status" >
                        <option value="Active" {{($data->status=='Active')?'selected':''}}>Active</option>
                        <option value="Inactive" {{($data->status=='Inactive')?'selected':''}}>Inactive</option>
                      </select>
                      <span class="text-danger">
                        @error('status')
                        {{$message}}
                        @enderror
                      </span>
                    </div>

                <div class="modal-footer">
                  <button type="Submit" class="btn btn-primary"> <span class="loading d-none"> Loading....</span> Update</button>
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
