<?php

  use App\Http\Controllers\Admin\LoginAdminController;
  use App\Http\Controllers\Admin\AdminController;
  use App\Http\Controllers\Admin\SectionController;
  use App\Http\Controllers\Admin\BrandController;
  use App\Http\Controllers\Admin\CategoryController;
  use App\Http\Controllers\Admin\CouponController;
  use App\Http\Controllers\Admin\BannerController;
  use App\Http\Controllers\Admin\FaqController;
  use App\Http\Controllers\Admin\AboutController;
  use App\Http\Controllers\Admin\PolicyController;
  use App\Http\Controllers\Admin\ShippingReturnController;
  use App\Http\Controllers\Admin\CommentController;
  use App\Http\Controllers\Admin\SettingController;
  use App\Http\Controllers\Admin\GatewayController;
  use App\Http\Controllers\Admin\OrderController;
  use App\Http\Controllers\Admin\ProductController;
  use App\Http\Controllers\Admin\ShippingChargeController;
  use App\Http\Controllers\Admin\AddProductController;
  use App\Http\Controllers\Admin\PostController;
  use App\Http\Controllers\Admin\FilterController;
  use App\Http\Controllers\Admin\PageController;
  use App\Http\Controllers\SslCommerzPaymentController;
  
 Route::get('/clear', function() {
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');

	return "Cleared!";
});
  
  Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    
        Route::match(['get','post'],'admin-login-page',[LoginAdminController::class, 'login']);
        Route::match(['get','post'],'forgot-password-recovery',[LoginAdminController::class, 'forgotPassword']);
        
        Route::get('logout-admin',[LoginAdminController::class,'logout']);
    
    
    // ========== Middleware Group ========== //
    
    Route::group(['middleware'=>['admin']],function(){
        
        //All ajax part for the admin===============start here=========//
        
        Route::post('status-section-update',[SectionController::class,'updateSection']);
        Route::post('status-brand-update',[BrandController::class,'updateBrand']);
        Route::post('status-category-update',[CategoryController::class,'updateCate']);
        Route::post('status-section-level',[CategoryController::class,'appendCate']);
        Route::post('status-category-cuopon',[CouponController::class,'updateCate']);
        Route::post('status-banner-update',[BannerController::class,'updateCate']);
        Route::post('status-faq-update',[FaqController::class,'updateFaq']);
        Route::post('status-comment-update',[CommentController::class,'updateComment']);
        Route::post('status-rating-update',[CommentController::class,'updateRating']);
        Route::post('status-sms-update',[GatewayController::class,'updateSms']);
        Route::post('status-paymentgateway-update',[SettingController::class,'updateGateway']);
        Route::post('status-zip-code',[SettingController::class,'updateZipCode']);
        Route::post('status-currency-converter',[SettingController::class,'updateCurrencyStatus']);
        Route::post('status-color-update',[ProductController::class,'statusColor']);
        Route::post('status-shippingcharge-update',[ShippingChargeController::class,'updateCharge']);
        Route::post('status-event-create-update',[ProductController::class,'statusEvent']);
        Route::post('status-product-update',[ProductController::class,'updateStatusProduct']);
        Route::post('status-faq-product',[ProductController::class,'updateStatusFaqProduct']);
        Route::post('status-announcement-update',[AdminController::class,'updateStatusAnnouncement']);
        Route::post('get-multiple-highest-products',[AdminController::class,'changeProductValue']);
        Route::post('status-section-productattribute',[ProductController::class,'updateAttribute']);
        Route::post('status-about-product',[ProductController::class,'updatStatusAboutProduct']);
        Route::post('status-user-update',[AdminController::class,'updatStatusUser']);
        Route::post('status-cam-update',[AdminController::class,'updatStatusCam']);
        Route::post('status-filter-update',[FilterController::class,'updateStatusFilter']);
        Route::post('status-filter-value-update',[FilterController::class,'updateStatusFilterValue']);
        Route::post('category-filters',[FilterController::class,'categoryFilter']);
        Route::post('status-preorder',[ProductController::class,'statusPreorder']);
        
         //======All ajax part for the admin===============End here==============
        
        // =====Admin part=====//
        
        Route::get('dashbord-home-page',[AdminController::class,'index']);
        
        Route::get('user-list',[AdminController::class,'viewUser']);
        Route::get('user-list-view/{id}',[AdminController::class,'show']);
        Route::get('user-list-check/{id}',[AdminController::class,'check']);
        Route::match(['get','post'],'user-list-create',[AdminController::class,'store']);
        Route::match(['get','post'],'user-list-delete/{id}',[AdminController::class,'destroy']);
        Route::match(['get','post'],'user-list-update/{id}',[AdminController::class,'update']);
        Route::post('user-list-password-change/{id}',[AdminController::class,'passwordChange']);
        
        //========Announcement=============//
        Route::get('announcement-lists',[AdminController::class,'indexAnnouncement']);
        Route::match(['get','post'],'announcement-create-store/{id?}',[AdminController::class,'storeAnnouncement']);
        //==============Role Part============//
        
        // ======user List=======//
        Route::get('user-lists',[AdminController::class,'getUser']);
        Route::get('/user-status-delete/{id}',[AdminController::class,'userDelete']);
        
        Route::get('role-lists',[AdminController::class,'roleList']);
        Route::match(['get','post'],'role-create-store/{id?}',[AdminController::class,'roleStore']);
        
        //==============Section Parts=================//
        
        Route::get('section-lists',[SectionController::class,'index']);
        
        Route::match(['get','post'],'section-create-store/{id?}',[SectionController::class,'storeAndUpdate']);
        
        
         //===============Brand Parts================//
        
        Route::get('brand-lists',[BrandController::class,'index']);
        Route::match(['get','post'],'brand-create-store/{id?}',[BrandController::class,'storeAndUpdate']);
        
        //================Category parts=================//
        
        Route::get('category-lists',[CategoryController::class,'index']);
        Route::match(['get','post'],'add-edit-category/{id?}',[CategoryController::class,'AddUpdateCategory']);
        Route::match(['get','post'],'category-delete/{id}',[CategoryController::class,'delete']);
        
        //============coupon part====================//
        
        Route::get('coupon-lists',[CouponController::class,'Coupon']);
        Route::get('coupon-delete-/{id}',[CouponController::class,'DeleteCoupon']);
        Route::match(['get','post'],'coupon-store-update/{id?}',[CouponController::class,'addEditCoupon']);
        
        //=========website Maintainance==============//
        
        //=============Home banner===========//
        
        route::match(['get','post'],'banner-create-store/{id?}',[BannerController::class,'storeUpdate']);
        route::get('banner-lists',[BannerController::class,'index']);
        
        //faq Pages
        Route::match(['get','post'],'faq-create-store/{id?}',[FaqController::class,'store']);
        Route::get('faq-lists',[FaqController::class,'index']);
        
        //====about page part====//
        Route::get('page-builder-lists',[PageController::class,'index']);
        Route::match(['get','post'],'page-builder-create-store/{id?}',[PageController::class,'addEditUpdate']);
        
        //=====privacy page part=====//
        //Route::get('policy-lists',[PolicyController::class,'index']);
        //Route::match(['get','post'],'policy-create-store/{id?}',[PolicyController::class,'store']);
        
        //=====Shipping return page part======//
        //Route::get('shipping-return-policy-lists',[ShippingReturnController::class,'index']);
        //Route::match(['get','post'],'shipping-return-create-store/{id?}',[ShippingReturnController::class,'store']);
        
        Route::get('sitesetting-lists', [SettingController::class,'index']);
        Route::match(['get','post'],'sitesetting-create-store/{id?}', [SettingController::class,'store']);
        
        
        // ===========customer part================//
        Route::get('comment-lists',[CommentController::class,'index']);
        Route::match(['get','post'],'customer-comment-replay/{id?}',[CommentController::class,'commentReplay']);
        Route::get('rating-lists',[CommentController::class,'ratingIndex']);
        Route::match(['get','post'],'rating-delete/{id}',[CommentController::class,'ratingDelete']);
        
        // =========sms=============//
        Route::get('sms-lists',[GatewayController::class,'index']);
        Route::match(['get','post'],'smsgateway-create-store/{id?}',[GatewayController::class,'store']);
        
        //=========SMTP ENV=======================//
        Route::get('/smtp-lists',[SettingController::class,'smtp']);
		Route::post('/smtp-update/',[SettingController::class,'smtpUpdate'])->name('admin.smtp.setting.update'); 
		
          //==========payment gateway==========\\
          
		Route::get('/payment-gateway-lists',[SettingController::class,'gatewayIndex']);
		Route::match(['get','post'],'payment-gateway-create-store/{id?}',[SettingController::class,'gatewayStoreUpdate']);
		
        //==========Order Management===========//
        
        Route::match(['get','post'],'/order-lists',[OrderController::class,'index']);
        Route::get('/order-view/{id}',[OrderController::class,'view']);
        Route::get('/order-invoice-view/{id}',[OrderController::class,'invoice']);
        Route::post('/order-status-change',[OrderController::class,'orderStatus']);
        Route::match(['get','post'],'/inventory-product-lists',[OrderController::class,'inventory']);
        
        // Return Products
        
        Route::get('/return-lists/',[OrderController::class,'indexReturn']);
        Route::post('/return-product-status/',[OrderController::class,'updateReturn']);
        
        // Return Products
        
        Route::get('/exchange-lists/',[OrderController::class,'indexExchange']);
        Route::post('/exchange-product-status/',[OrderController::class,'updateExchange']);
        
        //==========color parts=========//
        
        Route::get('/color-lists/',[ProductController::class,'indexColor']);
        Route::match(['get','post'],'/color-create-store/',[ProductController::class,'storeColor']);
        Route::match(['get','post'],'/color-edit-update/{id}',[ProductController::class,'updateColor']);
        
        //============shipping charge===============//
        
        Route::get('/shipping-charge-lists/',[ShippingChargeController::class,'index']);
        Route::match(['get','post'],'/shipping-charge-create-store/{id?}',[ShippingChargeController::class,'storeCharge']);
        
        //===========Product Parts===========//
        
        Route::get('/product-lists',[ProductController::class,'index']);
        Route::match(['get','post'],'/product-create-store/{id?}',[ProductController::class,'store']);
        Route::get('/product-video-delete/{id}',[ProductController::class,'deleteVideoProduct']);
        Route::get('/product-image-delete/{id}',[ProductController::class,'deleteImageProduct']);
        Route::post('attribute-image/{id}',[ProductController::class,'attributeImageProduct']);
        
        
        // ======occassion parts=======//
        Route::get('/occassion-event-lists/',[ProductController::class,'indexEvent']);
        Route::match(['get','post'],'/occassion-event-create-store/{id?}',[ProductController::class,'storeEvent']);
        Route::match(['get','post'],'/occassion-event-edit-update/{id}',[ProductController::class,'updateEvent']);
        
        Route::match(['get','post'],'/faq-product-create-store/{id}',[ProductController::class,'faqProduct']);
        Route::post('/faq-product-create-update',[ProductController::class,'faqUpdateProduct']);
        Route::get('/product-faq-delete/{id}',[ProductController::class,'deleteFaqProduct']);
        
        // =====product about=====//
        Route::match(['get','post'],'/about-product-create-store',[ProductController::class,'aboutProduct']);
        Route::post('/about-product-create-update',[ProductController::class,'aboutUpdateProduct']);
        Route::get('/product-about-delete/{id}',[ProductController::class,'deleteaboutProduct']);
        
        
        
        Route::get('index-addproduct',[AddProductController::class,'index'])->name('admin.index-addproduct');
        Route::match(['get','post'],'add-edit-addproduct/{id?}',[AddProductController::class,'addEdit']);
        Route::get('send-mail-individual/{id?}',[AddProductController::class,'sendMail']);
        Route::get('delete-addproduct/{id?}',[AddProductController::class,'deleteAds']);
        
        //======Campign Offer Create Page=====//
        
        Route::post('add-campaing/',[PostController::class,'addeditCampain']);
        Route::get('/cam-user-delete/{id}',[PostController::class,'delete']);
        Route::get('/cam-send-offer/{id}',[PostController::class,'sentUser']);
        
        // ===zip code ====//
        Route::match(['get','post'],'/zipcode-create-store',[SettingController::class,'pinCodeStore']);
        Route::post('/zipcode-create-update',[SettingController::class,'pinCodeUpdate']);
        Route::get('/zip-code-delete/{id}',[SettingController::class,'zipCodeDelete']);
        
        //=======Currncy Converter=====//
        Route::match(['get','post'],'/currency-create-store',[SettingController::class,'currencyStore']);
        Route::post('/currency-create-update',[SettingController::class,'currencyUpdate']);
        // =========Filter===========//
        Route::get('/filter-lists',[FilterController::class,'filterIndex']);
        Route::match(['get','post'],'/filter-create-store/{id?}',[FilterController::class,'filterStore']);
        
        // =====Filter Values==========//
        
        Route::get('/filter-value-lists',[FilterController::class,'filterValueIndex']);
        Route::match(['get','post'],'/filter-value-create-store/{id?}',[FilterController::class,'filterValueStore']);
        
        //======Pre Order====//
        Route::get('/preorder-lists',[ProductController::class,'getPreorder']);
        Route::get('/getDiscountProducts',[ProductController::class,'getDiscountProducts']);
        Route::get('/getNewArrivalProducts',[ProductController::class,'getNewArrivalProducts']);
        
        
    });
    
});


