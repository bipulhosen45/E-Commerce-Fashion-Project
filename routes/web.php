<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\HomeController;
use Gloudemans\Shoppingcart\Facades\Cart;
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
Route::get('/login',function(){
    return redirect()->to('/');
})->name('login');


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [HomeController::class, 'logout'])->name('customer.logout');

//all fronted route====================
Route::group(['namespace'=>'App\Http\Controllers\Front'], function(){
    Route::get('/', [IndexController::class, 'index']);
    Route::get('/product-details/{slug}', [IndexController::class, 'ProductDetails'])->name('product.details');
    
    Route::get('/product-quick-view/{id}',[IndexController::class, 'ProductQuickView']);
    //review for product
     Route::post('/store/review',[ReviewController::class, 'store'])->name('review.store');
     //review for website not product
     Route::get('/write/review',[ReviewController::class, 'writeReview'])->name('write.review');
     Route::post('/store/website/review',[ReviewController::class, 'storeWebsiteReview'])->name('store.website.review');
    
     //cart routes
     Route::post('/addtocart',[CartController::class, 'AddToCartQV'])->name('add.to.cart.quickview');
     Route::get('/cartproduct/remove/{rowId}',[CartController::class, 'RemoveProdut']);
     Route::get('/cartproduct/updateqty/{rowId}/{qty}',[CartController::class, 'UpdateQty']);
     Route::get('/cartproduct/updatecolor/{rowId}/{color}',[CartController::class, 'UpdateColor']);
     Route::get('/cartproduct/updatesize/{rowId}/{size}',[CartController::class, 'UpdateSize']);
     Route::get('/mycart',[CartController::class, 'MyCart'])->name('cart');


     Route::get('/cart/empty',[CartController::class, 'EmptyCart'])->name('cart.empty');
     Route::get('/all-cart',[CartController::class, 'AllCart'])->name('all.cart');

     //checkout route
     Route::get('/checkout',[CheckoutController::class, 'checkout'])->name('checkout');
     Route::post('/apply/coupon',[CheckoutController::class, 'ApplyCoupon'])->name('apply.coupon');
     Route::get('/remove/coupon',[CheckoutController::class, 'RemoveCoupon'])->name('coupon.remove');
     Route::post('/order/place',[CheckoutController::class, 'OrderPlace'])->name('order.place');

// wishlist routes
     Route::get('/wishlist',[CartController::class, 'wishlist'])->name('wishlist');
     Route::get('/clearwishlist',[CartController::class, 'Clearwishlist'])->name('clear.wishlist');
     Route::get('/add/wishlist/{id}',[CartController::class, 'addWishlist'])->name('add.wishlist');
     Route::get('/wishlistproduct/delete/{id}',[CartController::class, 'WishlistProductdelete'])->name('wishlistproduct.delete');
     
     //category wise product
     Route::get('/category/product/{id}',[IndexController::class, 'categorywiseProduct'])->name('categorywise.product');
     Route::get('/subcategory/product/{id}',[IndexController::class, 'subcategorywiseProduct'])->name('subcategorywise.product');
     Route::get('/childcategory/product/{id}',[IndexController::class, 'childcategorywiseProduct'])->name('childcategorywise.product');
     Route::get('/brand/product/{id}',[IndexController::class, 'brandwiseProduct'])->name('brandwise.product');
     
     //setting profile
     Route::get('/home/setting',[ProfileController::class, 'customerSetting'])->name('customer.setting');
     Route::post('/home/shipping/{id}',[ProfileController::class, 'shippingupdate'])->name('shipping.update');
     Route::post('/home/password/change',[ProfileController::class, 'customerPasswordChange'])->name('customer.password.change');

    //order route
     Route::get('/my/order',[ProfileController::class, 'Myorder'])->name('my.order');
     Route::get('/view/order/{id}', [ProfileController::class, 'ViewOrder'])->name('view.order'); 

     // order tracking
     Route::get('/order/tracking', [IndexController::class, 'OrderTracking'])->name('order.tracking'); 
     Route::post('/check/order', [IndexController::class, 'CheckOrder'])->name('check.order'); 

     //view page
     Route::get('/page/{slug}',[IndexController::class, 'ViewPage'])->name('view.page');

     //view page
     Route::post('/newsletter',[IndexController::class, 'newsletterstore'])->name('newsletter.store');
     
     //support ticket
     Route::get('/open/ticket',[ProfileController::class, 'OpenTicket'])->name('open.ticket');
     Route::get('/new/ticket',[ProfileController::class, 'NewTicket'])->name('new.ticket');
     Route::post('/store/ticket',[ProfileController::class, 'StoreTicket'])->name('store.ticket');
     Route::get('/show/ticket/{id}',[ProfileController::class, 'ShowTicket'])->name('show.ticket');
     
     Route::post('/reply/ticket',[ProfileController::class, 'ReplyTicket'])->name('reply.ticket');

     //__payment_gateway
     Route::post('success',[CheckoutController::class,'success'])->name('success');
     Route::post('fail',[CheckoutController::class,'fail'])->name('fail');
     Route::get('cancel',[CheckoutController::class,'cancel'])->name('cancel');


     //__Blog & contact
     Route::get('/contact-us',[IndexController::class, 'Contact'])->name('contact');
     Route::post('/contact/store',[IndexController::class, 'ContactStore'])->name('contact.store');

     Route::get('/our-blog',[IndexController::class,'Blog'])->name('blog');
     Route::get('/single/blog/{slug}',[IndexController::class,'BlogDetails'])->name('blog.details');
// __Campaign __//
     Route::get('/campaign/products/{id}',[IndexController::class, 'CampaignProduct'])->name('frontend.campaign.product');
     Route::get('/campaign/products/details/{slug}',[IndexController::class, 'CampaignProductDetails'])->name('campaign.product.details');
     
});
    //Socialiate
    Route::get('oauth/{driver}',[LoginController::class,'redirectToProvider'])->name('social.oauth');
    Route::get('oauth/{driver}/callback',[LoginController::class,'handleProviderCallback'])->name('social.callback');

    


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
