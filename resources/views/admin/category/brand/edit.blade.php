@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">

        <div class="col-lg-6 m-auto">
          <div class="card">
            <div class="card-header">
              Edit Brand
            </div>
            <div class="card-body">
              <form class="" action="{{route('brand.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="brand_id" value="{{$data->id}}">
                <div class="form-group">
                  <label for="">Brand  Name</label>
                  <input type="text" name="brand_name" value="{{$data->brand_name}}" class="form-control">
                </div>
                <div class="form-group">
                  <label for="">Brand  Logo</label>
                  <input type="file" class="dropify" data-height="140" id="input-file-now" name="brand_logo" >
                  <input type="hidden" name="old_logo" value="{{$data->brand_logo}}">
                  @error('brand_logo')
                  {{$message}}
                  @enderror
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">update</button>
              </div>
              </form>
            </div>

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
