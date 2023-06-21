<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Profile\ProfileController;


Route::group(['middleware'=>['admin-auth'],'prefix' => 'admin'],function(){
    
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('/slider', SliderController::class);
    Route::resource('/product_size', SizeController::class);
    Route::get('/pending_vendor',[VendorController::class,'pendingVendors'])->name('vendor.pending');
    Route::get('/approved_vendors',[VendorController::class,'approvedVendors'])->name('vendor.approved');
    Route::get('/approve/{id}',[VendorController::class,'approve'])->name('vendor.pending.approve');
    Route::put('/reject/{id}',[VendorController::class,'reject'])->name('vendor.pending.reject');
    Route::get('/vendor/status/{id}',[VendorController::class,'check_status_vendor'])->name('vendor.status');

    //for profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('admin.profile');
    Route::get('/profile/edit_password', [ProfileController::class, 'changePasswordIndex'])->name('admin.password.index');
    
    //for order handling
    
    Route::get('/order/pending',[OrderController::class,'adminPendingOrders'])->name('admin.order.pending');
    Route::get('/order/processed',[OrderController::class,'adminProcessedOrders'])->name('admin.order.processed');
     
    //  //user detail
    //  Route::get('/details', [UserDetailController::class, 'getAdminUserDetail'])->name('admin.detail');
    //admin or vendor route  //user detail
    Route::get('/details', [UserDetailController::class, 'getAdminVendorUserDetail'])->name('admin.detail');

    //for change the cart status
    Route::post('/cart/status/change',[CartController::class,'cartStatusChange'])->name('cart.status.change');
    
    // product items of each vendor
    Route::get('/product_items',[VendorController::class,'getAllProductItems'])->name('admin.product.items');

    
    // Route::get('/vendor/active/{id}',[VendorController::class,'active_vendor'])->name('vendor.active');
});