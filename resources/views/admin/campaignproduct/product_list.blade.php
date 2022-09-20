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
               <h3 class="card-title">Campaign : {{ $campaign->title }}</h3>
               <div class="">
                 <a class="btn btn-success float-right" href="{{ route('campaign.products',$campaign->id) }}">Back</a>
               </div>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-bordered table-striped table-sm">
                 <thead>
                 <tr>
                   <th>SL</th>
                   <th>Image</th>
                   <th>Name</th>
                   <th>Code</th>
                   <th>Price</th>
                   <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>
                 @foreach ($campaign_products   as $key => $product)

                 <tr>
                   <td>{{$key+1}}</td>
                   <td>
                     <img src="{{ asset('files/product/') }}/{{ $product->thumbnail }}" style="width:30px;" alt="">
                   </td>
                   <td>{{$product->name}}</td>
                   <td>{{$product->code}}</td>
                   <td>{{$product->price}}</td>
                   <td>

                     <a href="{{ route('campaign.product.delete',$product->id) }}"   class="btn btn-info btn-sm edit" id="edit">
                       <i class="fa fa-trash" aria-hidden="true"></i>
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
