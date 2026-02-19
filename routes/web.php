<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\VendorController;
use App\Http\Controllers\Frontend\PropertyDetailsController;
use Illuminate\Support\Facades\Route;


// frontend start
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/frontend-login', [FrontendController::class, 'login'])->name('frontend.login');
Route::get('/frontend-register', [FrontendController::class, 'register'])->name('frontend.register');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/listing', [FrontendController::class, 'listing'])->name('listing');
Route::get('/how-to-work', [FrontendController::class, 'howtoWork'])->name('how.to.work');
// //=============Order ==============//
Route::post('/frontend-order/{id}', [OrderController::class, 'order'])->name('frontend.order');
//========Contact=======================//
Route::post('/contact-store', [ContactController::class, 'contactStore'])->name('contact.store');
//property details
Route::get('/property/details/{id}',[PropertyDetailsController::class,'propertyDetails'])->name('property.details');
//================User Login=================//
Route::get('/user-view',[FrontendController::class,'userView'])->name('user.view');
//================vendor=================//
Route::get('/vendor-view',[VendorController::class,'vendorView'])->name('vendor.view');
//======== Frontend route end=============//

require __DIR__ . '/vendor.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';