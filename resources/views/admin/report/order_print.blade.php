<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Order-invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <div class="" style="width:50%;margin:10px auto;">
      <img src="{{ $setting->logo }}" alt=""> <h1 style="display:inline;">Lh-Ecommerce</h1>
    </div>
    <h1>All orders Report</h1><br>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 m-auto">
          <div class="card">
            <div class="card-header">
              All Orders Details

            </div>
            <div class="card-body">
              <table id="" class="table table-bordered table-striped">
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
                </tr>
                </thead>
                <tbody>
                  @foreach ($order as $key => $row)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ $row->c_name }}</td>
                      <td>{{ $row->c_phone }}</td>
                      <td>{{ $row->c_email }}</td>
                      <td>{{ $row->sub_total }}</td>
                      <td>{{ $row->total }}</td>
                      <td>{{ $row->payment_type }}</td>
                      <td>
                        @if($row->status==0)
                        <span class="badge badge-danger">pending</span>
                      @elseif($row->status==1)
                        <span class="badge badge-primary">order recieved</span>
                      @elseif($row->status==2)
                         <span class="badge badge-info">order shipped</span>
                       @elseif($row->status==3)
                         <span class="badge badge-success">order completed</span>
                       @elseif($row->status==4)
                         <span class="badge badge-warning">order return</span>
                       @elseif($row->status==5)
                         <span class="badge badge-danger">order cancel</span>
                        @endif
                      </td>
                      <td>
                        {{ $row->date }}
                      </td>
                    </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