//====website=====part====start=======//

Route::get('/track','WebsiteController@track');
//======Event Parts======//

Route::get('/single-event/{name}','WebsiteController@singleEvent');
Route::get('/all-event/','WebsiteController@allEvent');
Route::get('/latest-products','WebsiteController@newProducts');

//Product Details
Route::get('/product/details/{id}/{product_name}', 'ProductController@ProductView');

// =====quick add-to cart=====//by ajax====
Route::post('/quick-product-add','ProductController@quickAddProduct')->name('/quick-product-add');
Route::post('/add-product-detail-page','ProductController@ajaxAddProductDetail')->name('/add-product-detail-page');
Route::get('/load-cart-count','ProductController@loadCountProduct')->name('/load-cart-count');
Route::get('/wish-count','ProductController@wishCountProduct')->name('/wish-count');

// =====category and brand product and section listing view====//
Route::get('category-products/{url}','ProductController@listing');
Route::get('/brand-products/{url}','ProductController@brandlisting');
Route::get('/section-products/{url}','ProductController@sectionListing');

//===========All Pages==========//
Route::get('/all-pages/{url_two}','WebsiteController@allPages');
Route::get('/store-product/view','WebsiteController@storeProductItmes');
Route::get('/all-brands/view','WebsiteController@brandProduct');
Route::get('/men-kits','WebsiteController@kitProduct');
//Route::get('/product-serach-filter-by-ajax','WebsiteController@filterProductAjax');


