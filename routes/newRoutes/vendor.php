<?php

use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\OrderController;

Route::group(['middleware' => ['vendor-auth','verified'], 'prefix' => 'vendor'], function () {
    Route::get('/dashboard', [VendorDashboardController::class, 'dashboard'])->name('vendor.dashboard');
    Route::get('/product/index', [ProductController::class, 'index'])->name('vendor.product.index');
    Route::post('/product/store', [ProductController::class, 'store'])->name('vendor.product.store');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('vendor.product.delete');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('vendor.product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('vendor.product.update');
    Route::get('/product/create', [ProductController::class, 'create'])->name('vendor.product.create');
   
   
    Route::get('/profile', [ProfileController::class, 'profile'])->name('vendor.profile');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('vendor.profile.update');
    Route::get('/profile/edit_password', [ProfileController::class, 'changePasswordIndex'])->name('vendor.password.index');
    
    //vendor route  //user detail
    Route::get('/details', [UserDetailController::class, 'getAdminVendorUserDetail'])->name('vendor.detail');

        //for order handling
    
        Route::get('/order/pending',[OrderController::class,'vendorPendingOrders'])->name('vendor.order.pending');
        Route::get('/order/processed',[OrderController::class,'vendorProcessedOrders'])->name('vendor.order.processed');
    
    // //user detail
    // Route::get('/details', [UserDetailController::class, 'getVendorUserDetail'])->name('vendor.detail');
    

});