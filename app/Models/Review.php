<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded =[];
    function connect_to_user(){
      return $this->belongsTo('App\Models\User','user_id');
    }
    function connect_to_product(){
      return $this->belongsTo('App\Models\Product','product_id');
    }
}