//=======Cart page====//
Route::get('product/cart-page/','ProductController@CartView')->name('product.cart-page');


Route::post('/user-newsletter-post','WebsiteController@addNewsletter');
//Ladystore site

Route::post('get-product-price-post','ProductController@getProductPrice');
Route::post('get-product-size-post','ProductController@getProductSize')->name('get-product-size-post');

//cart item update ajax

Route::post('update-cart-item','ProductController@updateCartItemQtyTwo')->name('update-cart-item');
Route::post('update-cart-item-two','ProductController@updateCartItemQty');
Route::post('delete-cart-item-qty','ProductController@cartItemDelete')->name('delete-cart-item-qty');
Route::post('product-alternative','ProductController@alternativeImage');

//===Product Filters====//
Route::post('get-rating','ProductController@rating');
Route::post('/get-body-type','ProductController@bodyType');
Route::post('/get-size-rating','ProductController@sizeRating');
Route::post('/get-height-rating','ProductController@heightRating');
Route::post('/get-fit-rating','ProductController@fitRating');
Route::post('/get-satple-color-image','ProductController@colorImage');
Route::post('/get-satple-size','ProductController@sizeWeight');
Route::post('/review-product-size','ProductController@ReviewProductSize');

//=====Side Bar Filters=====//

Route::post('/new-product-filter','ProductController@newProductFilter');
Route::post('/top-category-product-filter','ProductController@topProductFilter');
Route::post('/product-filter-name','ProductController@ProductFilterName');

