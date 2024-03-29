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
            <h1>New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{route('product.update',$data->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="proudct_id" value="{{ $data->id }}">
       	<div class="row">
          <!-- left column -->
          <div class="col-lg-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Product Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" value="{{ $data->name }}"  required="">
                      @error('name')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Product Code <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" value="{{ $data->code }}" name="code" required="">
                      @error('code')
                      {{$message}}
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Category/Subcategory <span class="text-danger">*</span> </label>
                      <select class="form-control" name="subcategory_id" id="subcategory_id">
                        <option disabled="" selected="">==choose category==</option>
                        @foreach($category as $row)
                            @php
                               $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
                            @endphp
                            <option style="color:blue;" disabled="">{{ $row->category_name }}</option>
                               @foreach($subcategory as $row)
                                 <option value="{{ $row->id }}" @if($row->id==$data->subcategory_id) selected @endif> -- {{ $row->subcategory_name }}</option>
                               @endforeach
                         @endforeach


                      </select>
                      @error('subcategory_id')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Child category<span class="text-danger">*</span> </label>
                      <select class="form-control" name="childcategory_id" id="childcategory_id">
                        @foreach ($childcategory as $row)
                          <option value="{{ $row->id }}" @if($row->id==$data->childcategory_id) selected @endif>{{ $row->childcategory_name }}</option>
                        @endforeach
                      </select>
                      @error('childcategory_id')
                      {{$message}}
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Brand <span class="text-danger">*</span> </label>
                      <select class="form-control" name="brand_id">
                        @foreach($brand as $row)
                        <option value="{{$row->id}}">{{$row->brand_name}}</option>
                        @endforeach
                      </select>
                      @error('brand_id')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Pickup Point</label>
                      <select class="form-control" name="pickup_point_id">
                        @foreach($pickuppoint as $row)
                        <option value="{{$row->id}}">{{$row->pickup_point_name}}</option>
                        @endforeach
                      </select>
                      @error('pickup_point_id')
                      {{$message}}
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Unit <span class="text-danger">*</span> </label>
                      <input type="text" class=form-control name="unit" value="{{ $data->unit}}" required="">
                      @error('unit')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Tags</label><br>
                      <input type="text"  class="form-control" value="{{$data->tags }}" name="tags" data-role="tagsinput">
                      @error('tags')
                      {{$message}}
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Purchase Price  </label>
                      <input type="text" class="form-control" value="{{ $data->purchase_price }}" name="purchase_price">
                      @error('purchase_price')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Selling Price <span class="text-danger">*</span> </label>
                      <input type="text" name="selling_price" value="{{ $data->selling_price }}" class="form-control" required="">
                      @error('selling_price')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Discount Price </label>
                      <input type="text" name="discount_price" value="{{ $data->discount_price }}" class="form-control">
                      @error('discount_price')
                      {{$message}}
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Warehouse <span class="text-danger">*</span> </label>
                      <select class="form-control" name="warehouse_id">
                        <option value="" disabled selected>=== Choose Warehouse ===</option>
                        @foreach($warehouse as $row)
                        <option value="{{$row->id}}" @if($row->id == $data->warehouse_id) selected @endif>{{$row->warehouse_name}}</option>
                        @endforeach
                      </select>
                      @error('warehouse_id')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Stock</label>
                      <input type="text" name="stock_quantity" value="{{ $data->stock_quantity }}" class="form-control">
                      @error('stock_quantity')
                      {{$message}}
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Color</label><br>
                      <input type="text" class="form-control" value="{{ $data->color}}" data-role="tagsinput" name="color" />
                      @error('color')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Size</label><br>
                      <input type="text" class="form-control" value="{{ $data->size }}" data-role="tagsinput" name="size"  />
                      @error('size')
                      {{$message}}
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Product Details</label>
                      <textarea class="form-control textarea" name="description">{{ $data->description }}</textarea>
                      @error('description')
                      {{$message}}
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Video Embed Code</label>
                      <input class="form-control" name="video" value="{{ $data->video }}" placeholder="Only code after embed word">
                      @error('video')
                      {{$message}}
                      @enderror
                      <small class="text-danger">Only code after embed word</small>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
            <!-- /.card -->
          <!-- right column -->
          <div class="col-lg-4">
            <!-- Form Element sizes -->
            <div class="card card-primary">
              <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span> </label><br>
                    <input type="file" name="thumbnail"  accept="image/*" class="dropify">
                    <input type="hidden" name="old_thumbnail" value="{{ $data->thumbnail }}">
                    @error('thumbnail')
                    {{$message}}
                    @enderror
                  </div><br>
                  <div class="">
                    <table class="table table-bordered" id="dynamic_field">
                    <div class="card-header">
                      <h3 class="card-title">More Images (Click Add For More Image)</h3>
                    </div>
                      <tr>
                          <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>
                          <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
                      </tr>
                      @php
                        $images=json_decode($data->images,true);
                      @endphp
                      @if(!$images)
                      @else
                        <div class="row">
                          @foreach ($images as $key => $img)
                            <div class="col-md-4">
                              <img src="{{ asset('files/product/') }}/{{ $img }}" style="width:100px;height:80px; padding:10px;" alt="">
                              <input type="hidden" name="old_images[]" value="{{ $img }}">
                              <button type="button" class="remove-files">X</button>
                            </div>
                          @endforeach
                        </div>
                      @endif

                    </table>
                    @error('images')
                    {{$message}}
                    @enderror
                  </div>
                     <div class="card p-4">
                        <h6>Featured Product</h6>
                       <input type="checkbox" name="featured" value="1" @if($data->featured==1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                       @error('featured')
                       {{$message}}
                       @enderror
                     </div>

                     <div class="card p-4">
                        <h6>Today Deal</h6>
                       <input type="checkbox"  name="today_deal" value="1" @if($data->featured==1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                       @error('today_deal')
                       {{$message}}
                       @enderror
                     </div>

                     <div class="card p-4">
                        <h6>Slider Product</h6>
                       <input type="checkbox" name="product_slider" @if($data->featured==1) checked @endif value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

                     <!-- <div class="card p-4">
                        <h6>Trendy Product</h6>
                       <input type="checkbox" name="trendy" value="1"  data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div> -->

                     <div class="card p-4">
                        <h6>Status</h6>
                       <input type="checkbox" name="status" value="1" @if($data->featured==1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                     </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
           <button class="btn btn-info ml-2" type="submit">Submit</button>
         </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

<script type="text/javascript">


//ajax request send for collect childcategory
$("#subcategory_id").change(function(){
 var id = $(this).val();
 $.ajax({
      url: "{{ url("/get-child-category/") }}/"+id,
      type: 'get',
      success: function(data) {
           $('select[name="childcategory_id"]').empty();
              $.each(data, function(key,data){
                 $('select[name="childcategory_id"]').append('<option value="'+ data.id +'">'+ data.childcategory_name +'</option>');
           });
      }
   });
});

  $('.dropify').dropify();  //dropify image
  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });






    $(document).ready(function(){
       var postURL = "<?php echo url('addmore'); ?>";
       var i=1;


       $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
       });

       $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
       });
     });

     $('.remove-files').on('click',function(){
       $(this).parents('.col-md-4').remove();
     });

</script>
@endsection
