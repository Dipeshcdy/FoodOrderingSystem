<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::
Route::group(["middleware"=>"auth:api"],function(){
    Route::get("add-to-cart/{product_id}",[CartController::class,'addToCart']);
    Route::get("admin/order/pending/item/{cart_id}",[OrderController::class,'adminPendingOrdersItem']);
    Route::get("vendor/order/pending/item/{cart_id}",[OrderController::class,'vendorPendingOrdersItem']);
    
    //cart product quantity update
    Route::put("cart-items/quantity/update/{id}",[CartController::class,'cartItemQuantityUpdate']);
});

//admin pending order items view api