<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Brand;
use App\Models\Pickuppoint;
use App\Models\Warehouse;

class Product extends Model
{
    use HasFactory;
      protected $guraded = [];


      public function connect_to_category()
      {
        return $this->belongsTo(Category::class,'category_id');
      }

      public function connect_to_subcategory()
      {
        return $this->belongsTo(Subcategory::class,'subcategory_id');
      }

      public function connect_to_childcategory()
      {
        return $this->belongsTo(Childcategory::class,'childcategory_id');
      }

      public function connect_to_Pickuppoint()
      {
        return $this->belongsTo(Pickuppoint::class,'pickup_point_id');
      }

      public function connect_to_brand()
      {
        return $this->belongsTo(Brand::class,'brand_id');
      }

      public function connect_to_warehouse()
      {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
      }
}
