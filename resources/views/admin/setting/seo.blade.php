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
                <h3 class="card-title">Seo Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <form action="{{route('seo.update',$data->id)}}" method="post">
                @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Title</label>
                    <input type="text" name="id" value="{{$data->id}}">
                    <input type="text" name="meta_title" value="{{$data->meta_title}}" class="form-control" id="exampleInputEmail1" placeholder="Meta Title" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Author</label>
                    <input type="text" name="meta_author" value="{{$data->meta_author}}" class="form-control" id="exampleInputEmail1" placeholder="Meta Author" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Tag</label>
                    <input type="text" name="meta_tag" value="{{$data->meta_tag}}" class="form-control" id="exampleInputEmail1" placeholder="Meta Tag" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Meta Description</label>
                    <textarea name="meta_description"  class="form-control" rows="8" cols="80" name="meta_description">{{$data->meta_description}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Google Verification</label>
                    <input type="text" name="google_verification" value="{{$data->google_verification}}" class="form-control" id="exampleInputEmail1" placeholder="Google Verification" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Google Analytics</label>
                    <input type="text" name="google_analytics" value="{{$data->google_analytics}}" class="form-control" id="exampleInputEmail1" placeholder="Google Analytics" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alexa  Verification</label>
                    <input type="text" name="alexa_verification" value="{{$data->alexa_verification}}" class="form-control" id="exampleInputEmail1" placeholder="Alexa  Verification" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Google Adsense</label>
                    <input type="text" name="google_adsenses" value="{{$data->google_adsenses}}" class="form-control" id="exampleInputEmail1" placeholder="Google Adsense" >
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
