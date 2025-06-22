<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MaintenanceComtroller;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenAuthenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/BrandList',[BrandController::class,'BrandList']);
Route::get('/CategoryList',[CategoryController::class,'CategoryList']);
Route::get('/PolicyByType/{type}',[PolicyController::class,'PolicyByType']);
Route::get('/ListProductByCategory/{id}',[ProductController::class,'ListProductByCategory']);
Route::get('/ListProductByRemark/{remark}',[ProductController::class,'ListProductByRemark']);
Route::get('/ListProductByBrand/{id}',[ProductController::class,'ListProductByBrand']);
Route::get('/ListProductBySlider',[ProductController::class,'ListProductBySlider']);
Route::get('/ProductDetailsById/{id}',[ProductController::class,'ProductDetailsById']);
Route::get('/ListReviewByProduct/{product_id}',[ProductController::class,'ListReviewByProduct']);



// user controller
Route::get('/UserLogin/{UserEmail}',[UserController::class,'UserLogin']);
Route::get('/VerifyLogin/{UserEmail}/{OTP}',[UserController::class,'VerifyLogin']);


// user profile

Route::post('/CreateProfile',[ProfileController::class,'CreateProfile'])->middleware([TokenAuthenticate::class]);
Route::get('/ReadProfile',[ProfileController::class,'ReadProfile'])->middleware([TokenAuthenticate::class]);

// Route::get('/ClearAppCache',[MaintenanceComtroller::class,'ClearAppCache']);

// User Auth
// Route::get('')

// product Review

Route::post('/CreateProductReview',[ProductController::class,'CreateProductReview'])->middleware([TokenAuthenticate::class]);


//product wish

Route::get('/CreateWishList/{product_id}',[ProductController::class,'CreateWishList'])->middleware([TokenAuthenticate::class]);
Route::get('/ProductWishList',[ProductController::class,'ProductWishList'])->middleware([TokenAuthenticate::class]);
Route::get('/RemoveWishList/{product_id}',[ProductController::class,'ProductWishList'])->middleware([TokenAuthenticate::class]);


// product cart

Route::post('/CreateCartList',[ProductController::class,'CreateCartList'])->middleware([TokenAuthenticate::class]);
Route::post('/CartList',[ProductController::class,'CartList'])->middleware([TokenAuthenticate::class]);
Route::post('/DeleteCartList/{product_id}',[ProductController::class,'DeleteCartListt'])->middleware([TokenAuthenticate::class]);

// Invoice and pauyment

Route::get('/IncoiceCreate' , [InvoiceController::class,'IncoiceCreate'])->middleware([TokenAuthenticate::class]);

Route::get('/InvoiceList' , [InvoiceController::class,'InvoiceList'])->middleware([TokenAuthenticate::class]);

Route::get('/InvoiceProductList/{invoice_id}' , [InvoiceController::class,'InvoiceProductList'])->middleware([TokenAuthenticate::class]);


// payment

Route::get('/PaymentSuccess' , [InvoiceController::class,'PaymentSuccess'])->middleware([TokenAuthenticate::class]);

Route::get('/PaymentCancel' , [InvoiceController::class,'PaymentCancel'])->middleware([TokenAuthenticate::class]);

Route::get('/PaymentFail' , [InvoiceController::class,'PaymentFail'])->middleware([TokenAuthenticate::class]);
