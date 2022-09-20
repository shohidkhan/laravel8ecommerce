<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Str;
use Image;
use DataTables;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use File;
class ProductController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function create()
  {
    $category=DB::table('categories')->get();
    $brand=DB::table('brands')->get();
    $pickuppoint=DB::table('pickuppoints')->get();
    $warehouse=DB::table('Warehouses')->get();
    return view('admin.product.create',compact('category','brand','pickuppoint','warehouse'));
  }
  //index method
  public function index(Request $request)
  {
    if($request->ajax()){
      $product="";
      $query=DB::table('products')
      ->leftJoin('categories','products.category_id','categories.id')
      ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
      ->leftJoin('brands','products.brand_id','brands.id');
      if($request->category_id){
        $query->where('products.category_id',$request->category_id);
      }
      if($request->warehouse_id){
        $query->where('products.warehouse_id',$request->warehouse_id);
      }
      if($request->brand_id)
      {
        $query->where('products.brand_id',$request->brand_id);
      }
      if($request->status==0){
        $query->where('products.status',0);
      }
      if($request->status==1){
        $query->where('products.status',1);
      }
    $product=$query->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
      ->get();
      return DataTables::of($product)
             ->addIndexColumn()
             ->editColumn('featured',function($row){
               if($row->featured==1){
                 return '<a href="" data-id="'.$row->id.'" class="deactive_featured"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span></a>';
               }
               else {
                 return '<a href="" data-id="'.$row->id.'" class="active_featured"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span></a>';
               }
             })
             ->editColumn('status',function($row){
               if($row->status==1){
                 return '<a href="" data-id="'.$row->id.'" class="deactive_status"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span></a>';
               }
               else {
                 return '<a href="" data-id="'.$row->id.'" class="active_status"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span></a>';
               }
             })
             ->editColumn('today_deal',function($row){
               if($row->today_deal==1){
                 return '<a href="" data-id="'.$row->id.'" class="deactive_today_deal"><i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success">active</span></a>';
               }
               else {
                 return '<a href="" data-id="'.$row->id.'" class="active_today_deal"><i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger">deactive</span></a>';
               }
             })
             ->addColumn('action', function($row){
               $actionbtn='
               <a href="'.Route('product.edit',[$row->id]).'"   class="btn btn-info btn-sm edit">
                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
               </a>
               <a href=""   class="btn btn-primary btn-sm edit" id="edit">
                 <i class="fa fa-eye" aria-hidden="true"></i>
               </a>
               <a href="'.Route('product.delete',[$row->id]).'" id="delete" class="btn btn-danger btn-sm">
                 <i class="fa fa-trash-o" aria-hidden="true"></i>
               </a>
               ';
               return $actionbtn;
             })
             ->rawColumns(['action','category_name','subcategory_name','brand_name','featured','today_deal','status'])
             ->make(true);
    }
    $category=DB::table('categories')->get();
    $brand=DB::table('brands')->get();
    $warehouse=DB::table('warehouses')->get();
    return view('admin.product.index',compact('category','brand','warehouse'));
  }
  //Store product
  public function store(Request $request)
  {
    $validated = $request->validate([
       'name' => 'required',
       'code' => 'required|unique:products|max:55',
       'subcategory_id' => 'required',
       'childcategory_id' => 'required',
       'pickup_point_id' => 'required',
       'brand_id' => 'required',
       'unit' => 'required',
       'tags' => 'required',
       'purchase_price' => 'required',
       'selling_price' => 'required',
       'discount_price' => 'required',
       'warehouse_id' => 'required',
       'stock_quantity' => 'required',
       'video' => 'required',
       'description' => 'required',
       'featured' => 'required',
       'today_deal' => 'required',
       'status' => 'required',
   ]);

   //subcategory call for category id
       $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
       $slug=Str::slug($request->name, '-');


       $data=array();
       $data['name']=$request->name;
       $data['slug']=Str::slug($request->name, '-');
       $data['code']=$request->code;
       $data['category_id']=$subcategory->category_id;
       $data['subcategory_id']=$request->subcategory_id;
       $data['childcategory_id']=$request->childcategory_id;
       $data['brand_id']=$request->brand_id;
       $data['pickup_point_id']=$request->pickup_point_id;
       $data['unit']=$request->unit;
       $data['tags']=$request->tags;
       $data['purchase_price']=$request->purchase_price;
       $data['selling_price']=$request->selling_price;
       $data['discount_price']=$request->discount_price;
       $data['warehouse_id']=$request->warehouse_id;
       $data['stock_quantity']=$request->stock_quantity;
       $data['color']=$request->color;
       $data['size']=$request->size;
       $data['description']=$request->description;
       $data['video']=$request->video;
       $data['featured']=$request->featured;
       $data['today_deal']=$request->today_deal;
       $data['product_slider']=$request->product_slider;
       $data['status']=$request->status;
      $data['trendy']=$request->trendy;
       $data['admin_id']=Auth::id();
       $data['date']=date('d-m-Y');
       $data['month']=date('F');

       //Product Thumbanail
       if ($request->thumbnail) {
         $thumbnail=$request->thumbnail;
         $thumbnail_name= $slug.'.'.$thumbnail->getClientOriginalExtension();
         $thumbnail_location=base_path('public/files/product/');
         Image::make($thumbnail)->resize(600,600)->save($thumbnail_location.$thumbnail_name);
         $data['thumbnail']=$thumbnail_name;
       }

       //multiple images
       $images=array();
       if($request->hasFile($images)){
         foreach ($request->file('images') as $key => $image) {
           $image_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           $image_location=base_path('public/files/product/');
           Image::make($image)->resize(600,600)->save($image_location.$image_name);
             array_push($images, $image_name);
         }
         $data['images'] = json_encode($images);
       }
       DB::table('products')->insert($data);
       $notification=array('messege' => 'Product Inserted!', 'alert-type' => 'success');
       return redirect()->back()->with($notification);

  }

