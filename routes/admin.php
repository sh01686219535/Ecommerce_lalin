<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;


//admin route
Route::middleware('admin')->prefix('admin')->group(function(){
    Route::get('dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::prefix('admin')->group(function(){
    Route::get('login',[AdminController::class,'login'])->name('admin.login');
    Route::post('login-store',[AdminController::class,'adminloginStore'])->name('admin.login.store');
    Route::get('logout',[AdminController::class,'AdminLogout'])->name('admin.logout');
    //==============Product===============//
    Route::resource('product', ProductController::class);
    //==============Category==============//
    Route::resource('category',CategoryController::class);
    //==============subCategory==============//
    Route::resource('subCategory',SubCategoryController::class);
    //==============childCategory==============//
    Route::resource('childCategory',ChildCategoryController::class);
    //===========Contact==============//
    Route::get('/contact-index', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact-delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
     //============Order==============//
    Route::get('order', [OrderController::class, 'orderIndex'])->name('admin.order');
    Route::post('order-delete/{id}', [OrderController::class, 'orderDelete'])->name('admin.order.delete');
    Route::get('order-property/{id}', [OrderController::class, 'orderProperty'])->name('admin.order.property');
    Route::get('order-approve/{id}', [OrderController::class, 'orderApprove'])->name('admin.order.approve');
    Route::get('order-cancel/{id}', [OrderController::class, 'orderCancel'])->name('admin.order.cancel');
    Route::get('order-edit/{id}', [OrderController::class, 'orderEdit'])->name('admin.order.edit');
    Route::post('order-update/{id}', [OrderController::class, 'orderUpdate'])->name('admin.order.update');
    //===========Profile==========//
    Route::get('/profile-index', [ProfileController::class, 'profileIndex'])->name('admin.profile.index');
    Route::post('/profile-update', [ProfileController::class, 'profileUpdate'])->name('admin.profile.update');
    //===========vendor list==============//
    Route::get('/vendor-index', [AdminController::class, 'vendorList'])->name('vendor.index');
    Route::get('/vendor-delete/{id}', [AdminController::class, 'vendorDelete'])->name('vendor.delete');
    //===========AJAX==============//
    // Route::get('/get-subcategories/{category_id}',  [SubCategoryController::class, 'getSubCategory'])->name('get.subcategories');
});