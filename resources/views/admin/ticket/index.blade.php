@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tickets</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">ticket</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
             <div class="card-header">
               <h3 class="card-title">All ticket here</h3>

             </div>
             <div class="row p-2">
              	<div class="form-group col-3">
              		<label>Ticket Type</label>
              		 <select class="form-control submitable" name="type" id="type">
              		 	<option value="">All</option>
                    <option value="Technical">Technical</option>
                    <option value="Payment">Payment</option>
                    <option value="Affiliate">Affiliate</option>
                    <option value="Return">Return</option>
                    <option value="Refund">Refund</option>

              		 </select>
              	</div>

              	<div class="form-group col-3">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="all">All</option>
              		 	    <option value="0">Pending</option>
  											<option value="1">Replied</option>
  											<option value="2">Closed</option>
              		 </select>
              	</div>
              	<div class="form-group col-3">
              		<label>Date</label>

              		<input type="date" name="date" id="date" class="form-control submitable_input">
              	</div>
              </div>


             <!-- /.card-header -->
             <div class="card-body">
               <table id="" class="table table-bordered table-striped table-sm ytable">
                 <thead>
                 <tr>
                   <th>SL</th>
                   <th>user</th>
                   <th>Subject</th>
                   <th>Service</th>
                   <th>Priority</th>
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
      "url": "{{ route('ticket.index') }}",
      "data":function(e) {
        e.type =$("#type").val();
        e.date =$("#date").val();
        e.status =$("#status").val();
      }
    },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'name',name:'name'},
        {data:'subject',name:'subject'},
				{data:'service',name:'service'},
				{data:'priority',name:'priority'},
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
  $(document).on('change','.submitable_input', function(){
    $('.ytable').DataTable().ajax.reload();
  });



</script>
@endsection
