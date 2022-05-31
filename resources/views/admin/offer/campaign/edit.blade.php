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
              <form class="" action="{{route('campaign.update',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="">Campaign Title</label>
                  <input type="text" name="title" value="{{$data->title}}" class="form-control" required>
                </div>
                <div class="">
                  <div class="row">
                    <div class="col-lg-6 ">
                      <div class="form-group">
                        <label for="">Campaign Start date</label>
                        <input class="form-control" type="date" name="start_date" value="{{$data->start_date}}" required>
                      </div>
                    </div>
                    <div class="col-lg-6 form-group">
                    <div class="form-group">
                      <label for="">Campaign End date</label>
                      <input class="form-control" type="date" name="end_date" value="{{$data->end_date}}" required>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Campaign status</label>
                  <select class="form-control" name="status">
                      <option value="0" @if ($data->status==0) selected @endif>Inactive</option>
                    <option value="1" @if ($data->status==1) selected @endif>Active</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="">Campaign Banner</label>
                  <input type="file" class="dropify" data-height="140" id="input-file-now" name="image" >

                  <input type="hidden" name="old_image" value="{{$data->image}}">
                  @error('image')
                  {{$message}}
                  @enderror
                </div>

                <div class="form-group">
                  <label for="">Campaign Discount</label>
                  <input type="text" name="discount" value="{{$data->discount}}" class="form-control" required>
                </div>
                <input type="hidden" name="campaign_id" value="{{$data->id}}">
              </div>
              <div class="modal-footer">

                <button type="submit" class="btn btn-primary">Update</button>
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
