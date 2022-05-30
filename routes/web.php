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
  Route::get('/product-quick-view/{id}','IndexController@productQuickView');
  Route::post('review-store','ReviewController@store')->name('review.store');
  Route::get('add-wishlist/{id}','ReviewController@addwishlist')->name('add.wishlist');
});
