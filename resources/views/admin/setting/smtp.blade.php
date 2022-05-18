@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 m-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Smtp Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <form action="{{route('smtp.update',$data->id)}}" method="post">
                @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mail Mailer</label>
                    <input type="text" name="mailer" value="{{$data->mailer}}" class="form-control" id="exampleInputEmail1" placeholder="Mail Mailer" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mail Host</label>
                    <input type="text" name="host" value="{{$data->host}}" class="form-control" id="exampleInputEmail1" placeholder="Mail Host" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mail Port</label>
                    <input type="text" name="port" value="{{$data->port}}" class="form-control" id="exampleInputEmail1" placeholder="Mail Port" >
                    <small>Example:2525</small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mail Username</label>
                    <input type="text" name="username" value="{{$data->username}}" class="form-control" id="exampleInputEmail1" placeholder="Mail Username" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mail  password</label>
                    <input type="text" name="password" value="{{$data->password}}" class="form-control" id="exampleInputEmail1" placeholder="Mail password" >
                  </div>

                  <button type="submit" class="btn btn-primary">Update</button>
              </form>
              </div>

            </div>
            <!-- /.card -->

          </div>
        </div>
      </div>
    </section>
</div>
@endsection