//=====wish LIst function====//
Route::post('add-wishlist/','WishlistController@AddWishlist')->name('add-wishlist');
Route::get('user/wishlist','WishlistController@getWishlist')->name('user.wishlist');
Route::get('user/delete/wishlist/{id}','WishlistController@delete');

//product comment
Route::post('/check-user-post-comment-for-products','HomeController@SendComment');

//=====verify Pin Code===//

Route::post('/verify-pin-code','WebsiteController@verifyPinCode');
Route::post('/currency-view','ProductController@currencyView');

//====product image change====//
Route::post('/product-image-change','ProductController@changeProductImage');

Route::get('order/tracking', 'FrontController@OrderTracking')->name('order.tracking');

Route::post('order-now-quick','ProductController@customerAddtoCart');

//===Seasrch Products====//

Route::post('search-product', 'WebsiteController@productSearchlatest')->name('search-product');
Route::get('/get-products-value', 'WebsiteController@resultProduct');

//===========Website=========End Part============//










//Route::get('cart/product/view/{id}','CartController@ViewProduct');

Route::get('tearm-view','WebsiteController@tearm')->name('tearm-view');
Route::get('faq-view','WebsiteController@faq')->name('');
Route::get('shippingreturn-view','WebsiteController@shippingreturn')->name('shippingreturn-view');
Route::get('secureshipping-view','WebsiteController@secureshipping')->name('secureshipping-view');
Route::get('about-view','WebsiteController@about')->name('about-view');
Route::get('Help-view','WebsiteController@help')->name('Help-view');
Route::get('service-view','WebsiteController@service')->name('service-view');
Route::get('/contact-view','WebsiteController@contact')->name('contact-view');
Route::post('customer-pre-order','WebsiteController@contactStore')->name('');
Route::get('/','WebsiteController@index');
Route::get('/mobile','WebsiteController@mobile')->name('mobile');
Route::get('cart/product/view/{id}','WebsiteController@ViewProduct');
//website search

 //Route::post('/searching', 'FrontController@ProductSearchAjax')->name('searching');


