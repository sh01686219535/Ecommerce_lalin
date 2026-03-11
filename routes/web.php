<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;


// frontend start
Route::get('/', [FrontendController::class, 'home'])->name('home')->middleware('clear.cart');;

Route::get('/frontend-login', [FrontendController::class, 'login'])->name('frontend.login');
Route::get('/frontend-register', [FrontendController::class, 'register'])->name('frontend.register');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
// //=============Order ==============//
Route::post('/frontend-order/{id}', [OrderController::class, 'order'])->name('frontend.order');
//========Contact=======================//
Route::post('/contact-store', [ContactController::class, 'contactStore'])->name('contact.store');
//property details
Route::get('/product/details/{id}',[ProductController::class,'productDetails'])->name('product.details');
//================Order=================//
Route::get('/order/{id}',[OrderController::class,'order'])->name('order');
Route::post('/user/order/{id}',[OrderController::class,'userOrder'])->name('user.order');
//================Order Cart=================//
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/cart-count', function() {
    $cart = session('cart', []);
    $cartCount = array_sum(array_column($cart, 'qty'));
    $cartTotal = array_sum(array_column($cart, 'total_price'));
    return response()->json(['cartCount' => $cartCount, 'cartTotal' => $cartTotal]);
});
//================User Login=================//
Route::get('/user-view',[FrontendController::class,'userView'])->name('user.view');
//======== Frontend route end=============//
//===========AJAX==============//
Route::get('/get-subcategories/{category_id}',  [SubCategoryController::class, 'getSubCategory'])->name('get.subcategories');
Route::get('/get-subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
Route::get('/get-childcategories/{subcategory_id}', [ProductController::class, 'getChildCategories']);
require __DIR__ . '/vendor.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';