public function update(Request $request)
{
  $validated = $request->validate([
     'name' => 'required',
     'code' => 'required|max:55',
     'subcategory_id' => 'required',
     'childcategory_id' => 'required',
     'pickup_point_id' => 'required',
     'brand_id' => 'required',
     'unit' => 'required',
     'tags' => 'required',
     'purchase_price' => 'required',
     'selling_price' => 'required',
     'discount_price' => 'required',
     'warehouse_id' => 'required',
     'stock_quantity' => 'required',
     'video' => 'required',
     'description' => 'required',
     'featured' => 'required',
     'today_deal' => 'required',
     'status' => 'required',
 ]);

 //subcategory call for category id
     $subcategory=DB::table('subcategories')->where('id',$request->subcategory_id)->first();
     $slug=Str::slug($request->name, '-');


     $data=array();
     $data['name']=$request->name;
     $data['slug']=Str::slug($request->name, '-');
     $data['code']=$request->code;
     $data['category_id']=$subcategory->category_id;
     $data['subcategory_id']=$request->subcategory_id;
     $data['childcategory_id']=$request->childcategory_id;
     $data['brand_id']=$request->brand_id;
     $data['pickup_point_id']=$request->pickup_point_id;
     $data['unit']=$request->unit;
     $data['tags']=$request->tags;
     $data['purchase_price']=$request->purchase_price;
     $data['selling_price']=$request->selling_price;
     $data['discount_price']=$request->discount_price;
     $data['warehouse_id']=$request->warehouse_id;
     $data['stock_quantity']=$request->stock_quantity;
     $data['color']=$request->color;
     $data['size']=$request->size;
     $data['description']=$request->description;
     $data['video']=$request->video;
     $data['featured']=$request->featured;
     $data['today_deal']=$request->today_deal;
     $data['product_slider']=$request->product_slider;
     $data['status']=$request->status;
     $data['trendy']=$request->trendy;



     //Check old image are exi or not if exist then delete and insert new image

     if($request->thumbnail){
       $old_thumbnail=base_path('public/files/product/'.$request->old_thumbnail);
       if (File::exists($old_thumbnail)) {
         File::delete($old_thumbnail);
       }
      $thumbnail=$request->thumbnail;
      $thumbnail_name= $slug.'.'.$thumbnail->getClientOriginalExtension();
       $thumbnail_location=base_path('public/files/product/');
       Image::make($thumbnail)->resize(600,600)->save($thumbnail_location.$thumbnail_name);
       $data['thumbnail']=$thumbnail_name;
     }

    //multiple images update


     //multiple images
     $old_images=$request->has('old_images');

     if ($old_images) {
       $images=$request->old_images;
       $data['images']=json_encode($images);
     }
     else {
       $images=array();
       $data['images']=json_encode($images);
     }
     if($request->hasFile($images)){
       foreach ($request->file('images') as $key => $image) {
         $image_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
         $image_location=base_path('public/files/product/');
         Image::make($image)->resize(600,600)->save($image_location.$image_name);
           array_push($images, $image_name);
       }
       $data['images'] = json_encode($images);
     }
     DB::table('products')->where('id',$request->proudct_id)->update($data);
     $notification=array('messege' => 'Product Updated!', 'alert-type' => 'success');
     return redirect()->back()->with($notification);
}
  //deactive_featured
  public function deactive_featured($id)
  {
    DB::table('products')->where('id',$id)->update(['featured'=>0]);
    return response()->json('Deactived Featured!');
  }
  //active_featured
  public function active_featured($id)
  {
    DB::table('products')->where('id',$id)->update(['featured'=>1]);
    return response()->json('Actived Featured!');
  }
  //deactive today_deal
  public function deactive_today_deal($id)
  {
    DB::table('products')->where('id',$id)->update(['today_deal'=>0]);
    return response()->json('deactived Today Deal!');
  }
  //deactive today_deal
  public function active_today_deal($id)
  {
    DB::table('products')->where('id',$id)->update(['today_deal'=>1]);
    return response()->json('Actived Today Deal!');
  }
  //deactive status
  public function deactive_status($id)
  {
    DB::table('products')->where('id',$id)->update(['status'=>0]);
    return response()->json('deactived Status!');
  }
  //active status
  public function active_status($id)
  {
    DB::table('products')->where('id',$id)->update(['status'=>1]);
    return response()->json('Actived Status!');
  }
  //Brand destory method
  public function destory($id){
    $data=DB::table('products')->where('id',$id)->first();
    $Image_location=base_path('public/files/product/').$data->thumbnail;
    if(File::exists($Image_location)){
      unlink($Image_location);
    }
    $images=json_decode($data->images,true);

    if(isset($images)){
      foreach ($images as $key => $image) {
        $multiple_img_location=base_path('public/files/product/').$image;
        if(File::exists($multiple_img_location)){
          File::delete($multiple_img_location);
        }
      }
    }
    DB::table('products')->where('id',$id)->delete();
    $notification=array('messege'=>'Product Deleted!','alert-type'=>'success');

    return back()->with($notification);
  }
  // product edit
  public function edit($id)
  {
    $data=DB::table('products')->where('id',$id)->first();
    $category=DB::table('categories')->get();
    $brand=DB::table('brands')->get();
    $pickuppoint=DB::table('pickuppoints')->get();
    $warehouse =DB::table('warehouses')->get();
    $childcategory=DB::table('childcategories')->where('category_id',$data->category_id)->get();
    return view('admin.product.edit',compact('category','data','brand','pickuppoint','warehouse','childcategory'));
  }
}
