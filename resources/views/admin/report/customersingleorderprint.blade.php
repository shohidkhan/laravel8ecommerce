<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Order-invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Customer Order Details</h1>
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
                  Customer  Order Details
                  
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





                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
