<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cart;
Use App\Models\Product;
use DB;
class CartController extends Controller
{
    public function addToCart(Request $request)
    {
      $product=Product::find($request->id);
      Cart::add([
          'id'=>$product->id,
          'name'=>$product->name,
          'qty'=>$request->qty,
          'price'=>$request->price,
          'weight'=>'1',
          'options'=>
          [
            'size'=>$request->size ,
            'color'=> $request->color ,
            'thumbnail'=>$product->thumbnail
          ]

      ]);
      $notification=array('messege'=>'Products Added on cart!','alert-type'=>'success');
      return back()->with($notification);

    }


    public function addwishlist($id)
    {
      if(Auth::check()){
        $check_wishlist=DB::table('wishlists')->where('product_id',$id)->where('user_id',Auth::id())->first();
        if($check_wishlist){
          $notification= array('messege' =>'You have already added  this product on your wishlist!' , 'alert-type'=>'error');
          return back()->with($notification);
        }
        else {
          $data=array();
          $data['user_id']=Auth::id();
          $data['product_id']=$id;
          $data['date']=date('d,F Y');
          DB::table('wishlists')->insert($data);
          $notification= array('messege' =>'You have  added this product on wishlist!' , 'alert-type'=>'success');
          return back()->with($notification);
        }
      }
      else{
        $notification= array('messege' =>'Please Login your account to added this product on wishlist!' , 'alert-type'=>'error');
        return redirect()->route('login')->with($notification);
      }
    }

    public function cart()
    {
      $content=Cart::content();
      return view('frontend.cart.cart',compact('content'));
    }
    //Cart product Remove
    public function cartproductremove($rowId)
    {
      Cart::remove($rowId);
      $notification= array('messege' =>'Cart Product Remove successfully !' , 'alert-type'=>'success');
      return back()->with($notification);
    }

    //Cart update
    public function cartupdate($rowId, Request $request)
    {

      $thumbnail=$request->thumbnail;
      Cart::update($rowId,
      [   'qty' => $request->qty,

        'options'  =>
                  [
                    'size' => $request->size,
                    'color' => $request->color,

                    'thumbnail'=>$thumbnail,
                  ]
    ]);
    $notification= array('messege' =>'Cart Updated successfully !' , 'alert-type'=>'success');
    return back()->with($notification);
    }
    //Cart Empty
    public function cartempty()
    {
      Cart::destroy();
      $notification= array('messege' =>'Cart Empty successfully !' , 'alert-type'=>'success');
      return redirect()->to('/')->with($notification);
    }

    //wishlist
    public function wishlist()
    {
      if(Auth::check()){
        $wishlist=DB::table('wishlists')->leftJoin('products','wishlists.product_id','products.id')->select('products.name','products.thumbnail','products.slug','wishlists.*')->where('user_id',Auth::id())->get();
        return view('frontend.cart.wishlist',compact('wishlist'));
      }
      else{
        $notification= array('messege' =>'Login Please !' , 'alert-type'=>'error');
        return redirect()->to('/login')->with($notification);
      }
    }
    //WishList Product remove
    public function wishlistprductremove($id)
    {
      DB::table('wishlists')->where('id',$id)->delete();
      $notification= array('messege' =>'Product Deleted successfully from WishList !' , 'alert-type'=>'success');
      return back()->with($notification);
    }
    //Wishlist Empty
    public function wishlistempty()
    {
      DB::table('wishlists')->where('user_id',Auth::id())->delete();
      $notification= array('messege' =>'WishList Empty successfully!' , 'alert-type'=>'success');
      return back()->with($notification);
    }

}
