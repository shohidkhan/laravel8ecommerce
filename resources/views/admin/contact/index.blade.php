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
               <table id="example1" class="table table-bordered table-striped table-sm">
                 <thead>
                 <tr>
                   <th>SL</th>
                   <th>Name</th>
                   <th>Email</th>
                   <th>Phone</th>
                   <th>Message</th>
                   <th>staus</th>
                   <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>
                 @foreach ($contacts   as $key => $contact)

                 <tr>
                   <td>{{$key+1}}</td>
                   <td>{{$contact->f_name}}</td>
                   <td>{{$contact->email}}</td>
                   <td>{{$contact->phone}}</td>
                   <td>{{substr($contact->message,0,20)}}...read more</td>
                   <td>
                     @if($contact->status==1)
                     <div class="badge badge-success">
                       Replied
                     </div>
                     @else
                     <div class="badge badge-danger">
                       new message
                     </div>
                     @endif
                   </td>
                   <td>
                     <a href="{{ route('contact.view',$contact->id) }}"   class="btn btn-info btn-sm edit" id="edit">
                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                     </a>
                     @if ($contact->status==0)
                       <a href="{{ route('contact.send.mail',$contact->email) }}"   class="btn btn-success btn-sm edit" id="edit">

                         <i class="fa fa-envelope"></i>
                       </a>
                     @endif

                     <a href="" id="delete" class="btn btn-danger btn-sm">
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



@endsection
