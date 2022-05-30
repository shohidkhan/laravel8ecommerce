@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
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
              <li class="breadcrumb-item active">brand</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
             <div class="card-header">
               <h3 class="card-title">All brand is here</h3>
               <div class="">
                 <button data-toggle="modal" data-target="#childcategoryModal" class="btn btn-primary float-right">+ Add New</button>
               </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="" class="table table-bordered table-striped table-sm ytable">
                 <thead>
                 <tr>
                   <th>Title</th>
                   <th>Start date</th>
                   <th>End date</th>
                   <th>Image</th>
                   <th>Discount</th>
                   <th>Month</th>
                   <th>Year</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Brand  Name</label>
          <input type="text" name="brand_name" value="{{old('brand_name')}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Brand  Logo</label>
          <input type="file" class="dropify" data-height="140" id="input-file-now" name="brand_logo" required="">


          @error('brand_logo')
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>


<script type="text/javascript">
$('.dropify').dropify();
</script>
<script type="text/javascript">
$(function childcategory(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('campaign.index') }}",
			columns:[
				{data:'title',name:'title'},
				{data:'start_date'  ,name:'start_date'},
        {data:'end_date',name:'end_date'},
				{data:'image',name:'image', render:function(data,type,full,meta){
          return "<img src=\"{{asset('files/brand/')}}/"+data+"\" height=\"40\"/>"
        }},
        {data:'discount',name:'discount'},
        {data:'month',name:'month'},
        {data:'year',name:'year'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

</script>

@endsection
