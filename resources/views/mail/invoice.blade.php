<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Order-invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <h1>Successfully Order Placed on Our Ecommerce</h1><br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 m-auto">
          <div class="card">
            <div class="card-header">
              Order Details
              <h6 class="d-inline float-right">Order-status :
                @if($order['status']==0)
                <span class="badge badge-danger">pending</span>
                @elseif($order['status']==1)
                <span class="badge badge-primary">order recieved</span>
                @elseif($order['status']==2)
                 <span class="badge badge-info">order shipped</span>
                @elseif($order['status']==3)
                 <span class="badge badge-success">order completed</span>
                @elseif($order['status']==4)
                 <span class="badge badge-warning">order return</span>
                @elseif($order['status']==5)
                 <span class="badge badge-danger">order cancel</span>
                @endif
              </h6>
            </div>
            <div class="card-body">


                  <strong>Order Details</strong>
                  <div class="row">
                     <div class="col-4">
                      <p>Name : {{ $order['c_name'] }}</p>
                     </div>
                     <div class="col-4">
                      <p>Phone : {{ $order['c_phone'] }}</p>
                     </div>
                     <div class="col-4">
                      <p>Email : {{ $order['c_email'] }}</p>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-4">
                      <p>Country : {{ $order['c_country'] }}</p>
                     </div>
                     <div class="col-4">
                      <p>City : {{ $order['c_city'] }}</p>
                     </div>
                     <div class="col-4">
                      <p>Zipcode : {{ $order['c_zipcode'] }}</p>
                     </div>
                  </div>

                  <div class="row">
          <div class="col-4">
            <p>OrderID : {{ $order['order_id'] }}</p>
           </div>
           <div class="col-4">
            <p>Subtotal : {{ $order['sub_total'] }} {{ $setting->currency }}</p>
           </div>
           <div class="col-4">
            <p>Total : {{ $order['total'] }} {{ $setting->currency }}</p>
           </div>

        </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
