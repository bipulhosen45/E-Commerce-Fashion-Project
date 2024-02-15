<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CampaignProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');
// Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::middleware('is_admin')->group( function () {
    Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/password/change', [AdminController::class, 'passwordChange'])->name('admin.password.change');
    Route::post('/admin/password/update', [AdminController::class, 'passwordUpdate'])->name('admin.password.update');

    //Category routes
    Route::group(['prefix'=>'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
        // Route::get('/show', [CategoryController::class, 'show'])->name('category.show');
    });

    //Global route
    Route::get('/get-child-category/{id}', [CategoryController::class, 'GetChildCategory']);

    //SubCategory routes
    Route::group(['prefix'=>'subcategory'], function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('subcategory.index');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.delete');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit']);
        Route::post('/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
    });
    //ChlidCategory routes
    Route::group(['prefix'=>'childcategory'], function () {
        Route::get('/', [ChildcategoryController::class, 'index'])->name('childcategory.index');
        Route::post('/store', [ChildcategoryController::class, 'store'])->name('childcategory.store');
        Route::get('/delete/{id}', [ChildcategoryController::class, 'destroy'])->name('childcategory.delete');
        Route::get('/edit/{id}', [ChildcategoryController::class, 'edit']);
        Route::post('/update', [ChildCategoryController::class, 'update'])->name('childcategory.update');
    });
    //Brand routes
    Route::group(['prefix'=>'brand'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
        Route::get('/edit/{id}', [BrandController::class, 'edit']);
        Route::post('/update', [BrandController::class, 'update'])->name('brand.update');
    });
    //warehouse routes
    Route::group(['prefix'=>'warehouse'], function () {
        Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
        Route::post('/store', [WarehouseController::class, 'store'])->name('warehouse.store');
        Route::get('/delete/{id}', [WarehouseController::class, 'destroy'])->name('warehouse.delete');
        Route::get('/edit/{id}', [WarehouseController::class, 'edit']);
        Route::post('/update', [WarehouseController::class, 'update'])->name('warehouse.update');
    });
    //coupon routes
    Route::group(['prefix'=>'coupon'], function () {
        Route::get('/', [CouponController::class, 'index'])->name('coupon.index');
        Route::post('/store', [CouponController::class, 'store'])->name('coupon.store');
        Route::delete('/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');
        Route::get('/edit/{id}', [CouponController::class, 'edit']);
        Route::post('/update', [CouponController::class, 'update'])->name('coupon.update');
    });
    //Campaign routes
    Route::group(['prefix'=>'campaign'], function(){
		Route::get('/',[CampaignController::class, 'index'])->name('campaign.index');
		Route::post('/store',[CampaignController::class, 'store'])->name('campaign.store');
		Route::delete('/delete/{id}',[CampaignController::class, 'destroy'])->name('campaign.delete');
		Route::get('/edit/{id}',[CampaignController::class, 'edit']);
		Route::post('/update',[CampaignController::class, 'update'])->name('campaign.update');
	});

    //__campaign product routes__//
	Route::group(['prefix'=>'campaign-product'], function(){
		Route::get('/{campaign_id}',[CampaignProductController::class, 'index'])->name('campaign.product');
		Route::get('/add/{id}/{campaign_id}',[CampaignProductController::class, 'ProductAddToCampaign'])->name('add.product.to.campaign');
		Route::get('/list/{campaign_id}',[CampaignProductController::class, 'ProductListCampaign'])->name('campaign.product.list');
		Route::get('/remove/{id}',[CampaignProductController::class, 'RemoveProduct'])->name('product.remove.campaign');
		
	});

    //Product routes
    Route::group(['prefix'=>'product'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update', [ProductController::class, 'update'])->name('product.update');
        Route::get('/active-featured/{id}', [ProductController::class, 'activefeatured']);
        Route::get('/not-featured/{id}', [ProductController::class, 'notfeatured']);
        Route::get('/active-today-deal/{id}', [ProductController::class, 'activetodaydeal']);
        Route::get('/not-today-deal/{id}', [ProductController::class, 'nottodaydeal']);
        Route::get('/active-status/{id}', [ProductController::class, 'activestatus']);
        Route::get('/not-status/{id}', [ProductController::class, 'notstatus']);
    });

      //order routes
      Route::group(['prefix'=>'order'], function(){
		Route::get('/',[OrderController::class, 'index'])->name('admin.order.index');
		Route::get('/admin/edit/{id}',[OrderController::class, 'editOrder']);
		Route::get('/view/admin/{id}',[OrderController::class, 'OrderView']);
		Route::post('/update/order/status',[OrderController::class, 'updateStatus'])->name('update.order.status');
        Route::delete('/delete/{id}',[OrderController::class, 'delete'])->name('order.delete');
	});
      //Blog Category routes
      Route::group(['prefix'=>'blog-category'], function(){
		Route::get('/',[BlogController::class, 'index'])->name('admin.blog.category');
		Route::post('/store',[BlogController::class, 'store'])->name('blog.category.store');
        Route::get('/delete/{id}',[BlogController::class, 'destroy'])->name('blog.category.delete');
		Route::get('/edit/{id}',[BlogController::class, 'edit']);
		Route::post('/update',[BlogController::class, 'update'])->name('blog.category.update');
	});
      //Blog routes
    Route::group(['prefix'=>'blog'], function(){
		Route::get('/',[BlogController::class, 'index'])->name('admin.blog.index');;
	});

    //Contact route
    Route::group(['prefix'=>'contact'], function(){
		Route::get('/',[ContactController::class, 'index'])->name('admin.contact.index');
		Route::post('/reply/contact',[ContactController::class, 'ReplyContact'])->name('admin.contact.reply');
		Route::get('/show/{id}',[ContactController::class, 'show'])->name('admin.contact.show');
        Route::get('/delete/{id}',[ContactController::class, 'destroy'])->name('contact.delete');
	});

    //__Order Report route
      Route::group(['prefix'=>'report'], function(){
		Route::get('/order',[OrderController::class, 'Reportindex'])->name('report.order.index');
		Route::get('/order/print',[OrderController::class, 'ReportOrderPrint'])->name('report.order.print');
	});

  


    //Setting routes
    Route::group(['prefix'=>'setting'], function () {
            //Seo setting routes
            Route::group(['prefix'=>'seo'], function () {
                Route::get('/', [SettingController::class, 'seo'])->name('seo.setting');
                Route::post('/update/{id}', [SettingController::class, 'seoUpdate'])->name('seo.setting.update');
            });
            //SMPT setting routes
            Route::group(['prefix'=>'smpt'], function () {
                Route::get('/', [App\Http\Controllers\Admin\SettingController::class, 'smpt'])->name('smpt.setting');
                Route::post('/update/{id}', [App\Http\Controllers\Admin\SettingController::class, 'smptUpdate'])->name('smpt.setting.update');
            });
            //website setting routes
            Route::group(['prefix'=>'website'], function () {
                Route::get('/', [SettingController::class, 'website'])->name('website.setting');
                Route::post('/update/{id}', [SettingController::class, 'websiteUpdate'])->name('website.setting.update');
            });

            //payment gateway setting routes
            Route::group(['prefix'=>'payment-gateway'], function () {
                Route::get('/', [SettingController::class, 'PaymentGateway'])->name('payment.gateway');
                Route::post('/aamarpay/update', [SettingController::class, 'AamarpayUpdate'])->name('aamarpay.update');
                Route::post('/surjopay/update', [SettingController::class, 'SurjopayUpdate'])->name('surjopay.update');
                Route::post('/ssl/update', [SettingController::class, 'SslUpdate'])->name('ssl.update');
            });

            //Page setting routes
            Route::group(['prefix'=>'page'], function () {
                Route::get('/', [PageController::class, 'index'])->name('page.index');
                Route::get('/create', [PageController::class, 'create'])->name('page.create');
                Route::post('/store', [PageController::class, 'store'])->name('page.store');
                Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
                Route::post('/update/{id}', [PageController::class, 'pageUpdate'])->name('page.update');
                Route::get('/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
            });



            //Pickup Point routes
            Route::group(['prefix'=>'pickup-point'], function () {
                Route::get('/', [PickupController::class, 'index'])->name('pickuppoint.index');
                // Route::get('/create', [PickupController::class, 'create'])->name('pickuppoint.create');
                Route::post('/store', [PickupController::class, 'store'])->name('pickuppoint.store');
                Route::get('/edit/{id}', [PickupController::class, 'edit']);
                Route::post('/update', [PickupController::class, 'update'])->name('pickuppoint.update');
                Route::delete('/delete/{id}', [PickupController::class, 'destroy'])->name('pickup.point.delete');
            });

            //ticket Point routes
            Route::group(['prefix'=>'ticket'], function () {
                Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
                Route::get('/show/{id}', [TicketController::class, 'show'])->name('admin.ticket.show');
                Route::post('/reply/store', [TicketController::class, 'AdminReplystore'])->name('admin.store.reply');
                Route::get('/close/{id}', [TicketController::class, 'TicketClose'])->name('admin.close.ticket');
                Route::delete('/delete/{id}', [TicketController::class, 'destroy'])->name('admin.ticket.delete');
            });

              //__Role route
            Route::group(['prefix'=>'role'], function(){
                Route::get('/',[RoleController::class, 'index'])->name('manage.role');
                Route::get('/create',[RoleController::class, 'create'])->name('create.role');
                Route::get('/store',[RoleController::class, 'store'])->name('store.role');
                Route::get('/edit/{id}',[RoleController::class, 'edit'])->name('role.edit');
                // Route::get('/show/{id}',[RoleController::class, 'show'])->name('admin.contact.show');
                Route::get('/delete/{id}',[RoleController::class, 'destroy'])->name('role.delete');
            });

    });
});