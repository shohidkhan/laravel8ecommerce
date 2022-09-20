@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blog Category Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
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
          Edit Category
        </div>
        <div class="card-body">
          <form class="" action="{{ route('blog.category.update',$data->id) }}" method="post">
            @csrf
            <div class="form-group">
              <label for="">Catrgory Name</label>
              <input type="hidden" name="id" value="{{$data->id}}">
              <input type="text" class="form-control" value="{{$data->category_name}}" name="category_name" required>
              @error('category_name')
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
