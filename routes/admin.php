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
  //Campaign route
  Route::group(['prefix'=>'campaign'],function(){
    Route::get('/','CampaignContoller@index')->name('campaign.index');
    Route::post('/store',"CampaignContoller@store")->name('campaign.store');
     Route::get('/delete/{id}','CampaignContoller@destory')->name('campaign.delete');
     Route::get('/edit/{id}','CampaignContoller@edit')->name('campaign.edit');
     Route::post('/update','CampaignContoller@update')->name('campaign.update');
  });
  //Campaign route
  Route::group(['prefix'=>'campaign.products'],function(){
    Route::get('/{campaign_id}','CampaignProductController@campaignProducts')->name('campaign.products');
    Route::get('/add/{id}/{campaign_id}',"CampaignProductController@campaignproductadd")->name('add.product.to.campaign');
     Route::get('/product/list/{campaign_id}','CampaignProductController@campaignproductlist')->name('campaign.products.list');
  Route::get('/delete/{id}','CampaignProductController@delete')->name('campaign.product.delete');
    //  Route::post('/update','CampaignContoller@update')->name('campaign.update');
  });
  //coupn route
  Route::group(['prefix'=>'coupon'],function(){
    Route::get('/','CouponController@index')->name('coupon.index');
    Route::post('/store',"CouponController@store")->name('coupon.store');
     Route::get('/delete/{id}','CouponController@destory')->name('coupon.delete');
     Route::get('/edit/{id}','CouponController@edit')->name('coupon.edit');
     Route::post('/update/{id}','CouponController@update')->name('coupon.update');
  });
  //coupn route
  Route::group(['prefix'=>'order'],function(){
    Route::get('/','OrderController@index')->name('order.index');
    Route::get('/view/{id}',"OrderController@orderview")->name('order.view');
     Route::get('/delete/{id}','OrderController@destory')->name('order.delete');
     Route::get('/edit/{id}','OrderController@edit')->name('order.edit');
     Route::post('/update/{id}','OrderController@updatestatus')->name('update.status');
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
  Route::group(['prefix'=>'role'],function(){
    Route::get('/','RoleController@index')->name('manage.role');
    Route::get('/create','RoleController@create')->name('user.role.create');
    Route::post('/store/role',"RoleController@store")->name('store.role');
     Route::get('/edit/{id}','RoleController@edit')->name('role.edit');
     Route::get('/delete/{id}','RoleController@destroy')->name('role.delete');
    Route::post('/update/{id}','RoleController@update')->name('update.role');
  });
  //blog category point route
  Route::group(['prefix'=>'blog-category'],function(){
    Route::get('/','BlogCategoryController@index')->name('blog.category');
   Route::post('/store',"BlogCategoryController@store")->name('blog.category.store');
     Route::get('/delete/{id}','BlogCategoryController@destory')->name('blog.category.delete');
    Route::get('/edit/{id}','BlogCategoryController@edit')->name('blog.category.edit');
     Route::post('/update/{id}','BlogCategoryController@update')->name('blog.category.update');
  });

  //blog point route
  Route::group(['prefix'=>'blog'],function(){
    Route::get('/','BlogController@index')->name('blog.index');
    Route::post('/store',"BlogController@store")->name('blog.store');
    Route::get('/deactive_status/{id}',"BlogController@deactive_status")->name('blog.deactive_status');
    Route::get('/active_status/{id}',"BlogController@active_status")->name('blog.active_status');
    Route::get('/delete/{id}','BlogController@destory')->name('blog.delete');
    Route::get('/edit/{id}','BlogController@edit')->name('blog.edit');
     Route::post('/update/{id}','BlogController@update')->name('blog.update');
  });
  //blog point route
  Route::group(['prefix'=>'contacts'],function(){
    Route::get('/','ContactController@index')->name('admin.contact');

     Route::get('/contact/view/{id}',"ContactController@contact_view")->name('contact.view');
     Route::get('/send/mail/{email}',"ContactController@contact_send_mail")->name('contact.send.mail');
  });
  //report point route
  Route::group(['prefix'=>'report'],function(){
    Route::get('/order','ReportController@orderIndex')->name('report.order.index');
    Route::get('/order/print','ReportController@reportOderPrint')->name('report.order.print');
    Route::get('/customers/orders/report','ReportController@customersOrdersReport')->name('customers.orders.report');
    Route::get('/customers/single/order/{id}','ReportController@customersingleorder')->name('customer.single.order');
    Route::get('/customers/single/order/print','ReportController@customersingleorderPrint')->name('single.report.order.print');
     // Route::get('/contact/view/{id}',"ContactController@contact_view")->name('contact.view');
     // Route::get('/send/mail/{email}',"ContactController@contact_send_mail")->name('contact.send.mail');
  });

  //product route
  Route::group(['prefix'=>'product'],function(){
    Route::get('/','ProductController@index')->name('product.index');
    Route::get('/create','ProductController@create')->name('product.create');
    Route::post('/store',"ProductController@store")->name('product.store');
    Route::post('/product/update',"ProductController@update")->name('product.update');
    Route::get('/deactive_featured/{id}',"ProductController@deactive_featured")->name('product.deactive_featured');
    Route::get('/active_featured/{id}',"ProductController@active_featured")->name('product.deactive_featured');
    Route::get('/deactive_today_deal/{id}',"ProductController@deactive_today_deal")->name('product.deactive_today_deal');
    Route::get('/active_today_deal/{id}',"ProductController@active_today_deal")->name('product.active_today_deal');
    Route::get('/deactive_status/{id}',"ProductController@deactive_status")->name('product.deactive_status');
    Route::get('/active_status/{id}',"ProductController@active_status")->name('product.active_status');
    Route::get('/delete/{id}','ProductController@destory')->name('product.delete');
   Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
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
    //page setting Route
    Route::group(['prefix'=>'ticket'],function(){
      Route::get('/','TicketController@index')->name('ticket.index');
      Route::get('/ticket/show/{id}','TicketController@ticketshow')->name('admin.ticket.show');
      Route::post('/admin/reply','TicketController@reply')->name('admin.reply');
      Route::get('/close/ticket/{id}','TicketController@closeticket')->name('admin.close.ticket');
      Route::get('/ticket/delete/{id}','TicketController@destory')->name('admin.ticket.delete');
      //  Route::post('update/{id}',"PageController@update")->name('page.update');
    });
    //Payment_getway
    Route::group(['prefix'=>'Payment_getway'],function(){
      Route::get('/payment/getway','Payment_getwayController@payment_getway')->name('payment.getway');
      Route::post('/update/aamarpay','Payment_getwayController@updateaamrpay')->name('update.aamarpay');
      Route::post('/update/surjopay','Payment_getwayController@updatsurjopay')->name('update.surjopay');
    });
  });
});
