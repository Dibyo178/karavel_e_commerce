<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
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
