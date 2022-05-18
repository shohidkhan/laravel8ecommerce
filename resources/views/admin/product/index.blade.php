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
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
             <div class="card-header">
               <h3 class="card-title">All Products here</h3>
               <div class="">
                 <a href="{{route('product.index')}}" class="btn btn-primary float-right">+ Add New</a>
               </div>
             </div>
             <div class="row p-2">
              	<div class="form-group col-3">
              		<label>Category</label>
              		 <select class="form-control submitable" name="category_id" id="category_id">
              		 	<option value="">All</option>
              		 	  @foreach($category as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->category_name }}</option>
              		 	  @endforeach
              		 </select>
              	</div>
              	<div class="form-group col-3">
              		<label>Brand</label>
              		 <select class="form-control submitable" name="brand_id" id="brand_id">
              		 	<option value="">All</option>
              		 	  @foreach($brand as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
              		 	  @endforeach
              		 </select>
              	</div>
              	<div class="form-group col-3">
              		<label>warehouses</label>
              		 <select class="form-control submitable" name="warehouse_id" id="warehouse_id">
              		 	<option value="">All</option>
              		 	  @foreach($warehouse as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
              		 	  @endforeach
              		 </select>
              	</div>
              	<div class="form-group col-3">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="1">All</option>
              		 	    <option value="1">Active</option>
  											<option value="0">Inactive</option>
              		 </select>
              	</div>
              </div>


             <!-- /.card-header -->
             <div class="card-body">
               <table id="" class="table table-bordered table-striped table-sm ytable">
                 <thead>
                 <tr>
                   <th>SL</th>
                   <th>Thumbnail</th>
                   <th>Product Name</th>
                   <th>Code</th>
                   <th>category</th>
                   <th>subcategory</th>
                   <th>Brand</th>
                   <th>Featured</th>
                   <th>Today Deal</th>
                   <th>Status</th>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$(function childcategory(){
		var table=$('.ytable').DataTable({
    "processing":true,
    "serverSide":true,
    "searching":true,
    "ajax":{
      "url": "{{ route('product.index') }}",
      "data":function(e) {
        e.category_id =$("#category_id").val();
        e.brand_id =$("#brand_id").val();
        e.status =$("#status").val();
        e.warehouse_id =$("#warehouse_id").val();
      }
    },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'thumbnail'  ,name:'thumbnail', render:function(data,type,full,meta){
          return "<img src=\"{{asset('files/product/')}}/"+data+"\" height=\"30\" width=\"30\"/>"
        }},
        {data:'name',name:'name'},
        {data:'code',name:'code'},
				{data:'category_name',name:'category_name'},
				{data:'subcategory_name',name:'subcategory_name'},
				{data:'brand_name',name:'brand_name'},
				{data:'featured',name:'featured'},
				{data:'today_deal',name:'today_deal'},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

  $('body').on('click','.deactive_featured',function(){
    var id=$(this).data('id');
    var url="{{url('product/deactive_featured')}}/"+id;
    $.ajax({
      url:url,
      type:'get',
      success:function(data){
        toastr.success(data);
        table.ajax.reload();
      }
    });
  });
  $('body').on('click','.active_featured',function(){
    var id=$(this).data('id');
    var url="{{url('product/active_featured')}}/"+id;
    $.ajax({
      url:url,
      type:'get',
      success:function(data){
        toastr.success(data);
        table.ajax.reload();
      }
    });
  });
  $('body').on('click','.deactive_today_deal',function(){
    var id=$(this).data('id');
    var url="{{url('product/deactive_today_deal')}}/"+id;
    $.ajax({
      url:url,
      type:'get',
      success:function(data){
        toastr.success(data);
        table.ajax.reload();
      }
    });
  });
  $('body').on('click','.active_today_deal',function(){
    var id=$(this).data('id');
    var url="{{url('product/active_today_deal')}}/"+id;
    $.ajax({
      url:url,
      type:'get',
      success:function(data){
        toastr.success(data);
        table.ajax.reload();
      }
    });
  });
  $('body').on('click','.deactive_status',function(){
    var id=$(this).data('id');
    var url="{{url('product/deactive_status')}}/"+id;
    $.ajax({
      url:url,
      type:'get',
      success:function(data){
        toastr.success(data);
        table.ajax.reload();
      }
    });
  });
  $('body').on('click','.active_status',function(){
    var id=$(this).data('id');
    var url="{{url('product/active_status')}}/"+id;
    $.ajax({
      url:url,
      type:'get',
      success:function(data){
        toastr.success(data);
        table.ajax.reload();
      }
    });
  });

  $(document).on('change','.submitable', function(){
  $('.ytable').DataTable().ajax.reload();
});



</script>
@endsection
