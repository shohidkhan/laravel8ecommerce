<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CampaignProductController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function campaignProducts($campaign_id)
  {
    $products=DB::table('products')->leftJoin('categories','products.category_id','categories.id')
    ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
    ->leftJoin('childcategories','products.childcategory_id','childcategories.id')
    ->leftJoin('brands','products.brand_id','brands.id')
    ->leftJoin('pickuppoints','products.pickup_point_id','pickuppoints.id')
    ->leftJoin('warehouses','products.warehouse_id','warehouses.id')
    ->select('products.*','categories.category_name','subcategories.subcategory_name','childcategories.childcategory_name','brands.brand_name','pickuppoints.pickup_point_name','warehouses.warehouse_name')
    ->where('status',1)
    ->get();

    return view('admin.campaignproduct.index',compact('products','campaign_id'));
  }


  public function campaignproductadd($id,$campaign_id)
  {
      $campaign=DB::table('campaigns')->where('id', $campaign_id)->first();
      $product=DB::table('products')->where('id',$id)->first();
      $data=array();
      $discount=$product->selling_price - ($product->selling_price/100*  $campaign->discount);

      $data['product_id']=$id;
      $data['price']=$discount;
      $data['campaign_id']=$campaign_id;

      DB::table('campaign_products')->insert($data);
      $notification=array('messege' => 'Product Added To Campaign successfully!', 'alert-type' => 'success');
      return redirect()->back()->with($notification);
  }

  public function campaignproductlist($campaign_id)
  {
    $campaign_products=DB::table('campaign_products')
    ->leftJoin('products','campaign_products.product_id','products.id')
    ->select('campaign_products.*','products.thumbnail','products.name','products.code','products.selling_price')
    ->where('campaign_id',$campaign_id)
    ->get();
    $campaign=DB::table('campaigns')->where('id',$campaign_id)->first();

    return view('admin.campaignproduct.product_list',compact('campaign_products','campaign'));
  }

  public function delete($id)
  {
    DB::table('campaign_products')->where('id',$id)->delete();
    $notification=array('messege' => 'Product deleted from Campaign successfully!', 'alert-type' => 'success');
    return redirect()->back()->with($notification);
  }
}
