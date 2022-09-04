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
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
             <div class="card-header">
               <h3 class="card-title">All order here</h3>
             </div>
             <div class="row p-2">
              	<div class="form-group col-3">
              		<label>Status</label>
              		 <select class="form-control submitable" name="status" id="status">
              		 	<option value="">All</option>
              		 	    <option value="0">Pending</option>
  											<option value="1">Recieve</option>
  											<option value="2">Shipped</option>
  											<option value="3">Completed</option>
  											<option value="4">Return</option>
  											<option value="5">Cancel</option>
              		 </select>
              	</div>
              	<div class="form-group col-3">
              		<label>Date</label>
              		 <input type="date" name="date" class="form-control submitable_input" id="date">
              	</div>
              	<div class="form-group col-3">
              		<label>Payment</label>
                  <select class="form-control submitable_input" name="payment_type" id="payment_type">
                  <option value="">All</option>
                      <option value="Hand Cash">Hand Cash</option>
                      <option value="Aamarpay">Aamarpay</option>
                      <option value="Paypal">Paypal</option>
                 </select>
              </div>
              	</div>
              </div>


             <!-- /.card-header -->
             <div class="card-body">
               <table id="" class="table table-bordered table-striped table-sm ytable">
                 <thead>
                 <tr>
                   <th>SL</th>
                   <th>Name</th>
                   <th>Phone</th>
                   <th>Email</th>
                   <th>Subtotal</th>
                   <th>Total</th>
                   <th>Payment Type</th>
                   <th>Status</th>
                   <th>Date</th>

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
      "url": "{{ route('order.index') }}",
      "data":function(e) {
        e.status =$("#status").val();
        e.date =$("#date").val();
        e.payment_type =$("#payment_type").val();
      }
    },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
        {data:'c_name',name:'c_name'},
        {data:'c_phone',name:'c_phone'},
				{data:'c_email',name:'c_email'},
				{data:'sub_total',name:'sub_total'},
				{data:'total',name:'total'},
				{data:'payment_type',name:'payment_type'},
				{data:'status',name:'status'},
				{data:'date',name:'date'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
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

  //Datatables
  $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });
  $(document).on('change','.submitable_input', function(){
    $('.ytable').DataTable().ajax.reload();
  });



</script>
@endsection
