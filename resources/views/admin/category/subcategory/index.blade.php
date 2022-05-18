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
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
             <div class="card-header">
               <h3 class="card-title">All Categories here</h3>
               <div class="">
                 <button data-toggle="modal" data-target="#subcategoryModal" class="btn btn-primary float-right">+ Add New</button>
               </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-bordered table-striped table-sm">
                 <thead>
                 <tr>
                   <th>SL</th>
                   <th>Subcategory Name</th>
                   <th>Subcategory Slug</th>
                   <th>Category Name</th>
                   <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>
                   @foreach($data as $key => $subcategory)
                 <tr>
                   <td>{{$key+1}}</td>
                   <td>{{$subcategory->subcategory_name}}</td>
                   <td>{{$subcategory->subcategory_slug}}</td>
                   <td>{{$subcategory->category_name}}</td>
                   <td>
                     <a href="{{route('subcategory.edit',$subcategory->id)}}"   class="btn btn-info btn-sm edit" id="edit">
                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                     </a>
                     <a href="{{route('subcategory.delete',$subcategory->id)}}" id="delete" class="btn btn-danger btn-sm">
                       <i class="fa fa-trash-o" aria-hidden="true"></i>
                     </a>
                   </td>
                 </tr>
                 @endforeach
                 </tbody>

               </table>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
      </div>
    </section>

    <!-- Modal -->
<div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="" action="{{route('subcategory.store')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="">Catrgory Name</label>
          <select class="form-control" name="category_id">
            @foreach($category as $row)
            <option value="{{$row->id}}">{{$row->category_name}}</option>
            @endforeach
          </select>
          @error('category_id')
          {{$message}}
          @enderror
        </div>
        <div class="form-group">
          <label for="">Subcatrgory Name</label>
          <input type="text" class="form-control"  name="subcategory_name" required>
          @error('subcategory_name')
          {{$message}}
          @enderror
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
