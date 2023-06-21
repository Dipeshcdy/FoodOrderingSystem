<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\CartController;
// use App\Http\Controllers\MainController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\Client\RestaurantController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Socialite\GoogleController;
use App\Http\Controllers\Profile\ProfileController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[MainController::class,'index'])->name('main');

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/restaurants', [MainController::class, 'restaurant'])->name('restaurant');
Route::get('/restaurant/index/{id}', [RestaurantController::class, 'index'])->name('restaurant.index');
Route::get('/cart_items', [CartController::class, 'cartItem'])->name('cartItem')->middleware('auth');
Route::post('/checked_out', [CartController::class, 'checked_out'])->name('cart.checked_out')->middleware('auth');


//socialite route
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('redirectToGoogle');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


//user details
 Route::get('/user/detail',[UserDetailController::class,'getUserDetail'])->name('user.detail');
 Route::post('/user/detail',[UserDetailController::class,'addUserDetail'])->name('user.detail.add');
 Route::delete('/user/detail/{id}',[UserDetailController::class,'deleteUserDetail'])->name('user.detail.delete');
 Route::post('/user/detail/update',[UserDetailController::class,'updateUserDetail'])->name('user.detail.update');
//  Route::post('/user/detail',)

//profile
Route::get('/profile', [ProfileController::class, 'clientProfile'])->name('client.profile');
Route::get('/profile/edit_password', [ProfileController::class, 'clientChangePasswordIndex'])->name('client.password.index');


//password change
Route::put('/profile/password_change/{id}', [ProfileController::class, 'changePassword'])->name('password.change');

// for search vendor and products

Route::get('/search',[MainController::class,'search'])->name('search');