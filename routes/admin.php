<?php

use Illuminate\Support\Facades\Route;
Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');
// Route::get('/admin/home', [App\Http\Controllers\Admin\AdminController::class, 'admin'])->name('admin.home')->middleware('is_admin');
Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'is_admin'],function(){
  Route::get('/admin/home', 'AdminController@admin')->name('admin.home');
  Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
  Route::get('/admin/email/change', 'AdminController@emailchange')->name('admin.email.change');
  Route::post('/admin/email/update', 'AdminController@emailupdate')->name('admin.email.update');
  Route::get('/admin/password/change', 'AdminController@passwordchange')->name('admin.password.change');
  Route::post('/admin/password/update', 'AdminController@passwordupdate')->name('admin.password.update');
//Category Route
  Route::group(['prefix'=>'category'],function(){
    Route::get('/','CategoryController@index')->name('category.index');
    Route::post('/store',"CategoryController@store")->name('category.store');
    Route::get('/delete/{id}','CategoryController@destory')->name('category.delete');
    Route::get('/edit/{id}','CategoryController@edit')->name('category.edit');
    Route::post('/update','CategoryController@update')->name('category.update');
  });
  Route::get('/get-child-category/{id}',"CategoryController@getchildcategory");
  //subcategory Route
  Route::group(['prefix'=>'subcategory'],function(){
    Route::get('/','SubcategoryController@index')->name('subcategory.index');
    Route::post('/store',"SubcategoryController@store")->name('subcategory.store');
     Route::get('/delete/{id}','subcategoryController@destory')->name('subcategory.delete');
    Route::get('/edit/{id}','SubcategoryController@edit')->name('subcategory.edit');
    Route::post('/update','SubcategoryController@update')->name('subcategory.update');
  });
  //childcategory route
  Route::group(['prefix'=>'childcategory'],function(){
    Route::get('/','ChildcategoryController@index')->name('childcategory.index');
     Route::post('/store',"ChildcategoryController@store")->name('childcategory.store');
     Route::get('/delete/{id}','ChildcategoryController@destory')->name('childcategory.delete');
     Route::get('/edit/{id}','ChildcategoryController@edit')->name('childcategory.edit');
     Route::post('/update','ChildcategoryController@update')->name('childcategory.update');
  });
  //brand route
  Route::group(['prefix'=>'brand'],function(){
    Route::get('/','BrandController@index')->name('brand.index');
    Route::post('/store',"BrandController@store")->name('brand.store');
    Route::get('/delete/{id}','BrandController@destory')->name('brand.delete');
    Route::get('/edit/{id}','BrandController@edit')->name('brand.edit');
    Route::post('/update','BrandController@update')->name('brand.update');
  });
  //coupn route
  Route::group(['prefix'=>'coupon'],function(){
    Route::get('/','CouponController@index')->name('coupon.index');
    Route::post('/store',"CouponController@store")->name('coupon.store');
     Route::get('/delete/{id}','CouponController@destory')->name('coupon.delete');
     Route::get('/edit/{id}','CouponController@edit')->name('coupon.edit');
     Route::post('/update/{id}','CouponController@update')->name('coupon.update');
  });
  //warehouse route
  Route::group(['prefix'=>'warehouse'],function(){
    Route::get('/','WarehouseController@index')->name('warehouse.index');
     Route::post('/store',"WarehouseController@store")->name('warehouse.store');
     Route::get('/delete/{id}','WarehouseController@destory')->name('warehouse.delete');
     Route::get('/edit/{id}','WarehouseController@edit')->name('warehouse.edit');
    Route::post('/update/{id}','WarehouseController@update')->name('warehouse.update');
  });
  //pickup point route
  Route::group(['prefix'=>'pickuppoint'],function(){
    Route::get('/','PickuppointController@index')->name('pickuppoint.index');
    Route::post('/store',"PickuppointController@store")->name('pickuppoint.store');
    Route::get('/delete/{id}','PickuppointController@destory')->name('pickuppoint.delete');
    Route::get('/edit/{id}','PickuppointController@edit')->name('pickuppoint.edit');
    Route::post('/update/{id}','PickuppointController@update')->name('pickuppoint.update');
  });
  //pickup point route
  Route::group(['prefix'=>'product'],function(){
    Route::get('/','ProductController@index')->name('product.index');
    Route::get('/create','ProductController@create')->name('product.create');
    Route::post('/store',"ProductController@store")->name('product.store');
    Route::get('/deactive_featured/{id}',"ProductController@deactive_featured")->name('product.deactive_featured');
    Route::get('/active_featured/{id}',"ProductController@active_featured")->name('product.deactive_featured');
    Route::get('/deactive_today_deal/{id}',"ProductController@deactive_today_deal")->name('product.deactive_today_deal');
    Route::get('/active_today_deal/{id}',"ProductController@active_today_deal")->name('product.active_today_deal');
    Route::get('/deactive_status/{id}',"ProductController@deactive_status")->name('product.deactive_status');
    Route::get('/active_status/{id}',"ProductController@active_status")->name('product.active_status');
    Route::get('/delete/{id}','ProductController@destory')->name('product.delete');
    // Route::get('/edit/{id}','PickuppointController@edit')->name('pickuppoint.edit');
    // Route::post('/update/{id}','PickuppointController@update')->name('pickuppoint.update');
  });
  //Settings Route
  Route::group(['setting'=>'brand'],function(){
    //seo Route
    Route::group(['prefix'=>'seo'],function(){
      Route::get('/','SettingsController@seo')->name('seo.setting');
      Route::post('seo/update/{id}',"SettingsController@seoupdate")->name('seo.update');
    });
    //sebsite setting Route
    Route::group(['prefix'=>'website'],function(){
      Route::get('/','SettingsController@websitesetting')->name('website.setting');
      Route::post('update/{id}',"SettingsController@websiteupdate")->name('website.update');
    });
    //Smtp Route
    Route::group(['prefix'=>'smtp'],function(){
      Route::get('/','SettingsController@smtp')->name('smtp.setting');
      Route::post('smtp/update/{id}',"SettingsController@smtpupdate")->name('smtp.update');
    });
    //page setting Route
    Route::group(['prefix'=>'page'],function(){
      Route::get('/','PageController@index')->name('page.index');
      Route::get('create','PageController@create')->name('page.create');
      Route::post('store','PageController@store')->name('page.store');
      Route::get('edit/{id}','PageController@edit')->name('page.edit');
      Route::get('delete/{id}','PageController@destory')->name('page.delete');
       Route::post('update/{id}',"PageController@update")->name('page.update');
    });
  });
});
