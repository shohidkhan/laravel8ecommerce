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
                   <th>
                     Status
                   </th>
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
<div class="modal fade model-lg" id="childcategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Campaign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="" action="{{route('campaign.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Campaign Title</label>
          <input type="text" name="title" value="{{old('title')}}" class="form-control" required>
        </div>
        <div class="">
          <div class="row">
            <div class="col-lg-6 ">
              <div class="form-group">
                <label for="">Campaign Start date</label>
                <input class="form-control" type="date" name="start_date" value="{{old('title')}}" required>
              </div>
            </div>
            <div class="col-lg-6 form-group">
            <div class="form-group">
              <label for="">Campaign End date</label>
              <input class="form-control" type="date" name="end_date" value="{{old('end_date')}}" required>
            </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="">Campaign status</label>
          <select class="form-control" name="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Campaign Banner</label>
          <input type="file" class="dropify" data-height="140" id="input-file-now" name="image" required="">


          @error('image')
          {{$message}}
          @enderror
        </div>

        <div class="form-group">
          <label for="">Campaign Discount</label>
          <input type="text" name="discount" value="{{old('discount')}}" class="form-control" required>
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
        {data:'status',name:'status'},
				{data:'image',name:'image', render:function(data,type,full,meta){
          return "<img src=\"{{asset('files/campaign/')}}/"+data+"\" height=\"40\"/>"
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