//Route::get('/searchajax', 'FrontController@ProductSearchAjaxauto')->name('searchproductajax');
// Route::post('/searching', 'FrontController@result')->name('searching');
//search by ajax for products
//Route::post('/find-products','WebsiteController@searchAjax')->name('');
//payment methods



// contact
//Route::post('/contact','ContactController@store')->name('');
//blog routes

Route::get('blog/post','BlogController@blog')->name('blog.post');

Route::get('language/bangla','WebsiteController@Bangla')->name('language.bangla');
Route::get('language/english','WebsiteController@English')->name('language.english');


//home or single auth routes========================================

Route::get('/penalty', function () {return view('pages.index');});
//auth & user
Auth::routes(['verify' => true]);
//Route::get('/home', 'HomeController@index')->name('home');https://localhost/demo/admin-quickee-staff-login
// Route::get('/password/change', 'HomeController@changePassword')->name('password.change');
// Route::post('/password/update', 'HomeController@updatePassword')->name('password.update');
// Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======

// Route::get('admin-dashbord-home-stuffs', 'AdminController@index');
// Route::get('admin-quickee-staff-login', 'Admin\LoginController@showLoginForm')->name('admin.login');

// Route::post('admin-quickee-staff-login', 'Admin\LoginController@login');
// Route::get('admin-dashbord-chart-stuffs', 'AdminController@chartDashboard');

//Route::match(['get','post'],'user/forgot-password','UserController@forgotPassword');

        // Password Reset Routes...
// Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
// Route::get('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
// Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
// Route::get('admin-password/reset', 'Admin\ResetPasswordController@reset');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

     //admin section----------------

//categories--------
Route::get('for-quickee-ladystore-catgories', 'Admin\Category\CategoryController@catgory');
Route::get('admin/delete-category-image/{id}', 'Admin\Category\CategoryController@DeletecatgoryImage')->name('admin.delete-category-image');











//newslater
Route::get('for-admin-new-later-subs-criber', 'Admin\CouponController@Newslater');
Route::get('for-admin-new-later-subs-seo-delete/{id}','Admin\CouponController@DeleteSub');
Route::get('for-admin-new-later-subs-seo', 'Admin\CouponController@Seo');
Route::post('for-admin-new-later-subs-seo-update', 'Admin\CouponController@UpdateSeo');




//set Timer for products
Route::get('admin/sale-time-index', 'Admin\ProductController@timeIndex')->name('admin.sale-time-index');
Route::match(['get','post'],'admin/add-edit-sale-time/{id?}','Admin\ProductController@addEditTime');

//lady store Controller
//Route::get('for-ladystored-producted-for-all', 'Ladystore\LadystoreController@index');


//Partner routes

//Route::get('admin/delete-post-for-admin/{id}','Admin\PostController@destroy');


//order Invoice
Route::get('admin/view-order-invoice/{id}','Admin\OrderController@viewOrderInvoice');



//Delivery stuffs
Route::get('admin/deliveryman/stuff','Admin\DeliveryStuffController@index')->name('admin.deliveryman.stuff');
Route::match(['get','post'],'admin/add-delivery-stuff/{id?}','Admin\DeliveryStuffController@addEdit');

