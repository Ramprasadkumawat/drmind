<?php
use App\Http\Controllers\Authentication;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MakePaymentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionHistoryController;
use App\Http\Controllers\BroadcastController;

Route::get('/',[HomeController::class, 'index'])->name('home.index');
Route::get('/signup', [HomeController::class, 'signup'])->name('user.signup');
Route::post('/createAccount',[HomeController::class, 'createAccount'])->name('user.signup.account.create');
Route::get('/user-login', [HomeController::class, 'login'])->name('user.login');
Route::post('/userpost-login',[Authentication::class,'UserLogin'])->name('user.account-login');
Route::get('/home-broadcast',[HomeController::class,'broadcast'])->name('home.broadcast');
Route::get('/subscriptionproducts', [HomeController::class, 'subscriptionProducts'])->name('user.view.subscription');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials-view');
Route::get('/testimonials/{slug}', [HomeController::class, 'testimonials'])->name('testimonials-page-with-url');
Route::get('/blogs',[HomeController::class,'blogs'])->name('home.blogs');
Route::get('/blogs/{slug}',[HomeController::class,'blogsdetails'])->name('home.blog-details');
Route::get('/about-us', [HomeController::class, 'AboutUs'])->name('home.about.us');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/faq', [HomeController::class, 'faq'])->name('home.faq');
Route::middleware('auth')->group(function () {
    Route::get('/user-dashboard', [DashboardController::class, 'index'])->name('user-dashboard');
    Route::get('/userProfile', [DashboardController::class, 'profile'])->name('user.profile');
    Route::post('/userProfile', [DashboardController::class, 'profileUpdate'])->name('user.profile.update');
    Route::get('/userSettings', [DashboardController::class, 'settings'])->name('user.setting');
    Route::post('/userSettings', [DashboardController::class, 'settingsUpdate'])->name('user.setting');
    Route::get('/userLogout', [Authentication::class, 'logout'])->name('user.logout');
    Route::post('/addToCart', [CartController::class, 'addToCart'])->name('user.addToCart');
    Route::get('/cartProducts', [CartController::class, 'cartProducts'])->name('cart.show');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/remove-item', [CartController::class, 'removeItem'])->name('cart.removeItem');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/checkout', [MakePaymentController::class, 'processCheckout'])->name('cart.processCheckout');

    Route::get('/test',[MakePaymentController::class,'CreateEarningReport']);
    
    Route::get('/checkout/success', function () {
        if (session()->pull('checkout_success_shown', false)) {
            return redirect()->route('home.index');
        }
        session(['checkout_success_shown' => true]);
        return app(MakePaymentController::class)->checkoutSuccess(request());
    })->name('checkout.success');
    Route::get('/checkout/cancel', [MakePaymentController::class, 'checkoutCancel'])->name('checkout.cancel');

    Route::get('/orders',[OrderController::class,'Orders'])->name('user.orders');
    Route::get('invoice/{order_id}',[OrderController::class,'invoice'])->name('order.invoice');

    // subscription routes
    Route::post('/subscribe', [SubscriptionController::class, 'createCheckoutSession'])->name('subscribe');
    Route::get('/subscribe/success', [SubscriptionController::class, 'success'])->name('subscribe.success');
    Route::get('/subscribe/cancel', [SubscriptionController::class, 'cancel'])->name('subscribe.cancel');
    Route::get('/subscription/cancel-now', [SubscriptionController::class, 'cancelSubscription'])->name('subscription.cancel');


    Route::get('/subscription/history', [SubscriptionHistoryController::class, 'subscriptionHistory'])->name('subscription.history');

    Route::get('user/broadcasts',[BroadcastController::class,'UserBroadcast']);
    Route::post('user/broadcast/store',[BroadcastController::class,'store'])->name('user.broadcast.store');
    
});
Route::get('user/boradcast/sharing/{id}',[BroadcastController::class,'show'])->name('broadcast.show');

Route::get('/products', [ProductsController::class, 'products'])->name('products.allproduct');
Route::get('/product/{slug}', [ProductsController::class, 'productDetails'])->name('products.productDetails');
Route::get('subscription/{slug}', [ProductsController::class, 'subscriptionDetails'])->name('products.subscriptionDetails');
//Route::stripeWebhooks('/stripe/webhook');
Route::get('/category/{slug}', [ProductsController::class, 'productsByCategory'])->name('products.by.category');
