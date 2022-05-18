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
              <li class="breadcrumb-item"><a href="{{route('childcategory.index')}}">Childcategory</a></li>
              <li class="breadcrumb-item active">Edit Childcategory</li>
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
          <form class="" action="{{route('childcategory.update')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="">Category/Subcategory</label>
              <select class="form-control" name="subcategory_id">
                @foreach($categories  as $category)
                @php

                $subcategories=App\Models\Subcategory::where('category_id',$category->id)->get();
                @endphp
                <option  disabled style="color:blue" value="{{$category->id}}">{{$category->category_name}}</option>
                @foreach($subcategories as $subcategory)
                <option @if  ($subcategory->id==$childcategories->subcategory_id) selected @endif  value="{{$subcategory->id}}">---{{$subcategory->subcategory_name}}</option>
                @endforeach
                @endforeach
              </select>
              @error('category_id')
              {{$message}}
              @enderror
            </div>
            <div class="form-group">
              <label for="">Child-catrgory Name</label>
              <input type="hidden" name="childcategory_id" value="{{$childcategories->id}}">
              <input type="text" class="form-control"  name="childcategory_name" value="{{$childcategories->childcategory_name}}" required>
              @error('childcategory_name')
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
