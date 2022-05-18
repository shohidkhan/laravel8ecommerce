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
                <h3 class="card-title">Edit password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
              <form action="{{route('admin.password.update')}}" method="post">
                @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Old password</label>
                    <input type="password" name="old_password" class="form-control" id="exampleInputEmail1" placeholder="Enter Old Password" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Enter New Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="New Password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation" placeholder="Enter Confirm Password" required>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update  Password</button>
                </div>
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
