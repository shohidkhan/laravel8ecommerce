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
              <li class="breadcrumb-item active">Pages</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
             <div class="card-header">
               <h3 class="card-title">All Page List here</h3>
               <div class="">
                 <a href="{{route('page.create')}}" class="btn btn-primary float-right">+ Add New</a>
               </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-bordered table-striped table-sm">
                 <thead>
                 <tr>
                   <th>SL</th>
                   <th>Page Position</th>
                   <th>Page Name</th>
                   <th>Page slug</th>
                   <th>Page Title</th>
                   <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>
                 @foreach ($data   as $key => $row)

                 <tr>
                   <td>{{$key+1}}</td>
                   <td>{{$row->page_position}}</td>
                   <td>{{$row->page_name}}</td>
                   <td>{{$row->page_slug}}</td>
                   <td>{{$row->page_title}}</td>
                   <td>
                     <a href="{{route('page.edit',$row->id)}}"   class="btn btn-info btn-sm edit" id="edit">
                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                     </a>
                     <a href="{{route('page.delete',$row->id)}}" id="delete" class="btn btn-danger btn-sm">
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
  </div>
</div>

@endsection
