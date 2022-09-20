@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header demo">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('order.index')}}">orders</a></li>
              <li class="breadcrumb-item active">Orders details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 m-auto">
            <div class="card">
              <div class="card-header">

                Order Details


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


                <h6 class="d-inline float-right">Order-status :
                  @if($order->status==0)
                  <span class="badge badge-danger">pending</span>
                  @elseif($order->status==1)
                  <span class="badge badge-primary">order recieved</span>
                  @elseif($order->status==2)
                   <span class="badge badge-info">order shipped</span>
                  @elseif($order->status==3)
                   <span class="badge badge-success">order completed</span>
                  @elseif($order->status==4)
                   <span class="badge badge-warning">order return</span>
                  @elseif($order->status==5)
                   <span class="badge badge-danger">order cancel</span>
                  @endif
                </h6>
              </div>
              <div class="card-body">

                    <input type="hidden" name="id" value="{{$order->id}}">
                    <input type="hidden" name="c_name" class="form-control" value="{{$order->c_name}}">
                    <input type="hidden" name="c_phone" class="form-control" value="{{$order->c_phone}}">
                    <input type="hidden" name="c_address" class="form-control" value="{{$order->c_address}}">

                    <strong>Order Details</strong>
                    <div class="row">
                    	 <div class="col-4">
                    	 	<p>Name : {{ $order->c_name }}</p>
                    	 </div>
                    	 <div class="col-4">
                    	 	<p>Phone : {{ $order->c_phone }}</p>
                    	 </div>
                    	 <div class="col-4">
                    	 	<p>Email : {{ $order->c_email }}</p>
                    	 </div>
                    </div>
                    <div class="row">
                    	 <div class="col-4">
                    	 	<p>Country : {{ $order->c_country }}</p>
                    	 </div>
                    	 <div class="col-4">
                    	 	<p>City : {{ $order->c_city }}</p>
                    	 </div>
                    	 <div class="col-4">
                    	 	<p>Zipcode : {{ $order->c_zipcode }}</p>
                    	 </div>
                    </div>

                    <div class="row">
          	<div class="col-4">
          	 	<p>OrderID : {{ $order->order_id }}</p>
          	 </div>
          	 <div class="col-4">
          	 	<p>Subtotal : {{ $order->sub_total }} {{ $setting->currency }}</p>
          	 </div>
          	 <div class="col-4">
          	 	<p>Total : {{ $order->total }} {{ $setting->currency }}</p>
          	 </div><br>

          	          <div class="col-lg-12 mt-5 mb-5">
                       <table class="table table-bordered">
                         <thead>
                           <tr>
                             <th scope="col">Product</th>
                             <th scope="col">Size</th>
                             <th scope="col">Color</th>
                             <th scope="col">QtyxPrice</th>
                             <th scope="col">Subtotal</th>
                           </tr>
                         </thead>
                         <tbody>
                          @foreach($order_details as $row)
                           <tr>
                             <th scope="row">{{ $row->product_name }}</th>
                             <td>{{ $row->size }}</td>
                             <td>{{ $row->color }} </td>
                             <td>{{ $row->quantity }} x {{ $row->single_price }} {{ $setting->currency }}</td>
                             <td>{{ $row->subtotal }} {{ $setting->currency }}</td>
                           </tr>
                          @endforeach
                         </tbody>
                       </table>
                   </div>

          </div>




                  <div class="form-group">
                    <button type="submit" class="btn btn-success single_order_print"> <span class="d-none loder">...Loding</span> Print</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
    $('.single_order_print').on('click',function(e){
      e.preventDefault();
      $('.loder').removeClass('d-none');
      $.ajax({
        url:"{{ route('single.report.order.print') }}",
        type:'get',
        success:function(){
          $('.loder').addClass('d-none');
          $(".demo").printThis();
        }
      });
    });

    </script>

@endsection