//orders routes
Route::get('admin/today/order', 'Admin\ReportController@TodayOrder')->name('today.order');
Route::get('admin/today/deleverd', 'Admin\ReportController@TodayDelevered')->name('today.delevered');
Route::get('admin/this/month', 'Admin\ReportController@ThisMonth')->name('this.month');
Route::get('admin/search/report', 'Admin\ReportController@search')->name('search.report');
Route::post('admin/search/byyear', 'Admin\ReportController@searchByYear')->name('search.by.year');
Route::post('admin/search/bymonth', 'Admin\ReportController@searchByMonth')->name('search.by.month');
Route::post('admin/search/bydate', 'Admin\ReportController@searchByDate')->name('search.by.date');


//user role
Route::get('for-ladystore-quickee-usered-account-disabled/{id}', 'Admin\ReportController@userStatusInactive');
Route::get('for-ladystore-quickee-usered-account-active/{id}', 'Admin\ReportController@userStatusActive');
Route::get('for-ladystore-quickee-create-role','Admin\ReportController@UserRole');
Route::get('for-ladystore-quickee-create','Admin\ReportController@UserCreate');
Route::post('for-ladystore-quickee-create-role-store', 'Admin\ReportController@UserStore');
Route::get('for-ladystore-quickee-create-role-edit-delete/{id}', 'Admin\ReportController@UserDelete');
Route::get('for-ladystore-quickee-create-role-edit/{id}', 'Admin\ReportController@UserEdit');
Route::post('for-ladystore-quickee-create-role-edit-update', 'Admin\ReportController@UserUpdate');







//frontedn all routesa are here--------
 Route::post('store/newslater', 'FrontController@StoreNewslater')->name('store.newslater');


 Route::post('cart-product-add', 'ProductController@AddCartProduct');



// Route::get('/product/cate_ligting_page/{id}','ProductController@productsView')->name('');

//return products admin panel
 Route::get('admin/return/request', 'Admin\ReturnController@request')->name('admin.return.request');
 Route::get('/admin/approve/return/{id}', 'Admin\ReturnController@ApproveReturn');
 Route::get('admin/all/return', 'Admin\ReturnController@AllReturn')->name('admin.all.return');






 //Bpti All routes for website

 //Route::post('product/search', 'FrontController@ProductSearch')->name('product.search');

//  Route::get('bpti/product/search', 'FrontController@searchProducts')->name('bpti.product.search');
//  Route::get('bpti/product-cars', 'FrontController@getBpti')->name('bpti.product-car');

 //Bpti form submit
 //Route::post('bpti-form-for-users','FrontController@Bptiform');
 Route::get('user/thank_page','FrontController@ThankPage');

//product comment from users
 Route::get('admin/get-comment-for-admin-index','Admin\CommentController@addComment');
 Route::match(['get','post'],'admin/get-customer-comment-replay-post/{id?}','Admin\CommentController@commentReplay');

 //Route::post('product/search', 'FrontController@ProductSearchAjax')->name('product.search');
//customer profile related routes

//user login for new customer
//Route::get('user/login-registers',['as'=>'login','uses'=>'UserController@loginRegister']);
Route::get('user/login-registers',['as'=>'login','uses'=>'UserController@loginRegister']);
Route::post('login-user','UserController@loginUser');
Route::post('user/register-user','UserController@registeruser');
Route::match(['get','post'],'check-email','UserController@checkEmail');






// Route::get('admin/index-infornmation-ticket-view-comment/{id}','Admin\FlygarController@flygarIndexAddGet');
// Route::post('admin/index-infornmation-ticket-view-comment-post','Admin\FlygarController@flygarIndexAddPost');

Route::match(['get','post'],'admin/index-infornmation-ticket-view-comment-post/{id?}','Admin\FlygarController@flygarIndexAddPost');

//Happy Member for admin
Route::get('admin/for-happy-member-information-list','Admin\HappyMemberController@happyIndex');
Route::get('admin/for-happy-member-information-list-invoice/{id}','Admin\HappyMemberController@happyIndexInvoice');






//Route::get('user/home', 'HomeController@index')->name('user.home');

//customer dashboard
// Route::get('/password/change', 'HomeController@changePassword')->name('password.change');
// Route::post('/password/update', 'HomeController@updatePassword')->name('password.update');

