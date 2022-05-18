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
              <li class="breadcrumb-item active">Childcategory</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
             <div class="card-header">
               <h3 class="card-title">All warehouse list here</h3>
               <div class="">
                 <button data-toggle="modal" data-target="#childcategoryModal" class="btn btn-primary float-right">+ Add New</button>
               </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="" class="table table-bordered table-striped table-sm ytable">
                 <thead>
                 <tr>
                   <th>SL</th>
                   <th>Warehouse Name</th>
                   <th>Warehouse Address</th>
                   <th>Warehouse Phone</th>
                   <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>

                 </tbody>

               </table>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
      </div>
    </section>

    <!-- Modal -->
<div class="modal fade" id="childcategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Childcategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="" action="{{route('warehouse.store')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="">Warehouse Name</label>
          <input type="text" class="form-control"  name="warehouse_name" required>
          @error('warehouse_name')
          {{$message}}
          @enderror
        </div>
        <div class="form-group">
          <label for="">Warehouse Address</label>
          <input type="text" class="form-control"  name="warehouse_address" required>
          @error('warehouse_address')
          {{$message}}
          @enderror
        </div>
        <div class="form-group">
          <label for="">Warehouse Phone</label>
          <input type="text" class="form-control"  name="warehouse_phone" required>
          @error('warehouse_phone')
          {{$message}}
          @enderror
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$(function warehouse(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('warehouse.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'warehouse_name'  ,name:'warehouse_name'},
        {data:'warehouse_address',name:'warehouse_address'},
				{data:'warehouse_phone',name:'warehouse_phone'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

</script>
@endsection
