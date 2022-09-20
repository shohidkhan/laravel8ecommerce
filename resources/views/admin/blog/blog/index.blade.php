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
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card">
             <div class="card-header">
               <h3 class="card-title">All Products here</h3>
               <div class="">
                 <button data-toggle="modal" data-target="#categoryModal" class="btn btn-primary float-right">+ Add New</button>
               </div>
             </div>


             <!-- /.card-header -->
             <div class="card-body">
               <table id="" class="table table-bordered table-striped table-sm ytable">
                 <thead>
                 <tr>
                   <th>SL</th>
                   <th>Blog Category</th>
                   <th>Title</th>
                   <th>publish_date</th>
                   <th>Thumbnail</th>
                   <th>Status</th>
                   <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>

                 </tbody>

               </table>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
      </div>
    </section>



    <!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="" action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Blog Catrgory</label>

          <select class="form-control" name="blog_category_id">
            <option value="">Category name</option>
            @foreach ($blog_categories as $blog_category)
              <option value="{{ $blog_category->id }}">{{ $blog_category->category_name }}</option>
            @endforeach
          </select>

          @error('category_name')
          {{$message}}
          @enderror
        </div>
        <div class="form-group">
          <label for="">Blog title</label>
          <input type="text" name="title"class="form-control">
          @error('title')
          {{$message}}
          @enderror
        </div>
        <div class="row">
          <div class="form-group col-lg-6">
            <label for="exampleInputPassword1">Tag</label><br>
            <input type="text"  class="form-control" value="{{ old('tag') }}" name="tag" data-role="tagsinput">
            @error('tag')
            {{$message}}
            @enderror
          </div>
          <div class="form-group col-lg-6">
            <label for="exampleInputPassword1">Publish Date</label><br>
            <input type="date"  class="form-control" name="publish_date" >
            @error('publish_date')
            {{$message}}
            @enderror
          </div>
        </div>

        <div class="row">
          <div class="form-group col-lg-12">
            <label for="exampleInputPassword1">Blog  Description</label>
            <textarea class="form-control textarea" name="description">{{ old('description') }}</textarea>
            @error('description')
            {{$message}}
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span> </label><br>
          <input type="file" name="thumbnail" required="" accept="image/*" class="dropify">
          @error('thumbnail')
          {{$message}}
          @enderror
        </div>
        <div class="card p-4">
           <h6>Status</h6>
          <input type="checkbox" name="status" value="1" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript">
$(function childcategory(){
		var table=$('.ytable').DataTable({
    "processing":true,
    "serverSide":true,
    "searching":true,
    "ajax":{
      "url": "{{ route('blog.index') }}",

    },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},

        {data:'category_name',name:'category_name'},
        {data:'title',name:'title'},
				{data:'publish_date',name:'publish_date'},
        {data:'thumbnail'  ,name:'thumbnail', render:function(data,type,full,meta){
          return "<img src=\"{{asset('files/blog/')}}/"+data+"\" height=\"30\" width=\"30\"/>"
        }},
				{data:'status',name:'status'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});



  $('body').on('click','.deactive_status',function(){
    var id=$(this).data('id');
    var url="{{url('blog/deactive_status')}}/"+id;
    $.ajax({
      url:url,
      type:'get',
      success:function(data){
        toastr.success(data);
        table.ajax.reload();
      }
    });
  });


  $('body').on('click','.active_status',function(){
    var id=$(this).data('id');
    var url="{{url('blog/active_status')}}/"+id;
    $.ajax({
      url:url,
      type:'get',
      success:function(data){
        toastr.success(data);
        table.ajax.reload();
      }
    });
  });

  $(document).on('change','.submitable', function(){
  $('.ytable').DataTable().ajax.reload();
});

$('.dropify').dropify();  //dropify image
$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });

</script>
@endsection
