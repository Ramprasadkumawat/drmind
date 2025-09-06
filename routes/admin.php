<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AddProductController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\ProductSubscription;
use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\User\LevelMemberController;

Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::resource('add-product', AddProductController::class)->names([
        'index' => 'add-product',
        'create' => 'add-product.create',
        'store' => 'add-product.store',
        'show' => 'add-product.show',
        'edit' => 'add-product.edit',
        'update' => 'add-product.update',
        'destroy' => 'add-product.destroy',
    ]);

    Route::post('/productImageDelete',[AddProductController::class,'productImageDelete']);
    Route::post('/productImageUpdate',[AddProductController::class,'productImageUpdate']);

    Route::get('add-product/getsubcategory/{id}', [AddProductController::class, 'getsubcategory'])->name('add-product.getsubcategory');
    Route::get('allProducts',[AddProductController::class, 'allProducts'])->name('allProducts');
    Route::get('e-products',[AddProductController::class, 'eProducts'])->name('eProducts');

    Route::get('product-subscription',[ProductSubscription::class,'addSubscriptionProduct'])->name('add-product-subscription');
    Route::post('create-product-subscrption',[ProductSubscription::class,'createProductSubscription'])->name('create-subscription-product.store');
    Route::get('all-subscription-products',[ProductSubscription::class,'allSubscriptionProducts'])->name('admin.view.subscription');

    Route::resource('categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'show' => 'categories.show',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy'
    ]);
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::get('subcategory',[CategoryController::class, 'subcategoryCreate'])->name('subcategory.create');
    Route::get('subcategory/{id}',[CategoryController::class, 'subcategoryCreate'])->name('subcategory.edit');
    Route::get('subcategory.delete/{id}',[CategoryController::class, 'subcategorydestroy'])->name('subcategory.delete');
    Route::post('subcategory',[CategoryController::class, 'subcategoryStore'])->name('subcategory.store');

    Route::resource('pages', PageController::class)->names([
        'index' => 'pages.index',
        'create' => 'pages.create',
        'store' => 'pages.store',
        'show' => 'pages.show',
        'edit' => 'pages.edit',
        'update' => 'pages.update',
        'destroy' => 'pages.destroy',
    ]);

    Route::put('pages/{page}/publish', [PageController::class, 'publish'])->name('pages.publish');

    Route::get('order-history', function () {
        $heading="Order History";
        return view('admin.ecommerce.order_history',compact('heading'));
    });

    Route::get('users-list',[UsersController::class, 'index']);
    Route::get('/user-referral/{referral_code}', [UsersController::class, 'getHierarchy']);
    Route::get('referral-tree', [UsersController::class, 'tree']);

    Route::get('userslevel-list/{referral_code?}', [UsersController::class, 'getHierarchy'])->name('users.level_view');

    Route::get('mngt-report', function () {
        $heading="MNGT Report";
        return view('admin.mngt.mngt_reports',compact('heading'));
    });

    Route::get('/broadcasts',[BroadcastController::class, 'index'])->name('broadcasts.index');
    Route::post('/create-broadcasts',[BroadcastController::class, 'store'])->name('broadcast.store');
    Route::get('delete/{id}', [BroadcastController::class, 'delete'])->name('broadcast.delete');

    Route::get('/testimonials-create',[TestimonialController::class,'create']);
    Route::get('/testimonials-create/{id}',[TestimonialController::class,'create'])->name('testimonials-edit');
    Route::post('/upload-testimonial-image', [TestimonialController::class, 'uploadImage']);
    Route::post('/testimonial-store',[TestimonialController::class,'store'])->name('testimonial.store');
    Route::get('/testimonials-list',[TestimonialController::class,'index']);

    Route::get('/blogs-list',[BlogController::class,'list'])->name('blogs-list');
    Route::get('/blog-create',[BlogController::class,'createPage'])->name('blog-create');
    Route::post('blog.store',[BlogController::class,'store'])->name('blog.store');

    Route::get('/userslevel-list2', [LevelMemberController::class, 'index'])->name('admin.user.level_members');
    Route::get('/level-members/tree', [LevelMemberController::class, 'showTree'])->name('admin.user.tree_view');
});