//first login for New Customer forget and confirm password
Route::match(['get','post'],'user/forgot-password','UserController@forgotPassword');
Route::match(['get','post'],'user/confirm/{code}','UserController@confirmAccount');


Route::get('user/happy-member-client-form', 'HappyMemberController@indexMember');
//customer middleware
Route::group(['middleware'=>['auth']],function(){
    Route::get('/customer/dashboard','HomeController@index')->name('')->name('customer.dashboard');
    Route::get('/customer/orders','HomeController@order');
    Route::get('/customer/orders-show/{id}','HomeController@orderShow');
    Route::get('/customer/orders-invoice/{id}','HomeController@viewOrderInvoice');
    Route::post('/check-user-pwd','HomeController@CheckPassword');
    Route::post('/check-user-pwd-update','HomeController@UpdatePassword');
    Route::post('check-user-review-post','HomeController@addReview');
    Route::match(['get','post'],'check-user-review-update/{id}','HomeController@updateReview');
    Route::match(['get','post'],'user-billing-address-update/{id}','HomeController@billingAddress');
    Route::get('/user/logout', 'HomeController@logout');
    Route::post('/user-profile-update', 'HomeController@profileUpdate');
    //Confirm Accountcustomer-order-return-product
   //apply coupon
    Route::post('apply-coupon-code','ProductController@ApplyCoupon')->name('apply-coupon-code');
    //check out page for customer
    
    //shipping address for customer
    Route::match(['get','post'],'customer/user/checkout-pages','ProductController@Checkout');
    Route::match(['get','post'],'user/add-edit-shipping-address/{id?}','ProductController@addEditShipping');
    
   //forgot password for user
    Route::get('user/delete-shipping-address/{id}','ProductController@deleteShipping');
    //thanks pages
    Route::get('user/thanks-pages','ProductController@thankPages');
    //Happpy member form
    Route::get('user/happy-member-client-form', 'HappyMemberController@indexMember');
    Route::get('user/happy-member-client-form-print', 'HappyMemberController@indexMemberPrint');
    Route::post('user/happy-member-client-form','HappyMemberController@happyMember');
   
    //paypal Account

    //return list for customer
    Route::get('user/customer/return','HomeController@returnList')->name('success.orderlist');
    Route::match(['get','post'],'customer-order-return-product/{id}','HomeController@RequestReturn');
    
    // product cancel
    Route::match(['get','post'],'customer-order-cancel/{id}','HomeController@cancelOrder');
    Route::post('customer/addtocart','HomeController@customerAddtoCart')->name('customer/addtocart');
    Route::post('user/remove/wishlist/','WishlistController@removeWishlist')->name('user/remove/wishlist');
    
    // product Excahnge by ajax
    Route::post('exchange-product-size','HomeController@exchangeProduct');
    Route::post('exchange-products/{id}','HomeController@exchangeProductSubmit');
    
    // ======Payment Gateway success====//
    
    // Route::post('/success','ProductController@success')->name('success');
    // Route::post('/fail','ProductController@fail')->name('fail');
    // Route::get('/success',function(){
    //     return redirect()->to('/');
    // })->name('cancel');
    
    //paypal controller
    Route::get('/paypal','PaypalController@paypal');
    Route::post('/pay','PaypalController@pay')->name('payment');
    Route::get('/success','PaypalController@success');
    Route::get('/error','PaypalController@error');
    
    
    //======SSL Ecommerce=====//
    // Route::get('/ssl', [SslCommerzPaymentController::class, 'ssl']);
    // Route::post('/pay-via-ajax',[SslCommerzPaymentController::class,'payViaAjax']);
    // Route::post('/success',[SslCommerzPaymentController::class,'paymentSuccess']);
    // Route::post('/fail',[SslCommerzPaymentController::class,'fail']);
    // Route::post('/cancel',[SslCommerzPaymentController::class,'cancel']);
    // Route::post('/ipn',[SslCommerzPaymentController::class,'ipn']);
    
      //====order now===//
   

    Route::match(['get', 'post'], '/PaymentSuccess', 'ProductController@PaymentSuccess'); 
    Route::get("/PaymentCancel",'ProductController@PaymentCancel');
    Route::match(['get','post'],"/PaymentFail",'ProductController@PaymentFail');

 
    
    
});

   




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
