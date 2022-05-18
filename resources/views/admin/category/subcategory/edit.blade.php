@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('subcategory.index')}}">Subcategory</a></li>
              <li class="breadcrumb-item active">Edit subcategory</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<div class="container">
  <div class=row>
    <div class="col-lg-6 m-auto">
      <div class="card">
        <div class="card-header">
          Edit Subcategory
        </div>
        <div class="card-body">
          <form class="" action="{{route('subcategory.update')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="">catrgory Name</label>

              <select class="form-control" name="category_id">
                @foreach($category as $row)
                <option value="{{$row->id}}" @if($row->id == $data->category_id) selected="" @endif>
                  {{$row->category_name}}
                </option>
                @endforeach
              </select>
              @error('category_name')
              {{$message}}
              @enderror
            </div>
            <div class="form-group">
              <label for="">Subcatrgory Name</label>
              <input type="hidden" name="id" value="{{$data->id}}">
              <input type="text" class="form-control" value="{{$data->subcategory_name}}" name="subcategory_name" required>
              @error('subcategory_name')
              {{$message}}
              @enderror
            </div>

          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-info">Update</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- Modal -->
@endsection
