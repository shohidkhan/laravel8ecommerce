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
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('page.index')}}">Pages</a></li>
              <li class="breadcrumb-item active">create page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 m-auto">
            <div class="card">
                 <div class="card-header bg-primary">Create A New Page</div>
                 <div class="card-body">
                   <form class="" action="{{route('page.store')}}" method="post">
                     @csrf
                     <div class="form-group">
                       <label for="">Page Position</label>
                       <select  class="form-control" name="page_position">
                         <option value="1">Line One</option>
                         <option value="2">Line Two</option>
                       </select>
                     </div>
                     <div class="form-group">
                       <label for="">Page Name</label>
                       <input type="text" class="form-control" name="page_name" placeholder="Page Name">
                     </div>
                     <div class="form-group">
                       <label for="">Page Title</label>
                       <input type="text" class="form-control" name="page_title" placeholder="Page Title">
                     </div>
                     <div class="form-group">
                       <label for="">Page Description</label>
                       <textarea name="description" class="form-control textarea" rows="8" cols="80"></textarea>
                     </div>
                     <button class="btn btn-primary
                     " type="submit" >Submit</button>
                   </form>
                 </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection
