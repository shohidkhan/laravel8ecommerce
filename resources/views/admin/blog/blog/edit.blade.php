@extends('layouts.admin')
@section('admin_content')
  <style type="text/css">
    .bootstrap-tagsinput .tag {
      background: #428bca;
      border: 1px solid white;
      padding: 1 6px;
      padding-left: 2px;
      margin-right: 2px;
      color: white;
      border-radius: 4px;
    }
  </style>
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
              <li class="breadcrumb-item"><a href="{{route('category.index')}}">Blog</a></li>
              <li class="breadcrumb-item active">Edit Blog</li>
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
          <form class="" action="{{ route('blog.update',$blog->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="">Blog Catrgory</label>
              <input type="hidden" name="blog_id" value="{{ $blog->id }}">
              <select class="form-control" name="blog_category_id">
                <option value="">Category name</option>
                @foreach ($blog_categories as $blog_category)
                  <option value="{{ $blog_category->id }}" @if($blog_category->id==$blog->blog_category_id) selected @endif>{{ $blog_category->category_name }}</option>
                @endforeach
              </select>

              @error('category_name')
              {{$message}}
              @enderror
            </div>
            <div class="form-group">
              <label for="">Blog title</label>
              <input type="text" name="title"class="form-control" value="{{ $blog->title }}">
              @error('title')
              {{$message}}
              @enderror
            </div>
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="exampleInputPassword1">Tag</label><br>
                <input type="text"  class="form-control" value="{{ $blog->tag }}" name="tag" data-role="tagsinput">
                @error('tag')
                {{$message}}
                @enderror
              </div>
              <div class="form-group col-lg-6">
                <label for="exampleInputPassword1">Publish Date</label><br>
                <input type="date"  class="form-control" name="publish_date" value="{{ $blog->publish_date }}">
                @error('publish_date')
                {{$message}}
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="form-group col-lg-12">
                <label for="exampleInputPassword1">Blog  Description</label>
                <textarea class="form-control textarea" name="description">{{ $blog->description }}</textarea>
                @error('description')
                {{$message}}
                @enderror
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span> </label><br>
              <input type="hidden" name="old_img" value="{{ $blog->thumbnail }}">
              <input type="file" name="thumbnail"  accept="image/*" class="dropify">
              @error('thumbnail')
              {{$message}}
              @enderror
            </div>
            {{-- <div class="card p-4">
               <h6>Status</h6>
              <input type="checkbox" name="status" value="{{ $blog->status }}" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div> --}}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <script type="text/javascript">
      $('.dropify').dropify();  //dropify image
      $("input[data-bootstrap-switch]").each(function(){
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@endsection
