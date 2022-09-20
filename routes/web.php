<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});


Auth::routes();
// Route::get('/login',function(){
//     return redirect()->to('/');
// })->name('login');

// Route::get('/register',function(){
//   return redirect()->to('/');
// })->name('register');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');

Route::group(['namespace'=>'App\Http\Controllers\Frontend',],function(){
  Route::get('/','IndexController@index');
  Route::get('/product_details/{slug}','IndexController@productDetails')->name('product.details');
  Route::get('/campaign_details/{slug}','IndexController@campaign_product_details')->name('campaign.product.details');
  Route::get('/campaign/product/{id}','IndexController@campaigns_products')->name('frontend.campaign.products');
  Route::get('/product-quick-view/{id}','IndexController@productQuickView');
  //Store Review
  Route::post('review-store','ReviewController@store')->name('review.store');
  Route::post('/store/review/website','ReviewController@storeReviewWebsite')->name('store.website.review');
  Route::get('/write/review','ReviewController@WriteReviewWebsite')->name('write.review');
  //add to cart
  Route::post('/addtocart','CartController@addToCart')->name('add.to.cart');
  Route::get('/cart','CartController@cart')->name('cart');
  Route::post('/cart/update/{rowId}','CartController@cartupdate')->name('cart.update');
  Route::get('/cartproduct/remove/{rowId}','CartController@cartproductremove')->name('cartproduct.remove');
  Route::get('/cart/empty','CartController@cartempty')->name('cart.empty');
  Route::get('/wishlist',"CartController@wishlist")->name('wishlist');
  Route::get('/wishlist/product/remove/{id}',"CartController@wishlistprductremove")->name('wishlistproduct.remove');
  Route::get('/wishlist/empty',"CartController@wishlistempty")->name('wishlist.empty');
  Route::get('add-wishlist/{id}','CartController@addwishlist')->name('add.wishlist');



  //Category Wise Product Routes
  Route::get('/categorywise/product/{id}','IndexController@CategoryWiseProduct')->name('categorywise.product');
  //SubCategory Wise Product Routes
  Route::get('/subcategorywise/product/{id}','IndexController@SubcategoryWiseProduct')->name('subcategorywise.product');
  //ChildCategory Wise Product Routes
  Route::get('/childcategorywise/product/{id}','IndexController@ChildcategoryWiseProduct')->name('childcategorywise.product');
  //Brand Wise Product Routes
  Route::get('/brandwise/product/{id}','IndexController@brandwiseProduct')->name('brandwise.product');


  //Profile Settinig
  Route::get('/setting','ProfileSettingController@ProfileSetting')->name('setting');
  Route::post('/customer/password/change','ProfileSettingController@customerPasswordChange')->name('customer.password.change');


  //page deatails
  Route::get('/page/details/{slug}','IndexController@page_details')->name('page.details');
  //page deatails
  Route::post('/newsletter/store','IndexController@newsletterStore')->name('newsletter.store');
  //checkout
  Route::get('/checkout','CheckoutController@checkout')->name('checkout');
  Route::post('/apply/coupon','CheckoutController@applycoupon')->name('apply.coupon');
  Route::get('/remove/coupon','CheckoutController@removecoupon')->name('remove.coupon');


  //order
  Route::post('/order/place','OrderController@orderplace')->name('order.place');
  Route::get('/my/order','OrderController@myorder')->name('my.order');
  Route::get('/view/order/{id}','OrderController@vieworder')->name('view.order');
  Route::get('/order/tracking','OrderController@ordertracking')->name('order.tracking');
  Route::post('/check/order','OrderController@ordercheck')->name('check.order');

  //Ticket
  Route::get('/open/ticket','TicketController@openticket')->name('open.ticket');
  Route::get('/new/ticket','TicketController@newticket')->name('new.ticket');
  Route::post('/store/ticket','TicketController@storeticket')->name('store.ticket');
  Route::get('/show/ticket/{id}','TicketController@showticket')->name('show.ticket');
  Route::post('/reply/ticket','TicketController@reply')->name('reply.ticket');
  Route::get('/contact','ContactController@contact');
  Route::post('/contact/post','ContactController@contactpost')->name('contact.post');


  //__payment_getway
Route::post('/success','OrderController@success')->name('success');
Route::post('/fail','OrderController@fail')->name('fail');
//BLog
Route::get('/blogs','BlogController@blogs');
Route::get('/blogs/details/{slug}','BlogController@blog_details')->name('blog.details');

});

//socialite
Route::get('oauth/{driver}', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('social.callback');
