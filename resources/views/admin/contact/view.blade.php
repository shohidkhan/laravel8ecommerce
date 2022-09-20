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
               <h3 class="card-title">All message here</h3>

             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table  class="table table-bordered table-striped table-sm">
                 <thead>
                 <tr>
                   <th>Name</th>
                   <td>{{ $single_contact->f_name }}</td>
                 </tr>
                 <tr>
                   <th>Email</th>
                   <td>{{ $single_contact->email }}</td>
                 </tr>
                 <tr>
                   <th>Phone</th>
                   <td>{{ $single_contact->phone }}</td>
                 </tr>
                 <tr>
                   <th>Message</th>
                   <td>{{ $single_contact->message }}</td>
                 </tr>
                 <tr>
                   <th>Status</th>
                   <td>
                     @if($single_contact->status==1)
                     <div class="badge badge-success">
                       Replied
                     </div>
                     @else
                     <div class="badge badge-danger">
                       new message
                     </div>
                     @endif
                   </td>
                 </tr>
                 </thead>


               </table>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
      </div>
    </section>



@endsection
