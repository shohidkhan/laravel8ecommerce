@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 m-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Website Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <form action="{{route('website.update', $data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Currency</label>
                    <select class="form-control" name="currency">
                      <option value="৳" {{($data->currency == '৳')? 'selected':''}}> Taka (৳)</option>
                      <option value="$" {{($data->currency == '$')? 'selected':''}}> USD ($)</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone One</label>
                    <input type="text" name="phone_one" value="{{$data->phone_one}}" class="form-control" id="exampleInputEmail1" placeholder="Phone One" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone Two</label>
                    <input type="text" name="phone_two" value="{{$data->phone_two}}" class="form-control" id="exampleInputEmail1" placeholder="Phone Two" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Main Email</label>
                    <input type="email" name="main_email" value="{{$data->main_email}}" class="form-control" id="exampleInputEmail1" placeholder="Main Email" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Support Email</label>
                    <input type="email" name="support_email" value="{{$data->support_email}}" class="form-control" id="exampleInputEmail1" placeholder="Support Email" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="address" value="{{$data->address}}" class="form-control" id="exampleInputEmail1" placeholder="Address" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Logo</label>
                    <input type="file"  data-height="140" id="input-file-now" name="logo" class="form-control dropify" id="exampleInputEmail1" placeholder="Logo" >
                    <input type="hidden" name="old_logo" value="{{$data->logo}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Favicon</label>
                    <input type="file"   data-height="140" id="input-file-now" name="favicon" class="form-control dropify" id="exampleInputEmail1" placeholder="Favicon" >
                    <input type="hidden" name="old_favicon" value="{{$data->favicon}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Facebook</label>
                    <input type="text" name="facebook" value="{{$data->facebook}}" class="form-control" id="exampleInputEmail1" placeholder="Facebook" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Twitter</label>
                    <input type="text" name="twitter" value="{{$data->twitter}}" class="form-control" id="exampleInputEmail1" placeholder="Twitter" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Instagram</label>
                    <input type="text" name="instagram" value="{{$data->instagram}}" class="form-control" id="exampleInputEmail1" placeholder="Instagram" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Linkedin</label>
                    <input type="text" name="linkedin" value="{{$data->linkedin}}" class="form-control" id="exampleInputEmail1" placeholder="Linkedin" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Youtube</label>
                    <input type="text" name="youtube" value="{{$data->youtube}}" class="form-control" id="exampleInputEmail1" placeholder="Youtube" required>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script type="text/javascript">
$('.dropify').dropify();
</script>
@endsection
