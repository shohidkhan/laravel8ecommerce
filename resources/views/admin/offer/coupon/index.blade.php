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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Coupon list here</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Coupon Code</th>
                      <th>Coupon Amount</th>
                      <th>Coupon Date</th>
                      <th>Coupon Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                  </table>

                  <form id="deleted_form" action="" method="post">
                      @method('DELETE')
                      @csrf
                  </form>

                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="modal_body">

     </div>
    </div>
  </div>
</div>


{{-- category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Coupon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{route('coupon.store')}}" method="post">
      	@csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="coupon_code">Coupon Code </label>
            <input type="text" class="form-control"  name="coupon_code" >
            <span class="text-danger">
              @error('coupon_code')
              {{$message}}
              @enderror
            </span>
          </div>
          <div class="form-group">
            <label for="coupon_code">Coupon Type </label>
            <select class="form-control" name="type" >
            	<option value="1">Fixed</option>
            	<option value="2">Percentage</option>
            </select>
            <span class="text-danger">
              @error('type')
              {{$message}}
              @enderror
            </span>
          </div>
          <div class="form-group">
            <label for="coupon_amount">Amount </label>
            <input type="text" class="form-control"  name="coupon_amount" >

            <span class="text-danger">
              @error('coupon_amount')
              {{$message}}
              @enderror
            </span>
          </div>
          <div class="form-group">
            <label for="valid_date">Valid Date</label>
            <input type="date" class="form-control"  name="validity_date">

            <span class="text-danger">
              @error('validity_date')
              {{$message}}
              @enderror
            </span>
          </div>
          <div class="form-group">
            <label for="coupon_code">Coupon Status </label>
            <select class="form-control" name="status" >
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
            <span class="text-danger">
              @error('status')
              {{$message}}
              @enderror
            </span>
          </div>

      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="loading d-none"> Loading....</span> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

$(function coupon(){
		  table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('coupon.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'coupon_code'  ,name:'coupon_code'},
				{data:'coupon_amount',name:'coupon_amount'},
				{data:'validity_date',name:'validity_date'},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});





</script>
@endsection
